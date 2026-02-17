<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
    public function rules():array
    {
        return [
            'last_name'  => 'required|string|max:8',
            'first_name' => 'required|string|max:8',
            'gender'     => 'required',

            'email' => 'required|email',

            'tel1' => 'required|alpha_num|max:5',
            'tel2' => 'required|alpha_num|max:5',
            'tel3' => 'required|alpha_num|max:5',

            'address' => 'required',

            'contact_type' => 'required',

            'content' => 'required|max:120',

        ];
    }
    public function messages(): array
{
    return [
        'last_name.required'  => '姓を入力してください',
        'last_name.string'    => '姓は文字列で入力してください。',
        'last_name.max'       => '姓は8文字以内で入力してください。',

        'first_name.required' => '名を入力してください',
        'first_name.string'   => '名は文字列で入力してください。',
        'first_name.max'      => '名は8文字以内で入力してください。',

        'gender.required'     => '性別を選択してください。',

        'email.required' => 'メールアドレスを入力してください',
        'email.email'    => 'メールアドレスはメール形式で入力してください。',

        'tel1.required' => '電話番号を入力してください',
        'tel1.alpha_num'  => '電話番号は半角英数字で入力してください',
        'tel1.max'        => '電話番号は5桁まで数字で入力してください',

        'tel2.required' => '電話番号を入力してください',
        'tel2.alpha_num'  => '電話番号は半角英数字で入力してください',
        'tel2.max'        => '電話番号は5桁まで数字で入力してください',
        'tel3.required' => '電話番号を入力してください',
        'tel3.alpha_num'  => '電話番号は半角英数字で入力してください',
        'tel3.max'        => '電話番号は5桁まで数字で入力してください',

        'address.required' => '住所を入力してください',

        'contact_type.required' => 'お問い合わせの種類を選択してください。',

        'content.required' => 'お問い合わせ内容を入力してください',
        'content.max'      => 'お問い合わせ内容は120文字以内で入力してください',
    ];
}

}
