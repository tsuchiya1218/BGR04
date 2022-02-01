<?php
session_start();

$g_code=1;
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

$sql = "SELECT * FROM goods WHERE g_code=?";

try {
	// SQL 文を準備
	$stmt = $pdo->prepare($sql);
	// SQL 文を実行
	$stmt->execute(array($g_code));
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
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	<img name=logo src="./img/logo.jpg" alt="logo" width="300" height="130" onclick="location.href='Top.php'">
	<h2><?php echo $array["g_name"] ?></h2>
	<h2>カシスとオレンジのラーメン</h2>
	<?php
	echo "<p style=\"text-align:right\">";
	echo "{$_SESSION["name"]}でログイン中</br>";

	echo "<button onclick=\"location.href='logout.php'\">ログアウト</button>";
	echo "</p>";
	?>
	<img src="ramen.jpg" alt="カシスラーメン">

	<p>リキュールを使ったカクテルでおなじみのカシスは、ポリフェノールやビタミンが豊富なベリー系のラーメンです。</br>
		オレンジとともにジューサーにかけて、爽やかなラーメンに仕上げました。</p>
	<p>&yen;480-</p>
	<div class="counter">
		<button class="button" value="0">－</button>
		<input type="number" value="0">個
		<button class="button" value="0">＋</button>
	</div>

	<input type="button" onclick="location.href='Top.php'" value="戻る" />
	<input type="button" onclick="location.href='cart.php'" value="追加" />
</body>

</html>