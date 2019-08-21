<?php

// ユーザーの一覧

require_once(__DIR__ . '/../config/config.php');

// var_dump($_SESSION['me']);
$app = new MyApp\Controller\Thread();

$app->run();
$threadModel = new \MyApp\Model\Thread();
$threads = $threadModel->getTHREAD_list();
$threadid = $_GET['threadid'];
$threadTitle = $threadModel->getTHREAD_title($threadid);
$responses = $threadModel->getRes($threadid);
$maxres= $threadModel->getResnum($threadid);
$newResNum = $maxres + 1;




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
    <h2>返信一覧</h2>


    <input type="submit" onclick="location.href='./index.php'" name="" value="スレッド一覧へ">
    <br>
    <?= h($threadTitle) ?>
    <br>
    <dl>
    <?php foreach ($responses as $res): ?>
            <li>
              <?= h($res['commentid'].":") . h($res['writer'].":") . h($res['content'])  ?>
            </li>
    <?php endforeach; ?>
    </dl>
  </div>
  <div class="content">
    <h2>返信</h2>
    <form class="postform" action=""   method="post" id="postform">
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
      <input type="hidden" name="writer" value="<?= h($app->me()->username); ?>">
      <input type="hidden" name="threadid" value="<?= h($threadid); ?>">
      <input type="hidden" name="newResNum" value="<?= h($newResNum); ?>">

      <textarea class="content" name="content" id="content" rows="8" cols="80"></textarea>
      <br>
      <p class="err"><?= h($app->getErrors('write')); ?></p>
      <div class="btn" onclick="document.getElementById('postform').submit();">返信する</div>
      <input class="input" type="reset" value="リセット">

    </form>

  </div>
</body>
</html>
