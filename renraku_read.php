<?php
session_start();
include("functions.php");
check_session_id();

// ユーザ名取得
$user_id = $_SESSION['id'];

// DB接続
$pdo = connect_to_db();


// データ取得SQL作成
$sql = 'SELECT * FROM renraku_table
LEFT OUTER JOIN (SELECT renraku_id, COUNT(id) AS cnt
FROM kakunin_table GROUP BY renraku_id) AS likes
ON renraku_table.id = likes.renraku_id';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  // fetchAll()関数でSQLで取得したレコードを配列で取得できる
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
  $output = "";
  // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
  // `.=`は後ろに文字列を追加する，の意味
  foreach ($result as $record) {
    $output .= "<tr>";
    $output .= "<td>{$record["childname"]}</td>";
    $output .= "<td>{$record["writetime"]}</td>";
    $output .= "<td>{$record["renrakutext"]}</td>";
    // edit deleteリンクを追加
    $output .= "<td><a href='kakunin_create.php?user_id={$user_id}&renraku_id={$record["id"]}'>確認{$record["cnt"]}</a></td>";
    $output .= "<td><a href='renraku_edit.php?id={$record["id"]}'>編集</a></td>";
    $output .= "<td><a href='renraku_delete.php?id={$record["id"]}'>削除</a></td>";
    $output .= "</tr>";
  }
  // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
  // 今回は以降foreachしないので影響なし
  unset($value);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>連絡帳【一覧画面】</title>
</head>

<body>
  <fieldset>
    <legend>連絡帳【一覧画面】</legend>
    <a href="renraku_input.php">入力画面</a>
    <a href="renraku_logout.php">ログアウト</a>
    <div>
      個別ページ：
      <select type="text" name="childname" onChange="location.href=value;">
        <option value="">子どもの名前を選択</option>
        <option value="data_arata.php">あらた まっけんゆう</option>
        <option value="data_sato.php">さとう たける</option>
        <option value="data_fukushi.php">ふくし そうた</option>
        <option value="data_nagasawa.php">ながさわ まさみ</option>
        <option value="data_hirose.php">ひろせ すず</option>
        <option value="data_yoshioka.php">よしおか りほ</option>
      </select>
    </div>
    <table>
      <thead>
        <tr>
          <th>子どもの名前</th>
          <th>日にち</th>
          <th>ご連絡</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>