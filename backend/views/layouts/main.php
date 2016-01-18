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
	<title><?= isset(Yii::$app->view->title) ? Yii::$app->view->title : 'SSサポートサイトTOP'; ?></title>
	<?php $this->head() ?>
	<script src="<?php echo \yii\helpers\BaseUrl::base(true) ?>/js/jquery-2.1.4.min.js"></script>
	<script src="<?php echo \yii\helpers\BaseUrl::base(true) ?>/js/jquery.validate.min.js"></script>
	<script>
		var baseUrl = '<?php echo \yii\helpers\BaseUrl::base(true); ?>';
	</script>
</head>
<body>
<header id="header"><a href="#side_menu" id="navSideMenu">Side Menu</a>
	<h1 class="titlePage"><?= isset(Yii::$app->view->title) ? Yii::$app->view->title : 'SSサポートサイトTOP'; ?></h1>
	<div class="navHeader">
        <span class="iconMember">ようこそ <?php
            $login_info = Yii::$app->session->get('login_info');
            echo isset($login_info['M50_USER_NAME']) ? $login_info['M50_USER_NAME'] : '';
            ?> 様</span>
        <a href="<?php echo \yii\helpers\BaseUrl::base(true).'/user/logout' ?>" class="iconLogout">ログアウト</a></div>
</header>

<?= $content ?>

<div id="sidr" class="sidr">
	<div class="closeSideMenu"><a href="#" id="sidrClose">Close</a></div>
	<?php
		if (Yii::$app->controller->route == 'site/index') {
			?>
			<ul>
				<li><a href="#" onclick="fncCard();">Usappyカード番号変更</a></li>
				<li><a href="#" onclick="fncType('regist');">作業伝票作成</a></li>
				<li><a href="<?php echo \yii\helpers\BaseUrl::base(true) ?>/maintenance.html">メンテナンス</a></li>
				<li><a href="http://220.213.238.88/asbo/?sscode=<?php echo isset($login_info['M50_SS_CD']) ? $login_info['M50_SS_CD'] : ''; ?>" target="_blank">作業予約管理へ</a></li>
				<li><a href="http://220.213.238.88/satei/?sscode=<?php echo isset($login_info['M50_SS_CD']) ? $login_info['M50_SS_CD'] : ''; ?>" target="_blank">中古車査定へ</a></li>
			</ul>
		<?php
		}
	else
	{
	?>
		<ul>
			<li><a href="<?php echo \yii\helpers\BaseUrl::base(true); ?>/menu.html">SSサポートサイトTOP</a></li>
		</ul>
	<?php
	}
	?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
