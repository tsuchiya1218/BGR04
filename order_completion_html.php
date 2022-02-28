<?php
session_start();

$totalprice = $_POST['totalprice'];

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




$sqlcart = "SELECT * FROM cart";
try {
    //SQL文を準備
    $stmt = $pdo->prepare($sqlcart);
    //SQL文を実行
    $stmt->execute();
} catch (PDOException $e) {
    print "sqlcart 実行エラー!: " . $e->getMessage();
    exit();
}
foreach ($stmt as $value) {

    $maxsql = "SELECT MAX(o_code) AS maxid FROM orders";
    try {
        //SQL文を準備
        $stmt = $pdo->prepare($maxsql);
        //SQL文を実行
        $stmt->execute();
        $array = $stmt->fetchALL(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "maxsql 実行エラー！：" . $e->getMessage();
        exit();
    }
    $o_code = $array[0]['maxid'] + 1;


    $ordersql = "INSERT INTO orders VALUES (?,?,?,?)";

    $date = date("Y/m/d");

    try {
        // SQL 文を準備
        $stmt = $pdo->prepare($ordersql);
        // SQL 文を実行
        $stmt->execute(array($o_code, $value['qty'], $date, $totalprice));
        // 実行結果をまとめて取り出し(カラム名で添字を付けた配列)

    } catch (PDOException $e) {
        print "ordersql 実行エラー!: " . $e->getMessage();
        exit();
    }

    $ordersql = "INSERT INTO order_detail VALUES (?,?,?)";

    $delivery = '未';

    try {
        // SQL 文を準備
        $stmt = $pdo->prepare($ordersql);
        // SQL 文を実行
        $stmt->execute(array($o_code, $value['g_code'], $delivery,));
        // 実行結果をまとめて取り出し(カラム名で添字を付けた配列)

    } catch (PDOException $e) {
        print "ordersql 実行エラー!: " . $e->getMessage();
        exit();
    }


}

$deletesql = "DELETE FROM cart";

    try {
        // SQL 文を準備
        $stmt = $pdo->prepare($deletesql);
        // SQL 文を実行
        $stmt->execute();
        // 実行結果をまとめて取り出し(カラム名で添字を付けた配列)

    } catch (PDOException $e) {
        print "deletesql 実行エラー!: " . $e->getMessage();
        exit();
    }



?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link href="css/common.css" rel="stylesheet" type="text/css">
    <link href="css/order.css" rel="stylesheet" type="text/css">
    <title>注文完了画面</title>
</head>

<body>
    <header>
        <h1>
            <a href="top_html.php">TOP</a>
        </h1>
        <nav class="pc-nav">
            <ul>
                <li><a href="top_html.php">ホーム</a></li>
                <li><a href="top_html.php">日本地図で検索</a></li>
                <li><a href="search_html.php">好みで検索</a></li>
                <li><a href="cart_html.php">カート内一覧</a></li>
                <li><a href="order_detail_html.php">注文履歴</a></li>
            </ul>
        </nav>
    </header>
	<img name=logo src="./img/logo.jpg" alt="logo" width="300" height="130" onclick="location.href='top_html.php'">
    <?php
    echo "<p style=\"text-align:right\">";
    echo "{$_SESSION["name"]}でログイン中</br>";

    echo "<button onclick=\"location.href='logout.php'\">ログアウト</button>";
    echo "</p>";
    ?>

    <h2>注文が確定しました</h2><br>

    <h2>ご確認用のメールを送信しました</h2>

    <input class="button" type="button" onclick="location.href='top_html.php'" value="トップページに戻る" />
</body>

<footer>
    <p>© All rights reserved by Monkey.</p>
</footer>

</html>