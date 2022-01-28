<?php
session_start();

    $_SESSION["name"] = "熊澤直人";
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link href="css/Top.css" rel="stylesheet" type ="text/css">

    <title>Top</title>
</head>

<body>
    <img name=logo src="./img/logo.jpg" alt="logo" width="300" height="130">

    <h3 style="text-align:right">ユーザー名</h3>
    <p>エリアからご当地ラーメンを検索する</p>

    <?php
    echo "<p style=\"text-align:right\">";
    echo "{$_SESSION["name"]}でログイン中</br>";

    echo "<button onclick=\"location.href=''\">ログアウト</button>";
    echo "</p>";
    ?>

    <img  src="./img/日本地図.png"  usemap="#Map" alt="日本地図">
    <map name="Map">
    <area shape="poly" coords="693,2,600,54,615,87,562,128,487,143,478,108,490,82,514,65,519,4,599,60,609,61" href="北海祖" alt="北海道" />
    <area shape="poly" coords="511,138,538,188,501,294,467,284,473,235,485,167,477,168" href="東保k" alt="東北" />
    <area shape="poly" coords="498,295,500,334,476,357,456,345,443,301,459,291,481,287,481,287" href="関東" alt="関東" />
    <area shape="poly" coords="408,271,394,274,375,317,399,359,426,363,448,357,436,303,460,282,462,252" href="中部" alt="中部" />
    <area shape="poly" coords="333,328,336,341,330,353,358,358,342,392,366,398,397,367,379,331" href="近畿" alt="近畿" />
    <area shape="poly" coords="332,329,328,357,274,379,247,380,244,369,291,331" href="四国" alt="" />
    <area shape="poly" coords="334,376,317,367,288,379,276,397,288,427,342,388" href="中国" alt="" />
    <area shape="poly" coords="234,376,193,397,143,570,272,421,255,391" href="九州" alt="" />
    </map>

    <input type="button" value="好みの味を探す" onClick="document.location='kensaku.php'">
</body>

</html>






<img src="日本地図.png" usemap="#ImageMap" alt="" />
<map name="ImageMap">
  
</map>