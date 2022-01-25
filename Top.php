<?php
session_start();

$name = $_POST["name"];

$_SESSION["name"] = "$name";
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Top</title>
</head>
<body>
	<img name=logo src="./img/logo.jpg" alt="logo" width="300" height="130">

    <h3 style="text-align:right">ユーザー名</h3>
    <p>エリアからご当地ラーメンを検索する</p>

<?php
echo"<p style=\"text-align:right\">";
echo"{$_SESSION["name"]}でログイン中</br>";

echo "<button onclick=\"location.href='logout.php'\">ログアウト</button>";
echo "</p>";
?>

    <img name="Top_img" src="./img/日本列島.png" alt="日本列島" onClick="document.location='syousai.html'">
    <input type="button" value="好みの味を探す" onClick="document.location='kensaku.html'">
</body>
</html>