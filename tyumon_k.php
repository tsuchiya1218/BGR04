<?php
session_start();

try {
	$server_name = "10.42.129.3";	// サーバ名
	$db_name = "20jy0204";	// データベース名(自分の学籍番号を入力)

	$user_name = "20jy0204";	// ユーザ名(自分の学籍番号を入力)
	$user_pass = "20jy0204";	// パスワード(自分の学籍番号を入力)

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

$sql = "SELECT * FROM cart inner join customers on customers.c_code = cart.c_code inner join goods on goods.g_code = cart.g_code";

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
foreach ($array as $value) { 
    //データベースから顧客情報取得
    $c_name = $value["c_name"];
    $c_address1 = $value["c_address1"];
    $c_address2 = $value["c_address2"];
}

$card = $_POST["card"];
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

    <p>住所：<?=$c_address1.$c_address2?></p>
    <p>カード会社：<?=$card?></p>
    <table border="2">
        <tr>
            <td>商品画像</td>
            <td>商品名</td>
            <td>数量</td>
            <td>小計</td>
        </tr>
        <?php
        $totalprice = 0;
        foreach($array as $value){
            echo "<tr>";
                echo "<td><img src='img/{$value["g_image"]}' alt='g_image' ></td>";
                echo "<td>{$value["g_name"]}<br>{$value["shopname"]}</td>";
                echo "<td>{$value["qty"]}個</td>";
                $syoukei = $value["qty"] * $value["price"];
                echo "<td>".$syoukei."円</td>";
                $totalprice = $totalprice + $syoukei;
            echo "</tr>";
        }
        ?>
            <tr>
                <td></td>
                <td></td>
                <td>合計金額</td>
                <td><?= $totalprice ?>円</td>
            </tr>
            </table>

    <p>以上の内容で注文を確定してもよろしいですか？</p>

    <input type="button" onclick="location.href='tyumon.php'" value="戻る" />
    <input type="button" onclick="location.href='tyumon_kt.php'" value="注文を確定する" />
</body>

</html>