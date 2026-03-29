<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

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

        // 1. ログイン中のユーザーを取得し、リレーション先の「items」を取得
        // ※Userモデルに items() というリレーションが定義されている前
        $items = [];
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

        elseif($activeTab === 'mylist'){
            if (Auth::check()){
                $userId = Auth::id();
                $items = Like::where('user_id','=',$userId)->get(); 

                // 2. viewにデータを渡す
                return view('index', compact('items'));
            }
            else{
                return view('login');
            }
        }
    }

       
}
