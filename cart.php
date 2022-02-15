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
			<th>小計</th>
		</tr>
		<form method="POST" action="kousin.php">
		<?php
        $totalprice = 0;
		$ArrayG_code =array();
        foreach($array as $row){
                echo "<tr>";
                echo "<td><img src=img/{$row['g_image']} alt=\"八郎\" width=\"193\" height=\"130\"></td>";
                echo "<td>{$row['g_name']}</td>";
                echo "<td>{$row['price']}円</td>";
				echo "<td>";

				echo "<input type=\"number\" value=\"{$row['qty']}\">";
				
				echo "</td>";
				$syoukei = $row["qty"] * $row["price"];
				echo "<td>".$syoukei."円</td>";
				echo "<td width=\"120\" height=\"80\"><input type=\"button\" value=\"カートから削除\" onclick=\"location.href='cart_delete.php?id={$row["g_code"]}'\"></td>";
				echo "</tr>";
				$totalprice = $totalprice + $syoukei;
				
				$g_code = $row["g_code"];
				array_push($ArrayG_code,$g_code);
						}	
			for($i=0; $i < count($ArrayG_code); $i++) {
				echo "<input type='hidden' name='ArrayG_code' value=".$ArrayG_code[$i].">";
				echo $ArrayG_code[$i];
			}
?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td>合計金額</td>
			<td><?=$totalprice?>円</td>
		</tr>
	</table><br>
	<input type="button" onclick="location.href='syousai.php'" value="戻る" />
	<input type="button" value="注文画面へ" onclick="total();">
	<input type="button" onclick="location.href='Top.php'" value="ショッピングを続ける" />
	<input type="submit" value="更新">
	</from>
	<script src="./js/cart.js"></script>
</body>

</html>