<?php
session_start();
$login="";
if(!empty($_SESSION["login"])){
    $login=$_SESSION["login"];
};
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>パスワード再設定画面</title>
</head>
<body>
<p>パスワード再設定ページ</p>

<?php

if($login=="true"){

    echo"<p style=\"text-align:right\">";
    echo"{$_SESSION["name"]}<br>";

    echo "<button onclick=\"location.href='logout.php'\">ログアウト</button>";
    echo "</p>";
};
?>

<p>ログイン時に使用するメールアドレスを入力してください</p>

<form method="post" action="pass_setting.php">
メールアドレス:<input type="text" name="name" style="width:200px"></br>
<input type="button" onclick="location.href='Top.php'" value="戻る" />
<input type="submit" value="送信">
</form>
</body>
</html>