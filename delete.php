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
if(isset($_GET["id"])){
$id=$_GET["id"];
$_SESSION["id"] = $id;
}else{
exit;
}
include "db_connect.php";
doDB();
$sql = "select * from discussion where (id='$id')";
$query = mysqli_query($mysqli, $sql) or die("fail");
$data = mysqli_fetch_array($query);
mysqli_close($mysqli);
?>
<p>削除画面</p>
<form method="POST" action="delete-confirm.php">
<table border="1">
<tr>
<td>名前</td>
<td><?php echo $data["name"]; ?></td>
</tr>
<tr>
<td>メッセージ</td>
<td><?php echo nl2br($data["message"]); ?></td>
</tr>
<tr>
<td>パスワード</td>
<td><input type="text" name="passwd" size="4"></td>
</tr>
<tr>
<td colspan="2">
<input type="submit" value="削除する">
</td>
</tr>
</table>
</form>
</body>
</html>
