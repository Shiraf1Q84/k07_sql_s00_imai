<?php
session_start();

// POSTデータ取得
// Use $_POST instead of $POST
// $name = $_POST["name"];
// $email = $_POST["email"];
// $naiyou = $_POST["naiyou"];

// 1. DB接続します
try {
  // Use 'dbname' that matches with the table you're inserting into
  $pdo = new PDO('mysql:dbname=gs_db; charset=utf8; host=localhost',"root","root");
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

// 2. データ登録SQL作成
// Correct table name if necessary, it was 'gs_an_db' which might be a typo
$sql = "SELECT * FROM gs_an_table";
// $sql = "INSERT INTO gs_an_table(id,name,email,naiyou,indate) VALUES (NULL,:a1,:a2,:a3,sysdate())";
$stmt = $pdo->prepare($sql);
// $stmt->bindValue(':a1', $name, PDO::PARAM_STR);
// $stmt->bindValue(':a2', $email, PDO::PARAM_STR);
// $stmt->bindValue(':a3', $naiyou, PDO::PARAM_STR);
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    // $view .= '<li class="products-item">';
    // $view .= '<a href="item.php?id='.$result["*****"].'">';
    $view .= "<p>".result["indate"]."-".$result["id"]."-".$result["name"]."</p>";
    //  class="pruducts-thumb"><img src="./img/'.$result["*****"].'" width="200"></p>';
    // $view .= '<h3 class="products-title">'.$result["*****"].'</h3>';
    // $view .= '<p class="products-price">'.$result["*****"].'</p>';
    // $view .= '</a>';
    // $view .= '</li>';
  }
}

// // 4.データ登録処理後
// if ($status == false) {
//   // Typo fixed from 'ecxit' to 'exit' and 'eeror' to 'error'
//   $error = $stmt->errorInfo();
//   exit("QueryError:".$error[2]);
// } else {
//   // 5. index.phpへリダイレクト
//   header("Location: index.php");
//   exit;
// }

// Remove the data display section if it's not used for this script
// Or move it before the redirect if you need to fetch data after insertion

?>



