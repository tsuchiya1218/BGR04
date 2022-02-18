<?php
session_start();
$_SESSION["name"] = "熊澤直人";

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


$sql = "SELECT * from cart";
$stmt = $pdo->prepare($sql);

$stmt->execute(array());

$array = $stmt->fetchAll();

$CartGoodsQty=0;

foreach ($array as $row) {
    $CartGoodsQty=$CartGoodsQty+1;
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link href="css/common.css" rel="stylesheet" type="text/css">
    <link href="css/Top.css" rel="stylesheet" type="text/css">
    <title>地図検索</title>
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
    <img name=logo src="./img/logo.jpg" alt="logo" width="300" height="130">
    <p>エリアからご当地ラーメンを検索する</p>

    <?php
    echo "<p style=\"text-align:right\">";
    echo "{$_SESSION["name"]}でログイン中</br>";

    echo "<button onclick=\"location.href='logout.php'\">ログアウト</button>";
    echo "</p>";
    ?>

    <img src="./img/日本地図.png" usemap="#Map" alt="日本地図">
    <map name="Map">
        <area shape="poly" coords="693,2,600,54,615,87,562,128,487,143,478,108,490,82,514,65,519,4,599,60,609,61" class="iframe" href="prefectures_html.php?area=北" alt="北海道" />
        <area shape="poly" coords="511,138,538,188,501,294,467,284,473,235,485,167,477,168" class="iframe" href="prefectures_html.php?area=東" alt="東北" />
        <area shape="poly" coords="498,295,500,334,476,357,456,345,443,301,459,291,481,287,481,287" class="iframe" href="prefectures_html.php?area=関" alt="関東" />
        <area shape="poly" coords="408,271,394,274,375,317,399,359,426,363,448,357,436,303,460,282,462,252" class="iframe" href="prefectures_html.php?area=中" alt="中部" />
        <area shape="poly" coords="333,328,336,341,330,353,358,358,342,392,366,398,397,367,379,331" class="iframe" href="prefectures_html.php?area=近" alt="近畿" />
        <area shape="poly" coords="332,329,328,357,274,379,247,380,244,369,291,331" class="iframe" href="prefectures_html.php?area=国" alt="中国" />
        <area shape="poly" coords="334,376,317,367,288,379,276,397,288,427,342,388" class="iframe" href="prefectures_html.php?area=四" alt="四国" />
        <area shape="poly" coords="234,376,193,397,143,570,272,421,255,391" class="iframe" href="prefectures_html.php?area=九" alt="九州" />
    </map>

    <p><input class="button" type="button" value="好みの味を探す" onClick="document.location='search_html.php'"></p>
</body>
<!-- ▼ColorboxのCSSを読み込む記述 -->
<link href="./colorbox/design5/colorbox.css" rel="stylesheet" />

<!-- ▼jQueryとColorboxのスクリプトを読み込む記述 -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="./colorbox/jquery.colorbox-min.js"></script>
<script src="./colorbox/jquery.colorbox-ja.js"></script>
<!-- ▼Colorboxの適用対象の指定とオプションの記述 -->
<script>
    $(document).ready(function() {
        $(".iframe").colorbox({
            iframe: true,
            width: "80%",
            height: "80%"
        });
    });
</script>

<footer>
    <p>© All rights reserved by webcampnavi.</p>
</footer>


</html>