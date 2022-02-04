<?php
session_start();

$sid=session_id();

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

$sid = session_id();

$sql = "SELECT * from cart
		inner join goods on goods.g_code = cart.g_code";
$stmt = $pdo->prepare($sql);

$stmt->execute(array()); 

$array = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>カート内を確認</title>
</head>

<body>
	<img name=logo src="./img/logo.jpg" alt="logo" width="300" height="130" onclick="location.href='Top.php'">

	<?php
	echo "<p style=\"text-align:right\">";
	echo "{$_SESSION["name"]}でログイン中</br>";

	echo "<button onclick=\"location.href='logout.php'\">ログアウト</button>";
	echo "</p>";
	?>

	<h3 style="text-align:right">ユーザー名</h3>
	<h2 style="text-align:center">カート内一覧</h2>

	<table border="2">
		<tr>
			<th></th>
			<th>商品名</th>
			<th>金額</th>
			<th>数量</th>
			<th></th>
		</tr>
		<?php
		$cnt=0;
        foreach($array as $row){
                echo "<tr>";
                echo "<td><img src=img/{$row['g_image']} alt=\"八郎\" width=\"193\" height=\"130\"></td>";
                echo "<td>{$row['g_name']}</td>";
                echo "<td>{$row['price']}</td>";
				echo "<td>";
				echo "<button class=\"button\" value=\"$cnt\" onclick=\"addOne(this.value);\">+</button>";
				echo "<input type=\"number\" value=\"{$row['qty']}\" name=\"input[]\">";
				echo "<button class=\"button\" value=\"$cnt\" onclick=\"subOne(this.value);\">-</button>";
				echo "</td>";
				echo "<td width=\"120\" height=\"80\"><input type=\"button\" value=\"カートから削除\"></td>";
                echo "</tr>";
				$cnt = $cnt + 1;
        }
?>
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

	<script src="./js/cart.js"></script>
</body>

</html>