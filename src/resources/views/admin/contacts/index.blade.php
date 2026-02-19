<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>管理画面</title>

    <link rel="stylesheet" href="{{ asset('css/contacts.css') }}">

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn">
            ログアウト
        </button>
    </form>
</head>
<body>


<h2>お問い合わせ一覧</h2>

<form method="GET" action="{{ route('admin.contacts.index') }}" style="margin-bottom:16px;">
    <input
        type="text"
        name="keyword"
        placeholder="名前やメールアドレスを入力してください"
        value="{{ request('keyword') }}"
    >
    <button type="submit">検索</button>
    <a href="{{ route('admin.contacts.index') }}">リセット</a>
</form>

<a href="{{ route('admin.contacts.export') }}"
   class="btn btn-success"
   style="margin-bottom: 16px; display: inline-block;">
    エクスポート
</a>

<table border="1" cellpadding="8">
<thead>
    <tr>
        <th>名前</th>
        <th>性別</th>
        <th>メールアドレス</th>
        <th>お問い合わせの種類</th>
    </tr>
</thead>
    <tbody>
        @foreach($contacts as $contact)
<tr>
    <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
    <td>{{ $contact->gender_label}}</td>
    <td>{{ $contact->email }}</td>
    <td>{{ $contact->contact_type_label }}</td>
    <td>
        <button
            class="detail-btn"
            data-id="{{ $contact->id }}"
            data-name="{{ $contact->last_name }} {{ $contact->first_name }}"
            data-gender="{{ $contact->gender }}"
            data-email="{{ $contact->email }}"
            data-type="{{ $contact->contact_type_label }}"
            data-content="{{ $contact->content }}"
        >
            詳細
        </button>
    </td>
</tr>
@endforeach

    </tbody>
</table>

<div id="modal" class="modal">
    <div class="modal-content">

        <span id="modal-close" class="modal-close">×</span>

        <h3>お問い合わせ詳細</h3>

        <p>お名前：<span id="modal-name"></span></p>
        <p>性別：<span id="modal-gender"></span></p>
        <p>メール：<span id="modal-email"></span></p>
        <p>種類：<span id="modal-type"></span></p>
        <p>内容：<span id="modal-content"></span></p>

        <form id="delete-form" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-btn" style="color:red;">
                削除
            </button>
        </form>

        <button id="close-modal">閉じる</button>
    </div>
</div>

<div style="display:flex; gap:8px; align-items:center;">

    {{-- 前へ --}}
    <form method="GET">
        <input type="hidden" name="page" value="{{ $contacts->currentPage() - 1 }}">
        <button type="submit" @if($contacts->onFirstPage()) disabled @endif>
            ＜
        </button>
    </form>

    {{-- 数字 --}}
    @for ($i = 1; $i <= $contacts->lastPage(); $i++)
        <form method="GET">
            <input type="hidden" name="page" value="{{ $i }}">
            <button
                type="submit"
                @if($contacts->currentPage() === $i) disabled style="font-weight:bold;" @endif
            >
                {{ $i }}
            </button>
        </form>
    @endfor

    {{-- 次へ --}}
    <form method="GET">
        <input type="hidden" name="page" value="{{ $contacts->currentPage() + 1 }}">
        <button type="submit" @if(!$contacts->hasMorePages()) disabled @endif>
            ＞
        </button>
    </form>

</div>

<script>
document.querySelectorAll('.detail-btn').forEach(button => {
    button.addEventListener('click', () => {

        document.getElementById('modal-name').textContent = button.dataset.name;
        document.getElementById('modal-gender').textContent = button.dataset.gender;
        document.getElementById('modal-email').textContent = button.dataset.email;
        document.getElementById('modal-type').textContent = button.dataset.type;
        document.getElementById('modal-content').textContent = button.dataset.content;

        // 削除URLを差し替える
        const deleteForm = document.getElementById('delete-form');
        deleteForm.action = `/admin/contacts/${button.dataset.id}`;

        document.getElementById('modal').style.display = 'block';
    });
});

document.getElementById('close-modal').addEventListener('click', () => {
    document.getElementById('modal').style.display = 'none';
});
</script>

