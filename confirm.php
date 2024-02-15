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
$name = htmlspecialchars(str_replace(" ", "", $_POST["name"]),
ENT_QUOTES, "UTF-8");
$message = htmlspecialchars($_POST["message"], ENT_QUOTES, "UTF-8");
$passwd = htmlspecialchars($_POST["passwd"], ENT_QUOTES, "UTF-8");
$thread = $_SESSION["thread"];
$errors = array();
if(empty($name)){
$errors[] = "名前が記入されていません。";
}
if(empty($message)){
$errors[] = "メッセージが記入されていません。";
}
if(empty($passwd)){
$errors[] = "パスワードが記入されていません。";
}
if(preg_match("/\A\d{4}\z/", $passwd)){
$_SESSION["name"] = $name;
$_SESSION["passwd"] = $passwd;
$_SESSION["message"] = $message;
}else{
$errors[] = "パスワードは4桁の数字にしてください。";
}
if(count($errors) > 0){
$errors[] = "ブラウザの戻るボタンをクリックして前画面に戻り、
正しく入力してください。";
$n = count ($errors);
for($i = 0; $i < $n; $i++){
echo "<font color=\"red\">" . $errors[$i] . "</font><br>";
}
exit;
}
?>

<p>追加確認画面</p>
<form method="POST" action="submit.php">
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
<tr>
<td colspan="2">
<input type="submit" value="書き込む">
<input type="button" name="back" onClick="history.back()" value="戻る">
</td>
</tr>
</table>
</form>
</body>
</html
