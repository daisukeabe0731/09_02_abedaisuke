<?php
// 送信データのチェック
// var_dump($_GET);
// exit();
session_start();

// 関数ファイルの読み込み
include("functions.php");
check_session_id();

$id = $_GET["id"];

$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT * FROM renraku_table WHERE id=:id';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は指定の11レコードを取得
  // fetch()関数でSQLで取得したレコードを取得できる
  $record = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>連絡帳【編集画面】</title>
</head>

<body>
  <form action="renraku_update.php" method="POST">
    <fieldset>
      <legend>連絡帳【編集画面】</legend>
      <a href="renraku_read.php">一覧画面</a>
      <div>
        子どもの名前：<?= $record["childname"] ?>
        <!-- <select type="text" name="childname" value="<?= $record["childname"] ?>">
          <option value=" man">あらたまっけんゆう</option>
          <option value="man">さとうたける</option>
          <option value="man">ふくしそうた</option>
          <option value="woman">ながさわまさみ</option>
          <option value="woman">ひろせすず</option>
          <option value="woman">よしおかりほ</option>
        </select> -->
      </div>
      <div>
        日にち：<input type="date" name="writetime" value="<?= $record["writetime"] ?>">
      </div>
      <div>
        <textarea type="text" name="renrakutext" cols="30" rows="10" value="<?= $record["renrakutext"] ?>"></textarea>
      </div>
      <div>
        <button>送信</button>
      </div>
      <input type="hidden" name="id" value="<?= $record["id"] ?>">
    </fieldset>
  </form>

</body>

</html>