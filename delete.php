<?php
$dsn = 'mysql:host=chuujoutakakinoMacBook-Air.local;dbname=test;charset=utf8';
$user = 'root';
$pass = 'takaki0228';
   try{
    $dbh = new PDO($dsn,$user,$pass,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
   ]);
    }catch(PDOException $e) {
        echo '接続失敗' . $e->getMessage();
        exit();
    };
    
    ?>
    <!DOCTYPE html>
    <html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php $id=$_POST['check'];
        foreach($id as $result) {
    $sql = "DELETE FROM testlist WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':id',$result,PDO::PARAM_INT);
    $res = $stmt->execute();
        }
    ?>
        <h3>削除しました</h3>
        <button onclick="location.href='pe-zing.php'">一覧へ戻る</button>
    </body>
    </html>