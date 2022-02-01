<?php
session_start();
//データベースに接続する
try {
	$server_name = "10.42.129.3";	// サーバ名
	$db_name = "20jy0203";	// データベース名(自分の学籍番号を入力)

	$user_name = "20jy0203";	// ユーザ名(自分の学籍番号を入力)
	$user_pass = "20jy0203";	// パスワード(自分の学籍番号を入力)
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

$sid = session_id();

$sql = "SELECT g_code,g_name,g_image,price from goods
        inner join cart on book_cart.book_id = book.book_id where session_id = ?";

$stmt = $pdo->prepare($sql);

$stmt ->execute(array($sid));

$array = $stmt -> fetchAll();
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>カート内を確認</title>
</head>

<body>
<a href="Top.php"><img name=logo src="./img/logo.jpg" alt="logo" width="300" height="130"></a>

	<?php
	echo "<p style=\"text-align:right\">";
	echo "{$_SESSION["name"]}でログイン中</br>";

	echo "<button onclick=\"location.href=''\">ログアウト</button>";
	echo "</p>";
	?>

	<h3 style="text-align:right">ユーザー名</h3>
	<h2 style="text-align:center">カート内一覧</h2>

	<table border="2">
		<tr>
			<td width="150" height="80"><img src="img/ラーメン.jpg" alt="八郎" width="193" height="130"></td>
			<td width="150" height="80">○○ラーメン<br>魂心屋</td>
			<td width="50" height="80">900円</td>
			<td width="250" height="80">
				<button class="button" value="0" onclick="/*addOne(this.value);*/location.reload()">+</button>
				<input type="number" value="0" name="input[]">
				<button class="button" value="0" onclick="/*subOne(this.value);*/location.reload()">-</button>
			</td>
			<td width="120" height="80"><input type="button" value="カートから削除"></td>
		</tr>
		<tr>
			<td width="150" height="80"><img src="img/.jpg" alt="八郎" width="193" height="130"></td>
			<td width="150" height="80">○○ラーメン<br>次郎</td>
			<td width="50" height="80">900円</td>
			<td width="250" height="80">
				<button class="button" value="0" onclick="/*addOne(this.value);*/location.reload()">+</button>
				<input type="number" value="0" name="input[]">
				<button class="button" value="0" onclick="/*subOne(this.value);*/location.reload()">-</button>
			</td>
			<td width="120" height="80"><input type="button" value="カートから削除"></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td>合計金額</td>
			<td>○○円</td>
		</tr>
	</table><br>
	<input type="button" onclick="location.href='syousai.php'" value="戻る" />
	<input type="button" value="注文画面へ" onclick="document.location='tyumon.php'">
	<input type="button" onclick="location.href='Top.php'" value="ショッピングを続ける" />
</body>

</html>