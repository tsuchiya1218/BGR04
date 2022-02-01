<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>住所新規</title>
</head>


<body>
    <img name=logo src="./img/logo.jpg" alt="logo" width="300" height="130">

    <?php
    echo "<p style=\"text-align:right\">";
    echo "{$_SESSION["name"]}でログイン中</br>";

    echo "<button onclick=\"location.href='logout.php'\">ログアウト</button>";
    echo "</p>";
    ?>

    <h2>住所新規登録画面</h2>
    <p>●●様</p>
    <form method="POST" action="tyumon.php">
        <p>新規郵便番号:
            <input type="text" name="postal" size="7" placeholder="1690073" minlength="7" pattern="\d{7}"><small>※ハイフンなし</small>
        </p>
        <p>新規住所１:
            <input type="address" name="address" size="10" placeholder="例:東京都新宿区" maxlength="10">
        </p>
        <p>新規住所２:
            <input type="address" name="address" size="30" placeholder="例:百人町１丁目２５−４">
        </p>
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="登録する">
    </form>
</body>

</html>