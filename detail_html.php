<?php
session_start();


$g_code = $_GET["id"];
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

$sqlcart = "SELECT * FROM cart";
try {
	//SQL文を準備
	$stmt = $pdo->prepare($sqlcart);
	//SQL文を実行
	$stmt->execute();
	$array = $stmt->fetchALL(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
	print "SQL実行エラー！：" . $e->getMessage();
	exit();
}


$check = 0;
foreach ($array as $cart) {
	if ($cart["g_code"] == $g_code) {
		$check = 1; //商品がある場合
	} else {
		//echo $check; //商品数分「0」が表示される
	}
}

$sql = "SELECT * FROM goods WHERE g_code=?";

try {
	// SQL 文を準備
	$stmt = $pdo->prepare($sql);
	// SQL 文を実行
	$stmt->execute(array($g_code));
	// 実行結果をまとめて取り出し(カラム名で添字を付けた配列)
	$array = $stmt->fetchALL(PDO::FETCH_ASSOC);

	$stmt = null;
	$pdo = null;
} catch (PDOException $e) {
	print "SQL 実行エラー!: " . $e->getMessage();
	exit();
}

foreach ($array as $value) { //データベースから商品情報取得
	$g_code = $value["g_code"];
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
	<link href="./CSS/common.css" rel="stylesheet" type="text/css">
	<link href="./CSS/syousai.css" rel="stylesheet" type="text/css">
</head>

<body>
	<header>
		<h1>
			<a href="/">TOP</a>
		</h1>
		<nav class="pc-nav">
			<ul>
				<li><a href="#">ホーム</a></li>
				<li><a href="Top.php">日本地図で検索</a></li>
				<li><a href="kensaku.php">好みで検索</a></li>
				<li><a href="cart.php">カート内一覧</a></li>
				<li><a href="">注文履歴</a></li>
			</ul>
		</nav>
	</header>

	<img name=logo src="./img/logo.jpg" alt="logo" width="300" height="130" onclick="location.href='Top.php'">
	<?php
	echo "<p style=\"text-align:right\">";
	echo "{$_SESSION["name"]}でログイン中</br>";

	echo "<button onclick=\"location.href='logout.php'\">ログアウト</button>";
	echo "</p>";
	?>
	<div>
		<p class="shopname">
			<?= $shopname ?>
		</p>
		</br>

		<p class="g_name">
			<?= $g_name ?>
		</p>
		</br>

		<img name=g_image src="./img/<?= $g_image ?>" alt="g_image">
		</br>

		<p class="g_detail">
			<?= $g_detail ?>
		</p>
		</br>

		<p class="price">
			単価:<?= $price ?>
		</p>
		<p class="arerugen">
			アレルゲン:<?= $allergen ?>
		</p>
	</div>


	<form method="post" action="CartInsert.php">


		<input type="hidden" name="g_code" value="<?= $g_code ?>">
		<input type="hidden" name="c_code" value="1">

		<select class="select" name='qty'>
			<?php

			for ($i = 1; $i <= $stock; $i++) {
				//if ($i != $stock) {
				echo "            <option align = right value=$i>{$i}個</option>\n";
				/*
					} else {
						echo "            <option align = right value=$i selected>{$i}個</option>\n";
					}
					*/
			}
			echo <<< EOM
				</select>
				</br>
				<input type="button" onclick="location.href='top_html.php'" value="戻る" />
				
				EOM;

			if ($check == 0) {
				echo <<< eom
				<input type="submit" value="追加">
				eom;
			} else {
				echo <<< eom
				すでにカートにあります。			
			eom;
			}

			?>
	</form>
</body>
</br>
<footer>
	<p>© All rights reserved by webcampnavi.</p>
</footer>

</html>