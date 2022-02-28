<?php
session_start();


$c_code = $_POST['c_code']; //カスタマーコード
$c_zip = $_POST['c_zip']; //郵便番号
$c_address1 = $_POST['c_address1']; //住所１
$c_address2 = $_POST['c_address2']; //住所２

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


	$sql = "UPDATE customers SET c_zip = ?, c_address1 = ?, c_address2 = ? WHERE c_code=?";
	$stmt = $pdo->prepare($sql);

	$stmt->execute(array($c_zip, $c_address1, $c_address2, $c_code));



header('Location: order_html.php');
exit();


?>