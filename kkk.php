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
$name = $_GET['id'];

$stmt = $dbh->prepare('SELECT * from testlist Where name=:name');
$stmt->bindValue(':name',$name,PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);


$sql = 'SELECT * FROM prefecture_mst';
   $stmtMst = $dbh->query($sql);
   $resultMst = $stmtMst->fetchall(PDO::FETCH_ASSOC);
   
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
    <form action="confirm.php" method="POST">
        <label for="name">id:</label>
        <input type="text"  name="id"  value="<?php echo $result['id'] ?>" Readonly> <br>
        <label for="name">名前:</label>
        <input type="text"  name="name" value="<?php echo $result['name'] ?>"> <br>
        <label for="age">年齢:</label>
        <input type="text"  name="age" value="<?php echo $result['age'] ?>"> <br>
        <label for="email">メールアドレス:</label>
        <input type="email" name="mail" value="<?php echo $result['mail'] ?>"><br>
        
        <div>
		    <label for="prefecture_no">都道府県番号</label>
            <select name="prefecture_no">
                <option value="<?php echo $result['prefecture_no'] ?>" selected><?php echo $result['prefecture_no'] ?></option>
                <?php foreach($resultMst as $column):?>
                <option value="<?php echo $column['prefecture_no'] ?>"> <?php echo $column['prefecture_no']?></option>
                <?php endforeach;?> 
            </select>
            <br>
            <label for="prefecture_no">都道府県名</label>
            <select name="prefecture_name">
                <option value="<?php echo $result['prefecture_name'] ?>" selected><?php echo $result['prefecture_name'] ?></option>
                <?php foreach($resultMst as $column):?>
                <option value="<?php echo $column['prefecture_name'] ?>"> <?php echo $column['prefecture_name']?></option>
                <?php endforeach;?> 
            </select>
            <br>
            <label for="prefecture_no">都道府県カナ</label>
            <select name="prefecture_kana">
                <option value="<?php echo $result['prefecture_kana'] ?>" selected><?php echo $result['prefecture_kana'] ?></option>
                <?php foreach($resultMst as $column):?>
                <option value="<?php echo $column['prefecture_kana'] ?>"> <?php echo $column['prefecture_kana']?></option>
                <?php endforeach;?>
            </select>
            <br>
        </div>
        <input type="submit" name="confirm" value="更新する">
    </form> 
</body>
</html>

