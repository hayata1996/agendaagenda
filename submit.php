<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8" >
<title>電子会議システム</title>
</head>
<body>
<?php
mb_internal_encoding("UTF-8");
session_start();
include "db_connect.php";
doDB();
$name = htmlspecialchars($_SESSION["name"], ENT_QUOTES, "UTF-8");
$passwd = htmlspecialchars($_SESSION["passwd"], ENT_QUOTES, "UTF-8");
$message = htmlspecialchars($_SESSION["message"], ENT_QUOTES, "UTF-8");
$thread = $_SESSION["thread"];
$sql = "insert into discussion (name, message, passwd, thread) 
	values ('$name', '$message', '$passwd', '$thread')";
$query = mysqli_query($mysqli, $sql) or die("fail");
$_SESSION = array();
session_destroy();
mysqli_close($mysqli);
?>
<p>追加完了画面</p>
<table border="1">
<tr>
<td>スレッド番号</td>
<td><?php echo $thread; ?></td>
</tr>
<tr>
<td>名前</td>
<td><?php echo $name; ?></td>
</tr>
<tr>
<td>メッセージ</td>
<td><?php echo nl2br($message); ?></td>
</tr>
<tr>
<td>パスワード</td>
<td><?php echo $passwd; ?></td>
</tr>
</table>
<p><a href="bbs_top.php">トップページへ</a></p>
</body>
</html>