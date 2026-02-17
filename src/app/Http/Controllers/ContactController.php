<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Http\Requests\LoginRequest;

class ContactController extends Controller
{
    // 入力画面表示
    public function index()
    {
        return view('contact.index');
    }
    // 確認画面
    public function confirm(ContactRequest $request)
    {
        $inputs = $request->all();

        return view('contact.confirm', compact('inputs'));
    }
    // DB保存
    public function store(Request $request)
    {
        // 戻るボタン対応
        if ($request->input('action') === 'back') {
            return redirect('/')
                ->withInput($request->except('action'));
        }
        Contact::create([
            'last_name'    => $request->last_name,
            'first_name'   => $request->first_name,
            'gender'       => $request->gender,
            'email'        => $request->email,
            'tel'          => $request->tel1 . $request->tel2 . $request->tel3,
            'address'      => $request->address,
            'building'     => $request->building,
            'contact_type' => $request->contact_type,
            'content'      => $request->content,
        ]);

        return redirect('/thanks');
    }

    public function thanks()
    {
        return view('contact.thanks');
    }

    public function login(LoginRequest $request)
{
    // バリデーションはここに来る前に自動で実行される

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect('/admin');
    }

    return back()->withErrors([
        'email' => 'ログイン情報が正しくありません。',
    ]);
}
}
