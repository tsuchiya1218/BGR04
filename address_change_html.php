<?php
session_start();


try {
    $server_name = "10.42.129.3";    // サーバ名
    $db_name = "20jy0204";    // データベース名(自分の学籍番号を入力)

    $user_name = "20jy0204";    // ユーザ名(自分の学籍番号を入力)
    $user_pass = "20jy0204";    // パスワード(自分の学籍番号を入力)

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
$id = $_GET['id']; //カスタマーコードを受取る

$sql = "SELECT * FROM customers";

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

?>
<DOGTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <link href="css/common.css" rel="stylesheet" type="text/css">
        <link href="css/address.css" rel="stylesheet" type="text/css">
        <title>住所変更画面</title>
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
        <h2>住所変更画面</h2>

        <form method=POST action=address_update.php>
            <?php
            foreach ($array as $value) {
                if ($id == $value["c_code"]) {
                    echo <<< EOM
                    <table border="2">
                        <tr>
                            <th>名前</th>
                            <td><input type=text name=c_name placeholder={$value["c_name"]} required></td>
                        </tr>
                       <tr>
                            <th>電話番号</br>※ハイフン無し</th>
                            <td><input type=text name=c_phone placeholder={$value["c_phone"]} required></td>
                        </tr>
                        <tr>
                            <th>郵便番号 </br>※ハイフン無し</th>
                            <td><input type=text name=c_zip placeholder={$value["c_zip"]} required></td>
                        </tr>
                        <tr>
                            <th>住所１</th>
                            <td><input type=text name=c_address1 placeholder={$value["c_address1"]} required></td>
                        </tr>
                        <tr>
                            <th>住所２ </br>※ハイフンあり</th>
                            <td><input type=text name=c_address2 placeholder={$value["c_address2"]} required></td>
                        </tr>
                    </table>
                    EOM;
                }
            }
            ?>
            <input type="hidden" name="c_code" value="<?= $id ?>" />
            <input class="button" type="button" onclick="location.href='order_html.php'" value="戻る" />
            <input class="button" type="submit" value="住所を変更する">
        </form>
    </body>

    <footer>
        <p>© All rights reserved by Monkey.</p>
    </footer>
    </html>