 <?php
  session_start();

$area = $_GET['area'];


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
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link href="css/Prefectures.css" rel="stylesheet" type ="text/css">

    <title>Top</title>
</head>
<body>
<?php
	$sql = "SELECT * FROM goods WHERE area = ?";
try {
	// SQL 文を準備
	$stmt = $pdo->prepare($sql);
	// SQL 文を実行
	$stmt->execute(array($area));
	// 実行結果をまとめて取り出し(カラム名で添字を付けた配列)
} catch (PDOException $e) {
	print "SQL 実行エラー!: " . $e->getMessage();
	exit();
}


while(($rec = $stmt->FETCH(PDO::FETCH_ASSOC))){
//cssでflexに設定
echo <<< unk
<div class='msr_box02' >
<a href="detail_html.php?id=$rec[g_code]" target="_blank">
<img src="./img/$rec[g_image]" width="230" height="150" alt="img"/>
<h2 class="ttl">$rec[g_name]</h2>
</a>
<p>$rec[g_detail]</p>
<p>$rec[prefectures]<br> $rec[shopname]</p>
</div>
unk;
}
?>

</body>

<footer>
    <p>© All rights reserved by Monkey.</p>
</footer>
</html>