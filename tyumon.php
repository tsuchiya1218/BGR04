<?php
session_start();

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

$sql = "SELECT * FROM cart inner join customers on customers.c_code = cart.c_code inner join goods on goods.g_code = cart.g_code";

try {
	// SQL 文を準備
	$stmt = $pdo->prepare($sql);
	// SQL 文を実行
	$stmt->execute();
	// 実行結果をまとめて取り出し(カラム名で添字を付けた配列)
	$array = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt = null;
	$pdo = null;
} catch (PDOException $e) {
	print "SQL 実行エラー!: " . $e->getMessage();
	exit();
}
foreach ($array as $value) { 
    //データベースから顧客情報取得
    $c_name = $value["c_name"];
    $c_address1 = $value["c_address1"];
    $c_address2 = $value["c_address2"];
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ラーメン屋 注文　支払い選択</title>
</head>
<header>
    <img name=logo src="./img/logo.jpg" alt="logo" width="300" height="130">

    <h3>
        <p style="text-align: right">
            ユーザー名<br>
            <?php
            echo "<p style=\"text-align:right\">";
            echo "{$_SESSION["name"]}でログイン中</br>";

            echo "<button onclick=\"location.href='logout.php'\">ログアウト</button>";
            echo "</p>";
            ?>
        </p>
    </h3>
</header>

<body>
    <p>注文画面</p>
    <div style="text-align: center">
        登録住所：<?=$c_address1.$c_address2?><a href="addresshenkou.php">変更</a><br>

        <a href="addresssinki">住所新規</a><br>
    </div>
    <br>
    <form action="tyumon_k.php" method="post">
        <div style="text-align: center">
            <input type="radio" id="1" value="JCBBカード" name="card"><label for="1">JCBBカード</label>
            <input type="radio" id="2" value="二井主友カード" name="card"><label for="2">二井主友カード</label>
            <input type="radio" id="3" value="四菱銀行カード" name="card"><label for="3">四菱銀行カード</label>
            <input type="radio" id="4" value="Misterカード" name="card"><label for="4">Misterカード</label>
            <input type="radio" id="5" value="楽夫カード" name="card"><label for="5">楽夫カード</label><br>
            <input type="number" name="CardNumber" onkeyup="value = value.length > 16 ? value.slice(0,16): value;" /><br>
            <!-- ↑　の矢印をcssで消す-->
            <table border="2">
                <tr>
                    <td>商品画像</td>
                    <td>商品名</td>
                    <td>数量</td>
                    <td>小計</td>
                </tr>
            <?php
            $totalprice = 0;
            foreach($array as $value){
                echo "<tr>";
                    echo "<td><img src='img/{$value["g_image"]}' alt='g_image' ></td>";
                    echo "<td>{$value["g_name"]}<br>{$value["shopname"]}</td>";
                    echo "<td>{$value["qty"]}個</td>";
                    $syoukei = $value["qty"] * $value["price"];
                    echo "<td>".$syoukei."円</td>";
                    $totalprice = $totalprice + $syoukei;
                echo "</tr>";
            }
            ?> 
                <tr>
                    <td></td>
                    <td></td>
                    <td>合計金額</td>
                    <td><?= $totalprice ?>円</td>
                </tr>
            </table>
            <input type="button" onclick="location.href='cart.php'" value="戻る" />
            <input type="submit" value="注文を確定する">
        </div>
    </form>



</body>
<footer>
    <p style="text-align: left">　　
        <a href="">ホーム</a>
    </p>
    <p style="text-align: center">
        <a href="">日本地図で検索</a>
    </p>
    <p style="text-align: center">
        <a href="">好みで検索</a>
    </p>
    <p style="text-align: center">
        <a href="">カート内一覧</a>
    </p>
    <p style="text-align: center">
        <a href="">注文履歴</a>
    </p>
    <p style="text-align: right">
        <a href="">お問い合わせ</a>
    </p>
    <p style="text-align: right">
        <a href="">会社概要</a>
    </p>
    <p style="text-align: right">
        <a href="">サイトマップ</a>
    </p>
    <p style="text-align: right">
        <a href="">プライバシーポリシー</a>
    </p>
    <p><small>&copy;Copyright ramen farm.</small>
    <p>
</footer>

</html>