<?php
session_start();
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
            <a href="">ログイン</a>
        </p>
    </h3>
</header>

<body>
    <p>注文画面</p>
    <div style="text-align: center">
        登録住所：○○　<a href="addresshenkou.html">変更</a><br>

        <a href="addresssinki">住所新規</a><br>
    </div>
    <br>
    <form action="tyumon_k.html" method="post">
        <div style="text-align: center">
            <input type="radio" id="1" name="1"><label for="1">JCBBカード</label>
            <input type="radio" id="2" name="1"><label for="2">二井主友カード</label>
            <input type="radio" id="3" name="1"><label for="3">四菱銀行カード</label>
            <input type="radio" id="4" name="1"><label for="4">Misterカード</label>
            <input type="radio" id="5" name="1"><label for="5">楽夫カード</label><br>
            <input type="number" name="CardNumber" onkeyup="value = value.length > 16 ? value.slice(0,16): value;" /><br>
            <table border="2">
                <tr>
                    <td width="150" height="80"><img src="img/ラーメン.jpg" alt="八郎" width="193" height="130"></td>
                    <td width="150" height="80">○○ラーメン<br>魂心屋</td>
                    <td width="100" height="80">●個</td>
                    <td width="50" height="80">900円</td>
                </tr>
                <tr>
                    <td width="150" height="80"><img src="img/.jpg" alt="八郎" width="193" height="130"></td>
                    <td width="150" height="80">○○ラーメン<br>次郎</td>
                    <td width="100" height="80">●個</td>
                    <td width="50" height="80">900円</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>合計金額</td>
                    <td>○○円</td>
                </tr>
            </table>
            <input type="button" onclick="location.href='cart.html'" value="戻る" />
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