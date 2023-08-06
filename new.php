<?php
$dsn = 'mysql:host=chuujoutakakinoMacBook-Air.local;dbname=test;charset=utf8';
$user = 'root';
$pass = 'takaki0228';
try{
$dbh = new PDO($dsn,$user,$pass,[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
   
]);
}catch(PDOException $e) {
    echo '接続失敗' . $e->getMessage();
    exit();
};
$sql = 'SELECT * FROM prefecture_mst';
   $stmtMst = $dbh->query($sql);
   $resultMst = $stmtMst->fetchall(PDO::FETCH_ASSOC);
$max = 'SELECT id FROM testlist WHERE id = (SELECT MAX(id) FROM testlist)';
$stmt = $dbh->query($max);
   $result = $stmt->fetch(PDO::FETCH_ASSOC);
   $resultId = $result['id'] + 1;
   
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
    <form action="create.php" method="POST"> 
        <input type="hidden" name="id" value="<?php echo $resultId?>">

        <label for="name">名前:</label>
        <input type="text"  name="name" value=""> <br>
        <label for="age">年齢:</label>
        <input type="text"  name="age" value=""> <br>
        <label for="email">メールアドレス:</label>
        <input type="email" name="mail" value=""><br>
        
        <div>
		    <label for="prefecture_no">都道府県番号</label>
            <select name="prefecture_no">
                <option value="<?php echo $result['prefecture_no'] ?>" selected>選択してください</option>
                <?php foreach($resultMst as $column):?>
                <option value="<?php echo $column['prefecture_no'] ?>"> <?php echo $column['prefecture_no']?></option>
                <?php endforeach;?> 
            </select>
            <br>
            <label for="prefecture_no">都道府県名</label>
            <select name="prefecture_name">
                <option value="<?php echo $result['prefecture_name'] ?>" selected>選択してください</option>
                <?php foreach($resultMst as $column):?>
                <option value="<?php echo $column['prefecture_name'] ?>"> <?php echo $column['prefecture_name']?></option>
                <?php endforeach;?> 
            </select>
            <br>
            <label for="prefecture_no">都道府県カナ</label>
            <select name="prefecture_kana">
                <option value="<?php echo $result['prefecture_kana'] ?>" selected>選択してください</option>
                <?php foreach($resultMst as $column):?>
                <option value="<?php echo $column['prefecture_kana'] ?>"> <?php echo $column['prefecture_kana']?></option>
                <?php endforeach;?>
            </select>
            <br>
        </div>
        <input type="submit" value="登録する">
    </form> 
</body>
</html>

