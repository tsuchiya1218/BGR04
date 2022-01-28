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

    <?php
    echo "<p style=\"text-align:right\">";
    echo "{$_SESSION["name"]}でログイン中</br>";

    echo "<button onclick=\"location.href='logout.php'\">ログアウト</button>";
    echo "</p>";
    ?>

    <p>注文が確定しました</p><br>

    <p>ご確認用のメールを送信しました</p>

    <input type="button" onclick="location.href='top.php'" value="トップページに戻る" />
    <input type="button" onclick="location.href='tyumon_his.php'" value="注文履歴" />
</body>

</html>