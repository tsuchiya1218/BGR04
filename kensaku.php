<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>kensaku</title>
</head>

<body>
    <img name=logo src="./img/logo.jpg" alt="logo" width="300" height="130">

    <?php
    echo "<p style=\"text-align:right\">";
    echo "{$_SESSION["name"]}でログイン中</br>";

    echo "<button onclick=\"location.href=''\">ログアウト</button>";
    echo "</p>";
    ?>

    <h3 style="text-align:right">ユーザー名</h3>
    <h2 style="text-align:center">あなたの好みを探します</h2>
    <form method="POST" action="konomihanndann.php">
        <div>
            <label><input type="radio" name="type" value="醤油" required>醤油</label>
            <label><input type="radio" name="type" value="味噌">味噌</label>
            <label><input type="radio" name="type" value="豚骨">豚骨</label>
            <strong>必須</strong>
        </div>
        <div>
            <label><input type="radio" name="taste_intensity" value="あっさり" required>あっさり</label>
            <label><input type="radio" name="taste_intensity" value="こってり">こってり</label>
            <strong>必須</strong>
        </div>
        <div>
            <label><input type="radio" name="noodle_thickness" value="太" required>太</label>
            <label><input type="radio" name="noodle_thickness" value="細">細</label>
            <strong>必須</strong>
        </div>

        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="検索">
    </form>
</body>

</html>