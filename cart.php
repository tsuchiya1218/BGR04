<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>カート内を確認</title>
</head>

<body>
<a href="Top.php"><img name=logo src="./img/logo.jpg" alt="logo" width="300" height="130"></a>

	<?php
	echo "<p style=\"text-align:right\">";
	echo "{$_SESSION["name"]}でログイン中</br>";

	echo "<button onclick=\"location.href=''\">ログアウト</button>";
	echo "</p>";
	?>

	<h3 style="text-align:right">ユーザー名</h3>
	<h2 style="text-align:center">カート内一覧</h2>

	<table border="2">
		<tr>
			<td width="150" height="80"><img src="img/ラーメン.jpg" alt="八郎" width="193" height="130"></td>
			<td width="150" height="80">○○ラーメン<br>魂心屋</td>
			<td width="50" height="80">900円</td>
			<td width="250" height="80">
				<button class="button" value="0" onclick="/*addOne(this.value);*/location.reload()">+</button>
				<input type="number" value="0" name="input[]">
				<button class="button" value="0" onclick="/*subOne(this.value);*/location.reload()">-</button>
			</td>
			<td width="120" height="80"><input type="button" value="カートから削除"></td>
		</tr>
		<tr>
			<td width="150" height="80"><img src="img/.jpg" alt="八郎" width="193" height="130"></td>
			<td width="150" height="80">○○ラーメン<br>次郎</td>
			<td width="50" height="80">900円</td>
			<td width="250" height="80">
				<button class="button" value="0" onclick="/*addOne(this.value);*/location.reload()">+</button>
				<input type="number" value="0" name="input[]">
				<button class="button" value="0" onclick="/*subOne(this.value);*/location.reload()">-</button>
			</td>
			<td width="120" height="80"><input type="button" value="カートから削除"></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td>合計金額</td>
			<td>○○円</td>
		</tr>
	</table><br>
	<input type="button" onclick="location.href='syousai.php'" value="戻る" />
	<input type="button" value="注文画面へ" onclick="document.location='tyumon.php'">
	<input type="button" onclick="location.href='Top.php'" value="ショッピングを続ける" />
</body>

</html>