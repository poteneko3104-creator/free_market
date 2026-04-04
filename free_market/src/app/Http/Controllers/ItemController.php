<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Like;
use App\Models\Category;
use App\Models\Coment;
use App\Models\User;
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
        // パラメーター 'tab' を取得
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
                $items = Like::where('user_id','=',$userId)->with('items')->get(); 
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
    public function edit(){
        return view('edit');
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

       
}
