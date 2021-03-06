<?php
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

$check = 0;
foreach ($array as $cart) {
	if ($cart["g_code"] > 0) {
		$check = 1; //商品がある場合
	} else {
		//echo $check; //商品数分「0」が表示される
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<link href="css/common.css" rel="stylesheet" type="text/css">
	<link href="css/cart.css" rel="stylesheet" type="text/css">
	<title>カート内を確認</title>
</head>

<body>

	<header>
		<h1>
			<a href="top_html.php">TOP</a>
		</h1>
		<nav class="pc-nav">
			<ul>
				<li><a href="top_html.php">ホーム</a></li>
				<li><a href="top_html.php">日本地図で検索</a></li>
				<li><a href="search_html.php">好みで検索</a></li>
				<li><a href="cart_html.php">カート内一覧</a></li>
				<li><a href="order_detail_html.php">注文履歴</a></li>
			</ul>
		</nav>
	</header>

	<img name=logo src="./img/logo.jpg" alt="logo" width="300" height="130" onclick="location.href='top_html.php'">

	<?php
	echo <<< EOM
	 <p style="text-align:right">
	 $_SESSION[name]でログイン中
	 </br>
	 <button onclick="location.href=logout.php">ログアウト</button>
	 </p>
	EOM;

	?>

	<h2>カート内一覧</h2>

	<table border="2">
		<tr>
			<th>商品画像</th>
			<th>商品名</th>
			<th>金額</th>
			<th>数量</th>
			<th>小計</th>

			<?php
			if ($check == 1) {
				echo <<< eom
					<th></th>
					</tr>
					<form method="POST" action="cart_update.php">
				eom;
				$totalprice = 0;
				$ArrayG_code = array();
				foreach ($array as $row) {
					array_push($ArrayG_code, $row["g_code"]);
					$max = count($ArrayG_code); //カートの商品の数

					echo <<< eom
					 <tr>
					 <td><img src=img/{$row['g_image']} alt="八郎"></td>
					 <td>{$row['g_name']}</td>
					 <td>{$row['price']}円</td>
					 <td>
					<select name='qty$max'>
					eom;
					for ($i = 1; $i <= $row["stock"]; $i++) {
						if ($i != $row["qty"]) {
							echo "            <option align = right value=$i>{$i}個</option>n";
						} else {
							echo "            <option align = right value=$i selected>{$i}個</option>n";
						}
					}
					echo <<< EOM
					</select>
					
					</td>
					EOM;
					$syoukei = $row["qty"] * $row["price"];

					echo <<< EOM
						<td>  $syoukei  円</td>
						<td width="120" height="80"><input type="button" value="カートから削除" onclick="location.href='cart_delete.php?id=$row[g_code]'"></td>
						</tr>
					EOM;

					$totalprice = $totalprice + $syoukei;
				}
				if (isset($max)) {
					$_SESSION['CartGoodsQty'] = $max;			//UPDATE文で商品数(for)に使う

					for ($i = 0; $i < $max; $i++) {
						$_SESSION['ArrayG_code'][$i] = $ArrayG_code[$i]; //商品数をもとにfor文でg_code取得させUPDATEさせる
					}
				}


				echo <<< eom
				<tr>
					<td colspan="3"></td>
					<th>合計金額</th>
					<td>$totalprice 円</td>
					<td></td>
				</tr>
				eom;
			} else {
				echo <<< eom
					<tr>
					<td colspan="5" class="cart">カートに商品がありません</td>
					</tr>
				eom;
			}
			?>
	</table><br>
	<h3>個数を変更した際は必ず更新ボタンを押してください</h3>
	<input class="button" type="button" onclick="location.href='top_html.php'" value="ショッピングを続ける" />
	<input class="button" type="submit" value="更新">
	<?php
	//商品がある場合【注文画面へが表示される】
	if ($check == 1) {
		echo <<< eom
		<input class="button" type="button" onclick="location.href='order_html.php'" value="注文画面へ">
		eom;
	}
	?>
	</from>
	<script src="./js/cart.js"></script>
</body>

<footer>
	<p>© All rights reserved by Monkey.</p>
</footer>

</html>