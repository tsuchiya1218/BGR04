<?php
session_start();
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
        <tr onclick="location.href='syousai.php'">
            <td><img src="ramen.jpg" alt="俺のミルクラーメン"></td>
            <td>
                俺のミルクラーメン
            </td>
            <td>
                自家製ミルクで濃厚なラーメンをつくりあげました

            </td>
            <td>
                &yen;300-
            </td>
        </tr>
        <tr onclick="location.href='syousai.php'">
            <td><img src="ramen.jpg" alt="TOKYO都民だと思ってましたラーメン"></td>
            <td>
                TOKYO都民だと思ってましたラーメン
            </td>
            <td>
                IT`s　SEIRAラーメン
            </td>
            <td>
                &yen;480-
            </td>
        </tr>
    </table>
    <input type="button" onclick="location.href='kensaku.php'" value="戻る" />
</body>

</html>