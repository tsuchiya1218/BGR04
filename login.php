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
<title>ログインページ</title>
</head>
<body>
<p>ログインページ</p>

<?php

if($login=="true"){

    echo"<p style=\"text-align:right\">";
    echo"{$_SESSION["name"]}<br>";

    echo "<button onclick=\"location.href='logout.php'\">ログアウト</button>";
    echo "</p>";
};
?>


<form method="post" action="Top.php">
ユーザー名:<input type="text" name="name" style="width:200px"></br>
パスワード:<input type="password" name="pass" style="width:200px">
<p><input type="submit" value="ログイン"></p>
</form>
<a href="passwasure.php"> パスワードを忘れた方はこちら</a>
<a href=""> 新規会員登録はこちら</a>
</body>
</html>