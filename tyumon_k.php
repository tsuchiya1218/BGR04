<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>注文確認画面</title>
</head>

<body>
    <img name=logo src="./img/logo.jpg" alt="logo" width="300" height="130">

    <h2>注文確認画面</h2>
    <?php
    echo "<p style=\"text-align:right\">";
    echo "{$_SESSION["name"]}でログイン中</br>";

    echo "<button onclick=\"location.href='logout.php'\">ログアウト</button>";
    echo "</p>";
    ?>

    <p>住所：東京都新宿区○○１－１－１</p>
    <p>カード会社：あめっくす</p>
    <img src="./img/ramen.jpg" alt="">
    <p>商品：札幌ラーメン</p>
    <p>価格：&yen;480-</p><br>

    <p>以上の内容で注文を確定してもよろしいですか？</p>

    <input type="button" onclick="location.href='tyumon.php'" value="戻る" />
    <input type="button" onclick="location.href='tyumon_kt.php'" value="注文を確定する" />
</body>

</html>