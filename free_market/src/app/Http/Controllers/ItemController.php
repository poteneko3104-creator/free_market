<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Like;
use App\Models\Category;
use App\Models\Coment;
use App\Models\User;
use App\Models\Cart;
use App\Models\CategoryMaster;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ComentRequest;
use App\Http\Requests\SellRequest;
use App\Http\Requests\PurchaseRequest;

class ItemController extends Controller
{
    // 
    /* 
    public function index(){

        if (Auth::check()){
            $userId = Auth::id();
            $items = Item::where('user_id', '!=', $userId)->get();
        }
        else{
        $items = Item::all();
        }        
        return view('index',['items' => $items]);
    }
        */
    // 

    public function index(Request $request)
    {
        // パラメーター 'tab' を取得、デフォルトは'index'
        $activeTab = $request->query('tab', 'index');

        $items = [];
        // デフォルトの時
         if($activeTab === 'index'){
            if (Auth::check()){
                $items = Item::where('user_id', '!=', Auth::id())->get();
            }
            else{
            $items = Item::all();
            }        
            return view('index',['items' => $items]);

         }
        //マイリスト選択時
        elseif($activeTab === 'mylist'){
            if (Auth::check()){
                $userId = Auth::id();
                /*
                //$items = Like::where('user_id',$userId)->with('items')->get(); 
                $query = Item::whereHas('likes', function ($query) use ($userId) {
                    $query->where('user_id', $userId)->where('status',true);
                });
                if(!empty($request->keyword)){
                    $keyword = $request->keyword;
                    $items = $items->KeywordSearch($keyword);
                }
                */
                // 1. まずクエリのベースを作成（まだ get() しない）
                $query = Item::whereHas('likes', function ($q) use ($userId) {
                    $q->where('user_id', $userId)->where('status', true);
                });

                // 2. キーワードがあればクエリを追加
                if (!empty($request->keyword)) {
                    $query->KeywordSearch($request->keyword);
                }

                // 3. 最後に実行して結果を取得
                $items = $query->get();
                return view('index', compact('items'));
            }
            else{
                return view('login');
            }
        }
    }

    //商品検索機能
    public function search(Request $request)
        {
                $keyword = $request->keyword;
                $query = Item::query();
                if (!empty($keyword)) {
                    $query->KeywordSearch($keyword);
                }
                $items = $query->get();
                return view('index', compact('items','keyword'));
        }
    
    //商品詳細画面の表示
    public function detail(Item $item){
                $userId = Auth::id();
                $categories = Category::where('item_id','=',$item->id)->with('categoryMaster')->get();
                $coments = Coment::where('item_id','=',$item->id)->with('user')->get();
                $comentsCount = $coments->count();
                $likesCount = Like::where('item_id','=',$item->id)->where('status','=','1')->count();
                $like = Like::where('item_id','=',$item->id)->where('user_id','=',$userId)->first();
                return view('detail',compact('item','categories','coments','comentsCount','likesCount','like'));
    }

    //コメント送信時
    public function comentRegister(ComentRequest $request){

            Coment::create([
                'user_id'  => Auth::id(),        
                'item_id'  => $request->itemId,
                'content' => $request->content, 
            ]);

            $item = $request->itemId;
            return redirect()->route('detail', ['item' => $item]);

    }

