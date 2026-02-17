<h2>入力内容確認</h2>

<p>お名前：{{ $inputs['last_name'] }} {{ $inputs['first_name'] }}</p>

<p>性別：
@if($inputs['gender'] == 1) 男性
@elseif($inputs['gender'] == 2) 女性
@else その他
@endif
</p>

<p>メール：{{ $inputs['email'] }}</p>
<p>電話番号：{{ $inputs['tel1'] }}-{{ $inputs['tel2'] }}-{{ $inputs['tel3'] }}</p>
<p>住所：{{ $inputs['address'] }}</p>
<p>建物名：{{ $inputs['building'] }}</p>

<p>お問い合わせの種類：
@php
    $types = [
        1 => '商品のお届けについて',
        2 => '商品の交換について',
        3 => '商品トラブル',
        4 => 'ショップへのお問い合わせ',
        5 => 'その他'
    ];
@endphp
{{ $types[$inputs['contact_type']] }}
</p>

<p>内容：{{ $inputs['content'] }}</p>

<form method="POST" action="/store">
    @csrf

    @foreach($inputs as $name => $value)
        <input type="hidden" name="{{ $name }}" value="{{ $value }}">
    @endforeach

    <button type="submit" name="action" value="back">修正する</button>
    <button type="submit" name="action" value="submit">送信する</button>
</form>
