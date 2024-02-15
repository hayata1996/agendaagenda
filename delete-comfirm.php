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
$id = $_SESSION["id"];
include "db_connect.php";
doDB();
$sql = "select * from discussion where (id='$id')";
$query = mysqli_query($mysqli, $sql) or die("fail");
$data = mysqli_fetch_array($query);
$passwd = htmlspecialchars($_POST["passwd"], ENT_QUOTES, "UTF-8");
if(strcmp($data["passwd"], $passwd) != 0){
exit("削除用パスワードが違います。<br>
ブラウザの戻るボタンをクリックして前画面に戻り、
パスワードを正しく入力してください。");
}
mysqli_close($mysqli);
?>
<p>削除確認画面</p>
<form method="POST" action="delete-submit.php">
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
<td colspan="2">
<input type="submit" value="削除する">
</td>
</tr>
</table>
</form>
</body>
</html>