    //いいねチェックする
    public function likeChecked(Item $item){
        Like::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'item_id' => $item->id,
            ],
            // 見つからなかった場合に新規登録する際、追加で保存したいデータ（任意）
            [
                'status' =>'1',
            ]
        );
        return back();
    }

    //いいねチェック外す
    public function likeUnchecked(Item $item){
        Like::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'item_id' => $item->id,
            ],
            // 見つからなかった場合に新規登録する際、追加で保存したいデータ（任意）
            [
                'status' =>'0',
            ]
        );
        return back();
    }
    public function address(Item $item){
        return view('address',compact('item'));
    }
    
    public function purchase(Item $item){
        $user = User::where('id','=',Auth::id())->first();
        return view('purchase',compact('item','user'));
    }

    //変更後の配送先を商品購入画面に値を返す。
    public function returnAddress(Request $request, Item $item){
        $user = (object)[
            'post_code' => $request->post_code,
            'address' => $request->address,
            'building' => $request->building,
        ];

        return view('purchase',compact('item','user'));
    }
    //プロフィール画面を表示する。
    public function mypage(Request $request){
        $activeTab = $request->query('tab', 'sold');
        $items = [];
        if($activeTab == 'sold'){
            $items = Item::where('user_id',Auth::id())->get();
        }
        elseif($activeTab == 'bought'){
            /*
            $items = Cart::where('user_id',Auth::id())
                ->whereHas('item', function ($query) {  
                $query->where('sold', true);
                })
            ->get();
            */

            $items = Item::whereHas('purchases', function ($query){
                    $query->where('user_id',Auth::id());
                })->where('sold', true)->get();
        }
        $user = User::where('id',Auth::id())->first();
        return view('mypage',compact('user','items'));
    }
    //プロフィール編集
    public function editProfile(){
        $user = User::where('id',Auth::id())->first();
        return view('edit',compact('user'));
    }
    //プロフィール更新
    public function updateProfile(Request $request){
        $data = $request->only(['name','post_code','address','building']);
        if($request->hasFile('image')){
                    // ファイルを保存（storage/app/public/images フォルダに保存される）
                    // store() の戻り値は保存先のファイルパス
                    $path = $request->file('image')->store('images', 'public');
                    $data['profile_pic'] = $path;
        }
        User::find(Auth::id())->update($data);
        return redirect('mypage');
    }
    //商品出品画面表示
    public function sell(){
        $categories = CategoryMaster::all();
        return view('sell',compact('categories'));
    }
    //商品登録
    /*
    public function registerSell(Request $request){
        $data = $request->only(['name','brand','price','detail','condition']);
        $data['user_id'] = Auth::id();
        $data['sold'] = false;
        if($request->hasFile('image')){
            $path = $request->file('image')->store('images', 'public');
            $data['pic'] = $path;            
        }
        Item::create($data);
        $id = $data->id;
        $data = null;
        $categories =  $request->input('categories'); 
        foreach($categories as $category){
            $data['item_id']= $id;
            $data['category_master_id']= $category;
        }

        return redirect('index');

    }
    */
    public function registerSell(SellRequest $request) {
        // 1. 基本データの整理
        $data = $request->only(['name', 'brand', 'price', 'detail', 'condition']);
        $data['user_id'] = Auth::id();
        $data['sold'] = false;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $data['pic'] = $path;
        }

        // 2. 保存して、生成されたインスタンスを受け取る
        $item = Item::create($data); 

        // 3. カテゴリの紐付け（多対多のリレーションがある場合）
        if ($request->has('categories')) {
            // sync または attach を使うのが Laravel流で一番楽です
            $item->categories()->attach($request->input('categories'));
        }

        return redirect('/');
    }
    //決済実行（stripeへアクセス）  
    public function sendStripe(PurchaseRequest $request, Item $item)
    {
        $stripe = new StripeClient(config('stripe.secret'));

        $payment_types = ($request->purcase_method == 'コンビニ払い') ? ['konbini'] : ['card'];

        $checkout = $stripe->checkout->sessions->create([
            'payment_method_types' => $payment_types,

            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'unit_amount' => $request->price,
                    'product_data' => [
                        'name' => $request->name,
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('purchase.success'),
            'cancel_url' => route('purchase.cancel'),
        ]);
        
        $record = $request ->only(['post_code','address','building','purcase_method']);
        $record['item_id'] = $item->id;
        $record['user_id'] = Auth::id();
        Purchase::create($record);
        Item::where('id', $request->id)->update(['sold' => true]);

        return redirect($checkout->url);
    } 
}


