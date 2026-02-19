<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
{
    $query = Contact::query();

   if ($request->filled('keyword')) {
        $keyword = $request->keyword;

        $query->where(function ($q) use ($keyword) {

            // 名前（姓・名・フルネーム）
            $q->where('last_name', 'like', "%{$keyword}%")
              ->orWhere('first_name', 'like', "%{$keyword}%")
              ->orWhereRaw(
                  "CONCAT(last_name, first_name) LIKE ?",
                  ["%{$keyword}%"]
              )
              ->orWhereRaw(
                  "CONCAT(last_name, ' ', first_name) LIKE ?",
                  ["%{$keyword}%"]
              )

              // メールアドレス
              ->orWhere('email', 'like', "%{$keyword}%");
        });
    }

    $contacts = $query
        ->orderBy('created_at', 'desc')
        ->paginate(7)
        ->appends($request->query());

    return view('admin.contacts.index', compact('contacts'));
}    

    public function destroy($id)
    {
    Contact::findOrFail($id)->delete();

    return redirect()
        ->route('admin.contacts.index')
        ->with('success', 'お問い合わせを削除しました');
    }
}


    

