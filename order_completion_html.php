<?php
session_start();

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

$sql = "INSERT INTO order_detail ";

try {
    // SQL 文を準備
    $stmt = $pdo->prepare($sql);
    // SQL 文を実行
    $stmt->execute();
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
    <link href="css/common.css" rel="stylesheet" type="text/css">
    <link href="css/tyumon.css" rel="stylesheet" type="text/css">
    <title>注文完了画面</title>
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

    <h3>注文が確定しました</h3><br>

    <h3>ご確認用のメールを送信しました</h3>
    <?
    //cartの情報をorder_detailに移動するSQLを作る
    ?>
    <input class="button" type="button" onclick="location.href='top_html.php'" value="トップページに戻る" />
</body>

<footer>
    <p>© All rights reserved by Monkey.</p>
</footer>

</html>