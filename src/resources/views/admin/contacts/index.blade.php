<h2>お問い合わせ一覧</h2>

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
                <td>{{ $contact->gender }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->contact_type_label }}</td>
                <td>
                    <button
                        class="detail-btn"
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
<div id="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5);">
    <div style="background:#fff; width:500px; margin:100px auto; padding:20px;">
        <h2>お問い合わせ詳細</h2>

        <p><strong>お名前：</strong><span id="modal-name"></span></p>
        <p><strong>性別：</strong><span id="modal-gender"></span></p>
        <p><strong>メール：</strong><span id="modal-email"></span></p>
        <p><strong>種類：</strong><span id="modal-type"></span></p>
        <p><strong>内容：</strong><span id="modal-content"></span></p>

        <button id="close-modal">閉じる</button>
    </div>
</div>
<script>
document.querySelectorAll('.detail-btn').forEach(button => {
    button.addEventListener('click', () => {
        document.getElementById('modal-name').textContent = button.dataset.name;
        document.getElementById('modal-gender').textContent = button.dataset.gender;
        document.getElementById('modal-email').textContent = button.dataset.email;
        document.getElementById('modal-type').textContent = button.dataset.type;
        document.getElementById('modal-content').textContent = button.dataset.content;

        document.getElementById('modal').style.display = 'block';
    });
});

document.getElementById('close-modal').addEventListener('click', () => {
    document.getElementById('modal').style.display = 'none';
});
</script>
