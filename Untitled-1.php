<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>日本電子学生管理システム</title>
    <link rel="stylesheet" type="text/css" href="./css/basic.css">
</head>

<body>
<?php
$pass = $_POST['Pass'];
$name = $_POST['Name'];
$pass2 = $_POST['Pass2'];
$name = htmlspecialchars($name,ENT_QUOTES,'UTF-8');
$pass = htmlspecialchars($pass,ENT_QUOTES,'UTF-8');
$pass2 = htmlspecialchars($pass2,ENT_QUOTES,'UTF-8');
if(empty($name)){
    print "スタッフ名が入力されていません。<br>";
}
if(empty($pass)){
    print "パスワードが入力されていません。<br>";
    $pass=0;
    $pass2=5;
}
if($pass==$pass2){
    print 'スタッフ名： ' . $name . '<br>';
}else{
    print "パスワードが一致しません。<br>";
}
?>
    <button onclick="javascript:history.go(-1)">戻る</button>
    <button onclick="javascript:history.go(-1)">OK</button>
</body>

</html>