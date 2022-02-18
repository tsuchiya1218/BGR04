<?php
session_start();

//var_dump($_SESSION);    //SESSIONの中身を確認できる

$CartGoodsQty = $_SESSION['CartGoodsQty']; //商品数

//データベースに接続する
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



for ($i = 0; $i < $CartGoodsQty; $i++) { //cartを更新
	$j = $i + 1;

	$ArrayG_code[$i] = $_SESSION['ArrayG_code'][$i]; //商品ID

	$c_code = $_SESSION['c_code']; //c_code取得

	$qty[$j] = $_POST["qty" . $j]; //商品注文個数

	$cart_code = $c_code.$ArrayG_code[$i].$qty[$j];

	$sql = "UPDATE cart SET qty = ?, cart_code = ? WHERE g_code=?";
	$stmt = $pdo->prepare($sql);

	$stmt->execute(array($qty[$j], $cart_code, $ArrayG_code[$i]));

	// /$array = $stmt->fetchAll();

}

header('Location: cart_html.php');
exit();


?>