<!DOCTYPE html>
<html lang="ja">
<head>
<title>電子会議システム</title>
<meta charset="UTF-8">
</head>
<body>
<h1>電子会議システム</h1>
<a href="bbs_top.php">スレッド選択画面に戻る</a>
<hr>
<b>新しいメッセージの入力はこちらからどうぞ。</b><br>
<form method="POST" action="confirm.php">
<table border="1">
<tr>
<td>名前</td>
<td><input type="text" name="name" size="30"></td>
</tr>
<tr>
<td>メッセージ</td>
<td>
<textarea rows="8" cols="40" name="message"></textarea>
</td>
</tr>
<tr>
<td>パスワード</td>
<td><input type="text" name="passwd" size="4"></td>
</tr>
<tr>
<td colspan="2">
<input type="submit" value="確認する">
</td>
</tr>
</table>
</form>
<?php
mb_internal_encoding("UTF-8");
session_start();
$thread = $_GET["thread"];
if(preg_match("/[^0-9]/", $thread)){
echo "数値以外が入力されています。<br>";
echo '<a href="bbs_top.php">
ここをクリックしてトップ画面に戻ってください</a><br>';
}
$_SESSION["thread"]=$thread;
include "db_connect.php";
doDB();
$query = mysqli_query($mysqli, "select * from discussion
where thread='$thread' order by modified desc")
or die("検索に失敗しました。");
while($data = mysqli_fetch_array($query)){
echo "<br><hr>{$data["id"]} : ";
echo $data["name"];
echo "(" . date("Y/m/d H:i", strtotime($data["modified"])) . ")";
if(mb_strlen($data["message"]) >= 40){
echo "<p>" . nl2br(mb_substr($data["message"], 0, 40))
. '<font color="blue"> ・・・続きは[詳細]をクリック</font>'
. "</p>";
}else{
echo "<p>" . nl2br(mb_substr($data["message"], 0, 40)) . "</p>";
}
echo "<a href=\"update.php?id=" . $data["id"] . "\">編集</a> ";
echo "<a href=\"delete.php?id=" . $data["id"] . "\">削除</a> ";
echo "<a href=\"detail.php?id=" . $data["id"] . "\">詳細</a> ";
}
mysqli_close($mysqli);
?>
</body>
</html>
