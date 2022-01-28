<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ラーメン屋 注文履歴一覧</title>
</head>
<header>
    <img name=logo src="./img/logo.jpg" alt="logo" width="300" height="130">

    <h3>
        <p style="text-align: right">
            ユーザー名<br>
            <?php
            echo "<p style=\"text-align:right\">";
            echo "{$_SESSION["name"]}でログイン中</br>";

            echo "<button onclick=\"location.href=''\">ログアウト</button>";
            echo "</p>";
            ?>
        </p>
    </h3>
</header>

<body>
    <p>注文履歴</p>
    <br>
    <form action="tyumon_k.php" method="post">
        <div style="text-align: center">
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
                    <td>支払い状況</td>
                    <td>支払い済み</td>
                    <td><input type="button" onclick="location.href=''" value="キャンセル（本来支払い済みじゃない場合表示される）" /></td>
                    <td></td>
                </tr>
                <tr>
                    <td>2022年01月28日<br></td>
                    <td>配達済み</td>
                    <td>合計金額</td>
                    <td>1800円</td>
                </tr>
            </table>
            <input type="button" onclick="location.href='top.php'" value="トップページに戻る" />
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