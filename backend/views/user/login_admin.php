<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
    <title>パンク保証データダウンロード</title>
    <?php $this->head() ?>
    <script src="<?php echo \yii\helpers\BaseUrl::base(true) ?>/js/jquery-2.1.4.min.js"></script>
    <script src="<?php echo \yii\helpers\BaseUrl::base(true) ?>/js/jquery.validate.min.js"></script>
    <script>
        var baseUrl = '<?php echo \yii\helpers\BaseUrl::base(true); ?>';
    </script>
</head>
<body>
<header id="header"><!-- <a href="#side_menu" id="navSideMenu">Side Menu</a> -->
    <h1 class="titlePage">
        パンク保証データダウンロード
    </h1>

</header>
<main id="contents">
    <div class="container">

        <?php
        $form = ActiveForm::begin([
            'id' => 'frmLogin',
            'options' => ['name' => 'frmLogin'],
        ])
        ?>
        <?php
        if(Yii::$app->session->hasFlash('error'))
        {
            ?>
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php
                echo Yii::$app->session->getFlash('error');
                ?>
            </div>
        <?php
        }
        ?>
            <div class="frmContent pt100">
                <div class="row" >
                    <div class="cell bgGray frmLabel">
                        <label for="ssid">ID</label>
                    </div>
                    <div class="cell bgGrayTrans"> <span class="toolTipMsg"> <span class="tooltipArrow"></span> <span class="tooltipInner"></span> </span>
                        <?= Html::input('text', 'ssid', Yii::$app->request->post('ssid'), ['class' => 'borderGreen borderRadius','id' => 'form-ssid']) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="cell bgGray frmLabel">
                        <label for="password">バスワード</label>
                    </div>
                    <div class="cell bgGrayTrans"> <span class="toolTipMsg"> <span class="tooltipArrow"></span> <span class="tooltipInner"></span> </span>
                        <?= Html::input('password', 'password', '', ['class' => 'borderGreen borderRadius', 'id' => 'form-password']) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="cell"></div>
                    <div class="cell">
                        <?= Html::submitButton('ログイン', ['class' => 'btnLogin bgGreen borderRadius', 'name' => 'login-button']) ?>

                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</main>
<script type="text/javascript" src="<?php \yii\helpers\BaseUrl::base(true); ?>/js/module/login.js"></script>
<footer id="footer">
    <p class="copyright">Copyright(C) Usami Koyu Corp. All Rights Reserved.</p>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
