<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>住所変更画面</title>
</head>

<body>
    <img name=logo src="./img/logo.jpg" alt="logo" width="300" height="130">

    <?php
    echo "<p style=\"text-align:right\">";
    echo "{$_SESSION["name"]}でログイン中</br>";

    echo "<button onclick=\"location.href='logout.php'\">ログアウト</button>";
    echo "</p>";
    ?>

    <h2>住所変更画面</h2>
    <form method="POST" action="book_payment.php">
        <p>郵便番号</p>
        <p><input type="number" name="postal" size="7" placeholder="1690073" minlength="7"> <small>※ハイフンなし</small></p>
        <p>住所１(区、市まで)</p>
        <p><input type="address" name="address" size="10" placeholder="東京都新宿区" maxlength="10"></p>
        <p>住所２</p>
        <p><input type="address" name="address" placeholder="百人町１丁目２５−４" size="30"></p>
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="変更する">
    </form>
</body>

</html>