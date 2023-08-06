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
    $id= $_POST['id'];
    $name=$_POST['name'];
    $age=$_POST['age'];
    $mail= $_POST['mail'];
    $prefecture_no=$_POST['prefecture_no'];
    $prefecture_name=$_POST['prefecture_name'];
    $prefecture_kana=$_POST['prefecture_kana'];
    $sql = 'insert into testlist(id,name,age,mail,prefecture_no,prefecture_name,prefecture_kana)
    values(:id ,:name , :age , :mail ,:prefecture_no , :prefecture_name ,:prefecture_kana)';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id',$id,PDO::PARAM_INT);
    $stmt->bindValue(':name',$name,PDO::PARAM_STR);
    $stmt->bindValue(':age',$age,PDO::PARAM_STR);
    $stmt->bindValue(':mail',$mail,PDO::PARAM_STR);
    $stmt->bindValue(':age',$age,PDO::PARAM_STR);
    $stmt->bindValue(':prefecture_no',$prefecture_no,PDO::PARAM_STR);
    $stmt->bindValue(':prefecture_name',$prefecture_name,PDO::PARAM_STR);
    $stmt->bindValue(':prefecture_kana',$prefecture_kana,PDO::PARAM_STR);
    $res =$stmt->execute();   
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
    <h2> 新規登録完了しました </h2>
        <p>id-> <?php echo $id;?><p>
        <p>name-> <?php echo $name;?><p>
        <p>age-> <?php echo $age;?><p>
        <p>email-> <?php echo $mail;?><p>
        <p>都道府県番号-> <?php echo $prefecture_no;?><p>
        <p>都道府県名-> <?php echo $prefecture_name;?><p>
        <p>都道府県かな-> <?php echo $prefecture_kana;?><p>
        <button onclick="location.href='pe-zing.php'">一覧へ戻る</button>

</body>
</html>
