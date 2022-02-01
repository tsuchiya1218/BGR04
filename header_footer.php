<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ラーメン屋</title>
</head>

<body>
    <img name=logo src="./img/logo.jpg" alt="logo" width="300" height="130">

    <?php
    echo "<p style=\"text-align:right\">";
    echo "{$_SESSION["name"]}でログイン中</br>";

    echo "<button onclick=\"location.href='logout.php'\">ログアウト</button>";
    echo "</p>";
    ?>
</body>
<footer>
    <div class="menu">
        <ul>
            <div class="yoko">　　
                <li><a href="">ホーム</a></li>
            </div>
            <div class="yoko">
                <li><a href="">日本地図で検索</a></li>
            </div>
            <div class="yoko">
                <li><a href="">好みで検索</a></li>
            </div>
            <div class="yoko">
                <li><a href="">カート内一覧</a></li>
            </div>
            <div class="yoko">
                <li><a href="">注文履歴</a></li>
            </div>
            <div class="yoko">
                <li><a href="">お問い合わせ</a></li>
            </div>
            <div class="yoko">
                <li><a href="">会社概要</a></li>
            </div>
            <div class="yoko">
                <li><a href="">サイトマップ</a></li>
            </div>
            <div class="yoko">
                <li><a href="">プライバシーポリシー</a></li>
            </div>
        </ul>　
    </div>
    <p><small>&copy;Copyright ramen farm.</small>
    <p>
</footer>

</html>