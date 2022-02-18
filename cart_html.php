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
			<a href="/">TOP</a>
		</h1>
		<nav class="pc-nav">
			<ul>
				<li><a href="#">ホーム</a></li>
				<li><a href="top_html.php">日本地図で検索</a></li>
				<li><a href="kensaku.php">好みで検索</a></li>
				<li><a href="cart_html.php">カート内一覧</a></li>
				<li><a href="">注文履歴</a></li>
			</ul>
		</nav>
	</header>

	<img name=logo src="./img/logo.jpg" alt="logo" width="300" height="130" onclick="location.href='top_html.php'">

	<?php
	echo "<p style=\"text-align:right\">";
	echo "{$_SESSION["name"]}でログイン中</br>";

	echo "<button onclick=\"location.href='logout.php'\">ログアウト</button>";
	echo "</p>";
	?>

	<h2>カート内一覧</h2>

	<table border="2">
		<tr>
			<th>商品画像</th>
			<th>商品名</th>
			<th>金額</th>
			<th>数量</th>
			<th>小計</th>
			<th></th>
		</tr>
		<form method="POST" action="cart_update.php">
			<?php
			$totalprice = 0;
			$ArrayG_code = array();
			foreach ($array as $row) {
				array_push($ArrayG_code, $row["g_code"]);
				$max = count($ArrayG_code); //カートの商品の数

				echo "<tr>";
				echo "<td><img src=img/{$row['g_image']} alt=\"八郎\"></td>";
				echo "<td>{$row['g_name']}</td>";
				echo "<td>{$row['price']}円</td>";
				echo "<td>";


				echo "<select name='qty$max'>";

				for ($i = 1; $i <= $row["stock"]; $i++) {
					if ($i != $row["qty"]) {
						echo "            <option align = right value=$i>{$i}個</option>\n";
					} else {
						echo "            <option align = right value=$i selected>{$i}個</option>\n";
					}
				}
				echo <<< EOM
				</select>
				
				</td>
				EOM;
				$syoukei = $row["qty"] * $row["price"];
				echo "<td>" . $syoukei . "円</td>";
				echo "<td width=\"120\" height=\"80\"><input type=\"button\" value=\"カートから削除\" onclick=\"location.href='cart_delete.php?id={$row["g_code"]}'\"></td>";
				echo "</tr>";
				$totalprice = $totalprice + $syoukei;
			}
			$_SESSION['CartGoodsQty'] = $max;			//UPDATE文で商品数(for)に使う


			for ($i = 0; $i < $max; $i++) {
				$_SESSION['ArrayG_code'][$i] = $ArrayG_code[$i]; //商品数をもとにfor文でg_code取得させUPDATEさせる
			}


			?>
			<tr>
				<td colspan="3"></td>
				<th>合計金額</th>
				<td><?= $totalprice ?>円</td>
				<td></td>
			</tr>
	</table><br>
	<h3>個数を変更した際は必ず更新ボタンを押してください</h3>
	<input class="button" type="button" onclick="location.href='top_html.php'" value="TOPに戻る">
	<input class="button" type="button" onclick="location.href='order_html.php'" value="注文画面へ">
	<input class="button" type="button" onclick="location.href='top_html.php'" value="ショッピングを続ける" />
	<input class="button" type="submit" value="更新">
	</from>
	<script src="./js/cart.js"></script>
</body>

<footer>
	<p>© All rights reserved by webcampnavi.</p>
</footer>

</html>