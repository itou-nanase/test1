<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Http\Requests\LoginRequest;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

public function export()
{
    $contacts = Contact::all(); // ← 今は全件

    $response = new StreamedResponse(function () use ($contacts) {
        $handle = fopen('php://output', 'w');

        // 文字化け対策（Excel用）
        fwrite($handle, "\xEF\xBB\xBF");

        // ヘッダー行
        fputcsv($handle, [
            'お名前',
            '性別',
            'メールアドレス',
            'お問い合わせの種類'
        ]);

        foreach ($contacts as $contact) {
            fputcsv($handle, [
                $contact->last_name . ' ' . $contact->first_name,
                $this->genderLabel($contact->gender),
                $contact->email,
                $this->contactTypeLabel($contact->contact_type),
            ]);
        }

        fclose($handle);
    });

    $response->headers->set('Content-Type', 'text/csv');
    $response->headers->set(
        'Content-Disposition',
        'attachment; filename="contacts.csv"'
    );

    return $response;
}

private function genderLabel($gender)
{
    return match ($gender) {
        1 => '男性',
        2 => '女性',
        default => 'その他',
    };
}

private function contactTypeLabel($type)
{
    return match ($type) {
        1 => '商品のお届けについて',
        2 => '商品の交換について',
        3 => '商品トラブル',
        4 => 'ショップへのお問い合わせ',
        5 => 'その他',
        default => '',
    };
}

}
