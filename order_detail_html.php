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


$sql = "SELECT * from order_detail
		inner join goods on goods.g_code = order_detail.g_code
        inner join orders on orders.o_code = order_detail.o_code";
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
	<link href="css/order_history.css" rel="stylesheet" type="text/css">
	<title>注文履歴</title>
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
	echo "<p style=\"text-align:right\">";
	echo "{$_SESSION["name"]}でログイン中</br>";

	echo "<button onclick=\"location.href='logout.php'\">ログアウト</button>";
	echo "</p>";
	?>

	<h2>注文履歴一覧</h2>
    <?php
			if ($check == 1) {
    ?>
	<table border="2">
		<tr>
			<th>商品画像</th>
			<th>商品名</th>
            <th>店名</th>
			<th>金額</th>
			<th>数量</th>
			<th>小計</th>
			<th>注文日付</th>
            <th>配達状況</th>
		</tr>
			<?php
			$totalprice = 0;
			$ArrayG_code = array();
			foreach ($array as $row) {
				array_push($ArrayG_code, $row["g_code"]);
				$max = count($ArrayG_code); //カートの商品の数
				echo "<tr>";
				echo "<td><img src=img/{$row['g_image']} alt=\"八郎\" class='img'></td>";
				echo "<td>{$row['g_name']}</td>";
                echo "<td>{$row['shopname']}</td>";
				echo "<td>{$row['price']}円</td>";
				echo "<td>";
				echo $row["qty"];
				echo <<< EOM
				</td>
				EOM;
				$syoukei = $row["qty"] * $row["price"];
				echo "<td>" . $syoukei . "円</td>";
                echo "<td>" . $row["date"] . "</td>";
                echo "<td>" . $row["delivery"] . "</td>";
				echo "</tr>";
                $totalprice = $totalprice + $syoukei;
			} 
			echo <<< eom
			<tr>
				<td colspan="6"></td>
				<th>合計金額</th>
				<td>$totalprice 円</td>
			</tr>
			eom;

            } else {
                echo <<< eom
                    <tr>
                    <td colspan="5" class="cart">注文履歴がありません</td>
                    </tr>
                eom;
            }
            ?>
	</table><br>
	<input class="button" type="button" onclick="location.href='top_html.php'" value="ショッピングを続ける" />
	<script src="./js/cart.js"></script>
</body>

<footer>
	<p>© All rights reserved by Monkey.</p>
</footer>

</html>