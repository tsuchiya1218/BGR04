<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link href="css/common.css" rel="stylesheet" type="text/css">
    <link href="css/tyumon.css" rel="stylesheet" type="text/css"> 
    <title>注文確認画面</title>
</head>

<body>
    <header>
        <h1>
            <a href="/">TOP</a>
        </h1>

        <nav class="pc-nav">
            <ul>
                <li><a href="#">ホーム</a></li>
                <li><a href="Top.php">日本地図で検索</a></li>
                <li><a href="kensaku.php">好みで検索</a></li>
                <li><a href="cart.php">カート内一覧</a></li>
                <li><a href="">注文履歴</a></li>
            </ul>
        </nav>
    </header>
    <img name=logo src="./img/logo.jpg" alt="logo" width="300" height="130">
    <?php
    echo "<p style=\"text-align:right\">";
    echo "{$_SESSION["name"]}でログイン中</br>";

    echo "<button onclick=\"location.href='logout.php'\">ログアウト</button>";
    echo "</p>";
    ?>

    <h3>注文が確定しました</h3><br>

    <h3>ご確認用のメールを送信しました</h3>

    <input class="button" type="button" onclick="location.href='top.php'" value="トップページに戻る" />
</body>

</html>