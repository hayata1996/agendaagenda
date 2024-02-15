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
$id = $_SESSION["id"];
$sql = "delete from discussion where id ='$id'";
$query = mysqli_query($mysqli, $sql)
    or die("$idデータを発見できませんでした");
$message = "データを削除しました<br>";
$_SESSION = array();
session_destroy();
mysqli_close($mysqli);
?>
<p>削除完了画面</p>
<p><?php echo $message; ?></p>
<p><a href="bbs_top.php">トップページへ</a></p>
</body>
</html>   
    
    