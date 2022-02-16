 <?php

$g_code = $_POST['g_code'];
$c_code = $_POST['c_code'];
$qty = $_POST['qty'];

 session_start();
//データベースに接続する
try {
	$server_name = "10.42.129.3";	// サーバ名
	$db_name = "20jy0204";	// データベース名(自分の学籍番号を入力)

	$user_name = "20jy0204";	// ユーザ名(自分の学籍番号を入力)
	$user_pass = "20jy0204";	// パスワード(自分の学籍番号を入力)

	// データソース名設定
	$dsn = "sqlsrv:server=$server_name;database=$db_name";

	// PDOオブジェクトのインスタンス作成
	$pdo = new PDO ($dsn, $user_name, $user_pass);

	// PDOオブジェクトの属性の指定
	$pdo ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch ( PDOException $e ) {
	print "接続エラー!: " . $e->getMessage ();
	exit();
}

$sql="SELECT MAX(book_id) AS maxid FROM book";
try{
//SQL文を準備
$stmt = $pdo->prepare($sql);
//SQL文を実行
$stmt->execute();
$array = $stmt->fetchALL(PDO::FETCH_ASSOC);

}catch(PDOException $e){
	print"SQL実行エラー！：".$e->getMessage();
	exit();
}

$cart_code = $array[0]['maxid'] + 1;
//SQL分を$sqlに代入
if($g_code)
$sql = "INSERT INTO book VALUES(?,?,?,?)";
try{
	//SQL文を準備
	$stmt = $pdo->prepare($sql);
	//SQL文を実行
	$stmt->execute(array($cart_code,$g_code,$c_code,$qty));

	//$array = $stmt->fetchALL(PDO::FETCH_ASSOC);
	$stmt = null;
	$pdo = null;
}catch(PDOException $e){
	print"SQL実行エラー！：".$e->getMessage();
	exit();
}

 
header('Location: book_regist_finish.php');
exit();
 
?>