
<?php
$dsn = 'mysql:host=chuujoutakakinoMacBook-Air.local;dbname=test;charset=utf8';
$user = 'root';
$pass = 'takaki0228';
   try{
    $dbh = new PDO($dsn,$user,$pass,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
   ]);
   $sql = 'SELECT * FROM testlist';
   $stmt = $dbh->query($sql);
   $result = $stmt->fetchall(PDO::FETCH_ASSOC);
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
    <form method="POST" action="?">
        <input type="submit" value="新規登録する" formaction="new.php">
    <?php foreach($result as $column): ?>

        <p>
            <label for="checkbox<?php echo $column['id']?>"></label>
            <input type="checkbox" id="checkbox<?php echo $column['id']?>" name="check[]" value="<?php echo $column['id']?>"> 
            <a href="kkk.php?id=<?php echo $column['name']?>"> <?php echo $column['id'] . '=' .  $column['name']?></a>
        </p>


    <?php endforeach; ?>
        <input type="submit" value="削除する" onclick="buttonClick()" formaction="delete.php">
        <?php echo "<script>function buttonClick(){
                    alert('削除しますか?');
        }           </script>"; ?>
    </form>




</body>
</html>