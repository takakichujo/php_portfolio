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
     if(!isset($_GET['page_id'])){ // $_GET['page_id'] はURLに渡された現在のページ数
        $now = 1; // 設定されてない場合は1ページ目にする
    }else{
        $now = $_GET['page_id'];
    }

    $max=5;
    $count_sql = 'SELECT COUNT(*) as cnt FROM testlist';
      $counts = $dbh -> query($count_sql);
      $count = $counts -> fetch(PDO::FETCH_ASSOC);
    //   echo $count['cnt'];
      $max_page = ceil($count['cnt'] / $max);
      $limitSet = ($now-1) * $max;
      if($now == 1) {
      $sql = 'SELECT * FROM testlist limit 5';
      $stmt = $dbh->query($sql);
      $result = $stmt->fetchall(PDO::FETCH_ASSOC);
      }else {
        $sql = 'SELECT * FROM testlist limit :sqlLimit , 5';
        $stmt = $dbh->prepare( $sql );
        $stmt->bindValue(':sqlLimit', $limitSet, PDO::PARAM_INT );
        $stmt->execute();
        $result = $stmt->fetchall(PDO::FETCH_ASSOC);
        
      };?>
     <?php function before() {?>
        <?php global $now;
             if($now==1):?>
            <li><a href="pe-zing.php?page_id=<?php echo $now;?>">前へ</a></li>
            
        <?php else: ?>
        <li><a href="pe-zing.php?page_id=<?php echo $now -1;?>">前へ</a></li>
        <?php endif;?>
      <?php } ?>
      <?php function after() {?>
        <?php global $now;
              global $max_page;
             if($now == $max_page):?>
            <li><a href="pe-zing.php?page_id=<?php echo $now;?>">次へ</a></li>
            
        <?php else: ?>
        <li><a href="pe-zing.php?page_id=<?php echo $now +1;?>">次へ</a></li>
        <?php endif;?>
      <?php } ?>


    
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.CSS">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="?">
        <input type="submit" value="新規登録する" formaction="new.php">
    <?php foreach($result as $column): ?>

        <p>
            
            <label for="checkbox<?php echo $column['id']?>"></label>
            <input type="checkbox" id="checkbox<?php echo $column['id']?>" name="check[]" value="<?php echo $column['id']?>"> 
            <a href="kkk.php?id=<?php echo $column['name']?>" class="name-list"> <?php echo $column['id'] . '=' .  $column['name']?></a>
        </p>


    <?php endforeach; ?>
        <input type="submit" value="削除する" onclick="buttonClick()" formaction="delete.php">
        <?php echo "<script>function buttonClick(){
                    alert('削除しますか?');
        }           </script>"; ?>
    </form>
    <ul class="paging-page">
        <?php before();?>
    <?php for($paging=1; $paging<=$max_page; $paging++):?>
        <li><a href="pe-zing.php?page_id=<?php echo $paging?>"> <?php echo $paging?></a></li>
    <?php endfor; ?>
        <?php after();?>
    </ul>




</body>
</html>