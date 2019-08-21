<?php

require_once(__DIR__ . '/../config/config.php');

$app = new MyApp\Controller\Create_Thread();

$app->run();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
  <title>New Thread</title>
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
      </form>

    </div>
  </div>
  <div class="postform">
    <h2>新規スレッド</h2>
    <input type="submit" onclick="location.href='./index.php'" name="" value="スレッド一覧へ">

    <form class="postform" action=""   method="post" id="postform">
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
      <input type="hidden" name="createdby" value="<?= h($app->me()->username); ?>">
      <!-- <h3>名前</h3> -->
      <h3>タイトル</h3>
      <input type="text" name="title" id="title"   value="">
      <p class="err"><?= h($app->getErrors('title')); ?></p>
      <h3>本文</h3>
      <textarea class="content" name="content" id="content" rows="8" cols="80"></textarea>
      <br>
      <p class="err"><?= h($app->getErrors('write')); ?></p>
      <div class="btn" onclick="document.getElementById('postform').submit();">新しいスレッドをたてる</div>
      <input class="input" type="reset" value="リセット">

    </form>
  </div>

</body>
</html>
