<?php
session_start();

echo $type = $_POST["type"];
echo $tit = $_POST["taste_intensity"];
echo $nti = $_POST["noodle_thickness"];
/*
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

$sql = "SELECT * FROM goods WHERE type=? and taste_intensity=? and noodle_thickness=?";
try {
	// SQL 文を準備
	$stmt = $pdo->prepare($sql);
	// SQL 文を実行
	$stmt->execute(array($type,$tit,$nti));
	// 実行結果をまとめて取り出し(カラム名で添字を付けた配列)
	$array = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt = null;
	$pdo = null;
} catch (PDOException $e) {
	print "SQL 実行エラー!: " . $e->getMessage();
	exit();
} */
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>商品検索一覧(好み検索)</title>
</head>

<body>
    <img name=logo src="./img/logo.jpg" alt="logo" width="300" height="130">

    <?php
    echo "<p style=\"text-align:right\">";
    echo "{$_SESSION["name"]}でログイン中</br>";

    echo "<button onclick=\"location.href='logout.php'\">ログアウト</button>";
    echo "</p>";
    ?>

    <table border="1">
    <tr>
        <th>名前</th>
        <th>イメージ</th>
        <th>詳細</th>
        <th>値段</th>
        <th>アレルギー</th>
    </tr>
    <?php
foreach($array as $value){
    echo "<tr>\n";
    echo "<td>{$value["g_name"]}</td>\n";
    echo "<td>{$value["g_image"]}</td>\n";
    echo "<td>{$value["g_detail"]}</td>\n";
    echo "<td>{$value["price"]}</td>\n";
    echo "<td>{$value["allergen"]}</td>\n";
    echo "</tr>\n";
}
?>
    </table>
    <input type="button" onclick="location.href='kensaku.php'" value="戻る" />
</body>

</html>