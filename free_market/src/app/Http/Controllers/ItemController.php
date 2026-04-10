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
    // ItemController.php などの該当箇所

    public function index(Request $request)
    {
        // パラメーター 'tab' を取得、デフォルトは'index'
        $activeTab = $request->query('tab', 'index');

        $items = [];
        // デフォルトの時
         if($activeTab === 'index'){
            if (Auth::check()){
                $userId = Auth::id();
                $items = Item::where('user_id', '!=', $userId)->get();
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
                //$items = Like::where('user_id',$userId)->with('items')->get(); 
                $items = Item::whereHas('likes', function ($query) use ($userId) {
                    $query->where('user_id', $userId)->where('status',true);
                })->get();
                if(!empty($request->keyword)){
                    $items = $items->KeywordSearch($keyword);
                }
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

            $items = Item::whereHas('carts', function ($query){
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
    public function registerSell(Request $request){
        $data = $request->only(['name','brand','price','detail','condition']);
        $data['user_id'] = Auth::id();
        if($request->hasFile('image')){
            $path = $request->file('image')->store('images', 'public');
            $data['pic'] = $path;            
        }
        User::create($data);

    }   
}
