<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	<img name=logo src="./img/logo.jpg" alt="logo" width="300" height="130">
	<h2>〇〇エリア〇〇県</h2>
	<h2>カシスとオレンジのラーメン</h2>
	<?php
	echo "<p style=\"text-align:right\">";
	echo "{$_SESSION["name"]}でログイン中</br>";

	echo "<button onclick=\"location.href=''\">ログアウト</button>";
	echo "</p>";
	?>
	<img src="ramen.jpg" alt="カシスラーメン">

	<p>リキュールを使ったカクテルでおなじみのカシスは、ポリフェノールやビタミンが豊富なベリー系のラーメンです。</br>
		オレンジとともにジューサーにかけて、爽やかなラーメンに仕上げました。</p>
	<p>&yen;480-</p>
	<div class="counter">
		<button class="button" value="0">－</button>
		<input type="number" value="0">個
		<button class="button" value="0">＋</button>
	</div>

	<input type="button" onclick="location.href='Top.php'" value="戻る" />
	<input type="button" onclick="location.href='cart.php'" value="追加" />
</body>

</html>