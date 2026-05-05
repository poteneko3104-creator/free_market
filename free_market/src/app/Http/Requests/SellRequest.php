<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'image' => ['required'],
            'categories' => ['required'],
            'condition' => ['required'],
            'name' => ['required'],
            'brand' => ['required'],
            'detail' => ['required'],
            'price' => ['required']
        ];

    }
    public function messages(){
        return[
            'image.required' => '商品写真をアップロードしてください',
            'categories.required' => 'カテゴリーを選択してください',
            'name.required' => '商品名を入力してください',
            'condition.required' => '商品の状態を選択してください',
            'brand.required' => 'ブランド名を入力してください',
            'detail.required' => '商品の説明を入力してください',
            'price.required' => '販売価格を入力してください',
        ];
    }
}
