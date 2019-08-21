<?php

// ユーザーの一覧

require_once(__DIR__ . '/../config/config.php');

// var_dump($_SESSION['me']);
$app = new MyApp\Controller\Index();

$app->run();
$threadModel = new \MyApp\Model\Thread();
$threads = $threadModel->getTHREAD_list();




?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="header">
    <a href="index.php" Align="center"><h3>掲示板</h3></a>
    <!-- <div class="icon" style="border:solid 8px  #009900;">
    </div> -->
    <div Align="right">
      <div style="background-color:#00CED1; color:black; width:50px; height:50px; margin:10px; display:inline-block; font-size:20px">アイコン</div>
      <form action="logout.php" method="post" id="logout" style="display:inline-block;">
        <P style="display:inline;">
          <?=h($app->me()->username); ?>:
          (<?=h($app->me()->email); ?>)
          <input class="btnLogOut" type="submit" value="Log Out" style="display:inline">
        </p>
        <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
      </form>

    </div>
  </div>


  <div class="content">
    <h2>スレッド一覧</h2>
    <input type="submit" onclick="location.href='./create_thread.php'" name="" value="新しいスレッドをたてる">
    <br>
    <dl>
    <?php foreach ($threads as $thread): ?>
            <li>
              <a href ="thread.php?threadid= <?= h($thread['id']) ?> ">
              <?= h($thread['id'].":")?><?=h($thread['title'])?>
              </a>
            </li>
    <?php endforeach; ?>
    </dl>
  </div>
</body>
</html>
