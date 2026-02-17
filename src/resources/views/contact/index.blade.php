<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お問い合わせフォーム</title>
</head>
<body>

<h1>お問い合わせフォーム</h1>


<form method="POST" action="/confirm">
    @csrf

    {{-- お名前 --}}
    <div>
    <label>お名前※</label><br>
    姓：
    <input type="text" name="last_name" value="{{ old('last_name') }}">
    @error('last_name')
        <p style="color:red;">{{ $message }}</p>
    @enderror

    名：
    <input type="text" name="first_name" value="{{ old('first_name') }}">
    @error('first_name')
        <p style="color:red;">{{ $message }}</p>
    @enderror

    </div>

    <br>

    {{-- 性別 --}}
    <div>
        <label>性別※</label><br>
    <input type="radio" name="gender" value="1" {{ old('gender') == '1' ? 'checked' : '' }}> 男性
    <input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}> 女性
    <input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}> その他

    @error('gender')
        <p style="color:red;">{{ $message }}</p>
    @enderror
    </div>

    <br>

    {{-- メールアドレス --}}
    <div>
        <label>メールアドレス※</label><br>
        <input type="email" name="email" value="{{ old('email') }}">
    @error('email')
        <p style="color:red;">{{ $message }}</p>
    @enderror
    </div>

    <br>

    {{-- 電話番号 --}}
    <div>
        <label>電話番号</label><br>
    <input type="text" name="tel1" value="{{ old('tel1') }}" size="4"> -
    <input type="text" name="tel2" value="{{ old('tel2') }}" size="4"> -
    <input type="text" name="tel3" value="{{ old('tel3') }}" size="4">

    @error('tel1')
        <p style="color:red;">{{ $message }}</p>
    @enderror
    @error('tel2')
        <p style="color:red;">{{ $message }}</p>
    @enderror
    @error('tel3')
        <p style="color:red;">{{ $message }}</p>
    @enderror
    </div>

    <br>

    {{-- 住所 --}}
    <div>
        <label>住所※</label><br>
        <input type="text" name="address" value="{{ old('address') }}">
        @error('address')
        <p style="color:red;">{{ $message }}</p>
    @enderror
    </div>

    <br>

    {{-- 建物名（任意） --}}
    <div>
        <label>建物名</label><br>
        <input type="text" name="building">
    </div>

    <br>

    {{-- お問い合わせの種類 --}}
    <div>
        <label>お問い合わせの種類※</label><br>
        <select name="contact_type">
            <option value="">選択してください</option>
            <option value="1">商品のお届けについて</option>
            <option value="2">商品の交換について</option>
            <option value="3">商品トラブル</option>
            <option value="4">ショップへのお問い合わせ</option>
            <option value="5">その他</option>
        </select>
        @error('contact_type')
        <p style="color:red;">{{ $message }}</p>
    @enderror
    </div>

    <br>

    {{-- お問い合わせ内容 --}}
    <div>
        <label>お問い合わせ内容※</label><br>
        <textarea name="content" rows="5" cols="40">{{ old('content') }}</textarea>
        @error('content')
        <p style="color:red;">{{ $message }}</p>
    @enderror
    </div>

    <br>

    <button type="submit">送信</button>
</form>

</body>
</html>
