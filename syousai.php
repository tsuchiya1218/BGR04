<?php
session_start();

$g_code = 2;
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

foreach ($array as $value) { //データベースから商品情報取得
	$g_name = $value["g_name"];
	$g_image = $value["g_image"];
	$g_detail = $value["g_detail"];
	$stock = $value["stock"];
	$price = $value["price"];
	$allergen = $value["allergen"];
	$shopname = $value["shopname"];
	$contents = $value["contents"];
	$prefectures = $value["prefectures"];
	$type = $value["type"];
	$taste_intensity = $value["taste_intensity"];
	$noodle_thickness = $value["noodle_thickness"];
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="./css/XXX.css" rel="stylesheet" type="text/css">
</head>

<body>

	<img name=logo src="./img/logo.jpg" alt="logo" width="300" height="130" onclick="location.href='Top.php'">
	<?php
	echo "<p style=\"text-align:right\">";
	echo "{$_SESSION["name"]}でログイン中</br>";

	echo "<button onclick=\"location.href='logout.php'\">ログアウト</button>";
	echo "</p>";
	?>

	<div class="center">
		<div class="shopname">
			<?= $shopname ?>

		</br>
		<div class="g_name">
			<?= $g_name ?>
		</div>

		<img name=g_image src="./img/<?= $g_image ?>" alt="g_image">
		</br>

		<p class="g_detail">
			<?= $g_detail ?>
		</p>

		<p class="price">
			単価:<?= $price ?>
		</p>


		<p class="arerugen">
			アレルゲン:<?= $allergen ?>
		</p>
	</div>

	<div class="counter">
		<button class="button" value="0" onclick="subOne(this.value);">－</button>
		<input type="number" value="0" name="input[]">個
		<button class="button" value="0" onclick="addOne(this.value);">＋</button>
	</div>

	<?//javascript 値段受け取り　小計表示
	?>

	<input type="button" onclick="location.href='Top.php'" value="戻る" />
	<input type="button" onclick="total();" value="追加" />

	<script src="./js/syousai.js"></script>

</body>

</html>