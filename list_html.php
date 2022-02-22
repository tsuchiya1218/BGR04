<?php
session_start();

$type = $_POST["type"];
$tit = $_POST["taste_intensity"];
$nti = $_POST["noodle_thickness"];
try {
    $server_name = "10.42.129.3";    // サーバ名
    $db_name = "20jy0204";    // データベース名(自分の学籍番号を入力)

    $user_name = "20jy0204";    // ユーザ名(自分の学籍番号を入力)
    $user_pass = "20jy0204";    // パスワード(自分の学籍番号を入力)

    // データソース名設定
    $dsn = "sqlsrv:server=$server_name;database=$db_name";

    // PDOオブジェクトのインスタンス作成
    $pdo = new PDO($dsn, $user_name, $user_pass);

    // PDOオブジェクトの属性の指定
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    print "接続エラー!: " . $e->getMessage();
    exit();
}

$sql = "SELECT * FROM goods WHERE type=? OR taste_intensity=? OR noodle_thickness=?";
try {
    // SQL 文を準備
    $stmt = $pdo->prepare($sql);
    // SQL 文を実行
    $stmt->execute(array($type, $tit, $nti));
    // 実行結果をまとめて取り出し(カラム名で添字を付けた配列)
    $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt = null;
    $pdo = null;
} catch (PDOException $e) {
    print "SQL 実行エラー!: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link href="./CSS/common.css" rel="stylesheet" type="text/css">
    <link href="./CSS/list.css" rel="stylesheet" type="text/css">
    <title>商品検索一覧(好み検索)</title>
</head>

<body>

    <header>
        <h1>
            <a href="/">TOP</a>
        </h1>
        <nav class="pc-nav">
            <ul>
                <li><a href="#">ホーム</a></li>
                <li><a href="top_html.php">日本地図で検索</a></li>
                <li><a href="kensaku.php">好みで検索</a></li>
                <li><a href="cart_html.php">カート内一覧</a></li>
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
    <?php
    echo <<< EOM
<h2>あなたの条件検索結果</h2>
<table border="1">
<tr>
    <th>味</th>
    <th>あっさり/こってり</th>
    <th>太麺/細麺</th>
</tr>
<tr>
    <td>$type</td>
    <td>$tit</td>
    <td>$nti</td>
</tr>
</table></br>
EOM;
    ?>
    <table border="1">
        <tr>
            <th>名前</th>
            <th>イメージ</th>
            <th>詳細</th>
            <th>値段</th>
            <th>アレルギー</th>
        </tr>
        <?php

        foreach ($array as $value) {
            //これ入れ込みたいテーブル全体をリンクにしたい<a href='syousai.php?g_code = $value[g_code]></a>
            echo <<< EOM
                    <tr>
                    <td><a class="color" href="detail_html.php?id=$value[g_code]">{$value["g_name"]}</a></td>
                    <td><a href="detail_html.php?id=$value[g_code]"><img name=logo src='./img/{$value["g_image"]}'alt='{$value["g_name"]}' width='193' height='130'></a></td>
                    <td>{$value["g_detail"]}</td>
                    <td>{$value["price"]}</td>
                    <td>{$value["allergen"]}</td>
                    </tr>
                    
                    EOM;
        }
        ?>
    </table>
    <input class="button" type="button" onclick="location.href='kensaku.php'" value="戻る" />
</body>
<footer>
    <p>© All rights reserved by Monkey.</p>
</footer>
</html>