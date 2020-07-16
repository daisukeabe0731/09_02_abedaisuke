<?php

// 送信データのチェック
// var_dump($_POST);
// exit();

// 関数ファイルの読み込み
session_start();
include("functions.php");
check_session_id();

// 送信データ受け取り
//$childname = $_POST['childname'];
$writetime = $_POST['writetime'];
$renrakutext = $_POST['renrakutext'];
$id = $_POST["id"];


// DB接続
$pdo = connect_to_db();

// UPDATE文を作成&実行
//$sql = "UPDATE renraku_table SET childname=:childname, writetime=:writetime, renrakutext=:renrakutext, updated_at=sysdate() WHERE id=:id";
$sql = "UPDATE renraku_table SET writetime=:writetime, renrakutext=:renrakutext, updated_at=sysdate() WHERE id=:id";

$stmt = $pdo->prepare($sql);
//$stmt->bindValue(':childname', $childname, PDO::PARAM_STR);
$stmt->bindValue(':writetime', $writetime, PDO::PARAM_STR);
$stmt->bindValue(':renrakutext', $renrakutext, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は一覧ページファイルに移動し，一覧ページの処理を実行する
  header("Location:renraku_read.php");
  exit();
}
