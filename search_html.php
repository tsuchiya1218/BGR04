<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link href="css/common.css" rel="stylesheet" type="text/css">
    <link href="css/kensaku.css" rel="stylesheet" type="text/css">
    <title>好み検索</title>
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

    <h3 style="text-align:right">ユーザー名</h3>
    <h2 style="text-align:center">あなたの好みを探します</h2>
    <form method="POST" action="list.php.php">
        <div>
            <label><input type="radio" name="type" value="醤油" required>醤油</label>
            <label><input type="radio" name="type" value="味噌">味噌</label>
            <label><input type="radio" name="type" value="豚骨">豚骨</label>
            <strong>必須</strong>
        </div>
        <div>
            <label><input type="radio" name="taste_intensity" value="あっさり" required>あっさり</label>
            <label><input type="radio" name="taste_intensity" value="こってり">こってり</label>
            <strong>必須</strong>
        </div>
        <div>
            <label><input type="radio" name="noodle_thickness" value="太" required>太</label>
            <label><input type="radio" name="noodle_thickness" value="細">細</label>
            <strong>必須</strong>
        </div></br>

        <input class="button" type="button" onclick="location.href='Top.php'" value="戻る">
        <input class="button" type="submit" value="検索">
    </form>
    
</body></br>

<footer>
    <p>© All rights reserved by webcampnavi.</p>
</footer>

</html>