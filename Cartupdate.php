<?php
session_start();

//var_dump($_SESSION);    //SESSIONの中身を確認できる

for ($j = 1; $j <= 2; $j++) {
    $qty[$j]=$_POST["qty".$j];
}

$CartGoodsQty=$_SESSION['CartGoodsQty'];
for ($i = 0; $i < $_SESSION['CartGoodsQty']; $i++) {
    $_SESSION['ArrayG_code'][$i]; 

}

/*
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


$sql = "SELECT * from cart
		inner join goods on goods.g_code = cart.g_code";
$stmt = $pdo->prepare($sql);

$stmt->execute(array());

$array = $stmt->fetchAll();

*/
?>