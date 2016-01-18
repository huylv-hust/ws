<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <script type="text/javascript">
        var base_url = '<?php echo \yii\helpers\BaseUrl::base(true); ?>';
    </script>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script src="<?php echo \yii\helpers\BaseUrl::base(true) ?>/js/jquery-2.1.4.min.js"></script>
    <script src="<?php echo \yii\helpers\BaseUrl::base(true) ?>/js/jquery.validate.min.js"></script>
    <script>
        var baseUrl = '<?php echo \yii\helpers\BaseUrl::base(true); ?>';
    </script>
</head>
<body>
<header id="header"><!-- <a href="#side_menu" id="navSideMenu">Side Menu</a> -->
    <h1 class="titlePage">ログイン</h1>
    <!-- <div class="navHeader"><span class="iconMember">ようこそ 東京 太郎 様</span><a href="login.html" class="iconLogout">ログアウト</a></div> -->
</header>
<main id="contents">
    <section class="readme">
        <p>SSID、パスワードを入力して、「ログイン」ボタンを押してください。</p>
    </section>
    <?php
        echo $content;
    ?>
</main>
<footer id="footer">
    <!-- <div class="toolbar"><a href="#" class="btnBack">戻る</a></div> -->
    <p class="copyright">Copyright(C) Usami Koyu Corp. All Rights Reserved.</p>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
