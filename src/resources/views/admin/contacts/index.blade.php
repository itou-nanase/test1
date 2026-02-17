<h1>お問い合わせ一覧</h1>

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
                <td>
                    {{ $contact->last_name }} {{ $contact->first_name }}
                </td>

                <td>
                    @if($contact->gender == 1)
                        男性
                    @elseif($contact->gender == 2)
                        女性
                    @else
                        未回答
                    @endif
                </td>

                <td>{{ $contact->email }}</td>

                <td>
                  {{ $contact->contact_type_label }}
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
