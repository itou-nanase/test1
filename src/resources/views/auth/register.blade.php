<h1>会員登録</h1>

@if($errors->any())
    <pre>{{ var_dump($errors->all()) }}</pre>
@endif

<form method="POST" action="{{ route('register') }}">
    @csrf

    <div>
        <label>お名前</label><br>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name')
            <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>メールアドレス</label><br>
        <input type="email" name="email" value="{{ old('email') }}">
        @error('email')
            <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>パスワード</label><br>
        <input type="password" name="password">
        @error('password')
            <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label>パスワード（確認）</label><br>
        <input type="password" name="password_confirmation" required>
    </div>

    <button type="submit">登録</button>
</form>

<a href="/login">login</a>
