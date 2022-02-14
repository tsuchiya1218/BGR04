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

    echo "<button onclick=\"location.href='logout.php'\">ログアウト</button>";
    echo "</p>";
    ?>

    <img  src="./img/日本地図.png"  usemap="#Map" alt="日本地図">
    <map name="Map">
    <area shape="poly" coords="693,2,600,54,615,87,562,128,487,143,478,108,490,82,514,65,519,4,599,60,609,61" class="iframe" href="Prefectures.php?area=北" alt="北海道" />
    <area shape="poly" coords="511,138,538,188,501,294,467,284,473,235,485,167,477,168" class="iframe" href="Prefectures.php?area=東" alt="東北" />
    <area shape="poly" coords="498,295,500,334,476,357,456,345,443,301,459,291,481,287,481,287" class="iframe" href="Prefectures.php?area=関" alt="関東" />
    <area shape="poly" coords="408,271,394,274,375,317,399,359,426,363,448,357,436,303,460,282,462,252" class="iframe" href="Prefectures.php?area=中" alt="中部" />
    <area shape="poly" coords="333,328,336,341,330,353,358,358,342,392,366,398,397,367,379,331" class="iframe" href="Prefectures.php?area=近" alt="近畿" />
    <area shape="poly" coords="332,329,328,357,274,379,247,380,244,369,291,331" class="iframe" href="Prefectures.php?area=国" alt="中国" />
    <area shape="poly" coords="334,376,317,367,288,379,276,397,288,427,342,388" class="iframe" href="Prefectures.php?area=四" alt="四国" />
    <area shape="poly" coords="234,376,193,397,143,570,272,421,255,391" class="iframe" href="Prefectures.php?area=九" alt="九州" />
    </map>

    <input type="button" value="好みの味を探す" onClick="document.location='kensaku.php'">
</body>
<!-- ▼ColorboxのCSSを読み込む記述 -->
<link href="./colorbox/design5/colorbox.css" rel="stylesheet" />

<!-- ▼jQueryとColorboxのスクリプトを読み込む記述 -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="./colorbox/jquery.colorbox-min.js"></script>
<script src="./colorbox/jquery.colorbox-ja.js"></script>
<!-- ▼Colorboxの適用対象の指定とオプションの記述 -->
<script>
   $(document).ready(function(){
      $(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
   });
</script>

</html>

