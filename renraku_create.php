<?php

// 送信確認
// var_dump($_POST);
// exit();
session_start();
include("functions.php");
check_session_id();

// 項目入力のチェック
// 値が存在しないor空で送信されてきた場合はNGにする
if (
  !isset($_POST['childname']) || $_POST['childname'] == '' ||
  !isset($_POST['writetime']) || $_POST['writetime'] == '' ||
  !isset($_POST['renrakutext']) || $_POST['renrakutext'] == '' 
) {
  // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
  echo json_encode(["error_msg" => "no input"]);
  exit();
}

// 受け取ったデータを変数に入れる
$childname = $_POST['childname'];
$writetime = $_POST['writetime'];
$renrakutext = $_POST['renrakutext'];

// DB接続
$pdo = connect_to_db();

// データ登録SQL作成
// `created_at`と`updated_at`には実行時の`sysdate()`関数を用いて実行時の日時を入力する
$sql = 'INSERT INTO renraku_table(id, childname, writetime, renrakutext, created_at, updated_at) VALUES(NULL, :childname, :writetime, :renrakutext, sysdate(), sysdate())';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':childname', $childname, PDO::PARAM_STR);
$stmt->bindValue(':writetime', $writetime, PDO::PARAM_STR);
$stmt->bindValue(':renrakutext', $renrakutext, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  header("Location:renraku_input.php");
  exit();
}
