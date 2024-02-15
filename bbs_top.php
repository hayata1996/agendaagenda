<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8" >
<title>電子会議システム</title>
</head>
<body>
<h1>電子会議システム</h1>
参加したいスレッド番号をクリックしてください。<br>
<hr>
<h2>スレッド一覧</h2>
<?php
mb_internal_encoding("UTF-8");
include "db_connect.php";
doDB();
if(isset($_GET["title"])){
$title = htmlspecialchars($_GET["title"], ENT_QUOTES, "UTF-8");
}
$query = mysqli_query($mysqli, "select * from agenda")
or die("検索に失敗しました");
$flag = 0;
while($data =mysqli_fetch_array($query)){
if(!empty($title) and strcmp($data["title"], $title) == 0){
echo "すでにスレッド番号" . $data["thread"] .
"で同名のタイトルが存在します。<br>同名のスレッドは作成できません。";
$flag = 1;
}
}
if($flag == 0 and !empty($title)){
$query = mysqli_query($mysqli, "insert into agenda(title, created)
values ('$title', now())")
or die("スレッドの作成に失敗しました");
}
$query = mysqli_query($mysqli, "select * from agenda order by thread desc")
or die("検索に失敗しました");
while($data = mysqli_fetch_array($query)){
echo "<hr><a href=\"bbs_enter.php?thread=" . $data["thread"] . "\"> ";
echo $data["thread"] . ":" . $data["title"] . "</a>";
echo "(" . date("Y/m/d H:i", strtotime($data["created"])) . "作成)" ;
}
mysqli_close($mysqli);
?>
<hr>
<h2>スレッド作成</h2>
新しいスレッド(議題)のタイトルを入力してください。<br>
<form method="GET" action="bbs_top.php">
<input type="text" name="title" size="50">
<br><br>
<input type="submit" value="スレッド作成">
</form>
</body>
</html>
