<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>パスワード再設定画面</title>
</head>

<body>
    <img name=logo src="./img/logo.jpg" alt="logo" width="300" height="130">

    <p>パスワード再設定ページ</p>

    <p>ログイン時に使用するメールアドレスを入力してください</p>

    <form method="post" action="pass_setting.php">
        メールアドレス:<input type="text" name="name" style="width:200px"></br>
        <input type="button" onclick="location.href='Top.php'" value="戻る" />
        <input type="submit" value="送信">
    </form>
</body>

</html>