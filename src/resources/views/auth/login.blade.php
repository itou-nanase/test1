<h1>ログイン</h1>

<form method="POST" action="/login">
    @csrf

    <div>
        <label>メールアドレス</label><br>
        <input type="email" name="email">
    </div>

    <div>
        <label>パスワード</label><br>
        <input type="password" name="password">
    </div>

    <button type="submit">ログイン</button>
</form>

<a href="/register">register</a>