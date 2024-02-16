<?php
function doDB(){
global $mysqli;
$database = "student_bbs";
$mysqli = mysqli_connect("localhost", "student", "student999")
or die("接続に失敗しました。");
mysqli_select_db($mysqli, $database)
or die($database . "に接続できません。");
mysqli_set_charset($mysqli, "utf8mb4")
or die("文字コードの設定に失敗しました。");
}
?>