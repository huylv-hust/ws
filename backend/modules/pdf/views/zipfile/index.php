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
    <h1 class="titlePage">
        <?php echo isset(Yii::$app->params['titlePage']) ? Yii::$app->params['titlePage'] : ''; ?>
    </h1>

</header>
<main id="contents">
    <article class="container">
        <form class="pt50" action="<?php echo \yii\helpers\BaseUrl::base(true); ?>/operator/punc" id="form_download_zip" method="post">
            <section class="bgContent">
                <div class="formGroup">
                    <div class="formItem">
                        <label class="titleLabel">保証書作成日</label>

                        <?php
                            echo Html::dropDownList('start_year', Yii::$app->request->post('start_year') ? Yii::$app->request->post('start_year') : $select_date['year'], $select_date['year_now'], ['class' => 'selectForm']);
                        ?>
                        <span class="txtUnit">年</span>
                        <?php
                        echo Html::dropDownList('start_month', Yii::$app->request->post('start_month') ? Yii::$app->request->post('start_month') : $select_date['month'], Yii::$app->params['zippdf']['month'], ['class' => 'selectForm']);
                        ?>
                        <span class="txtUnit">月</span>
                        <?php
                        echo Html::dropDownList('start_day', Yii::$app->request->post('start_day') ? Yii::$app->request->post('start_day') : $select_date['day'], Yii::$app->params['zippdf']['day'], ['class' => 'selectForm']);
                        ?>
                        <span class="txtUnit">日〜</span>
                        <?php
                        echo Html::dropDownList('end_year', Yii::$app->request->post('end_year') ? Yii::$app->request->post('end_year') : $select_date['year'], $select_date['year_now'], ['class' => 'selectForm']);
                        ?>
                        <span class="txtUnit">年</span>
                        <?php
                        echo Html::dropDownList('end_month', Yii::$app->request->post('end_month') ? Yii::$app->request->post('end_month') : $select_date['month'], Yii::$app->params['zippdf']['month'], ['class' => 'selectForm']);
                        ?>
                        <span class="txtUnit">月</span>
                        <?php
                        echo Html::dropDownList('end_day', Yii::$app->request->post('end_day') ? Yii::$app->request->post('end_day') : $select_date['day'], Yii::$app->params['zippdf']['day'], ['class' => 'selectForm']);
                        ?>
                        <span class="txtUnit">日</span> </div>
                        <input type="hidden" id="form-type-download" name="type-download" value="" />
                </div>
            </section>
            <div class="areaBtn">
                <div class="itemLeft"><input type="button" id="downloadcsv" class="btnSubmit wide" value="CSVダウンロード"></div>
                <div class="itemRight"><input type="button" id="downloadpdf" class="btnSubmit wide" value="PDFダウンロード"></div>
            </div>
        </form>

        <div class="clearfix" style="margin: 20px 0">
            <?php
            if (Yii::$app->session->hasFlash('error')) {
                ?>
                <div class="alert alert-danger">
                    <?php
                    echo Yii::$app->session->getFlash('error');
                    ?>
                </div>
            <?php
            }
            ?>
            <?php
            if (Yii::$app->session->hasFlash('success')) {
                ?>
                <div class="alert alert-success">
                    <?php
                    echo Yii::$app->session->getFlash('success');
                    ?>
                </div>
            <?php
            }
            ?>
        </div>
    </article>
</main>
<footer id="footer">
    <p class="copyright">Copyright(C) Usami Koyu Corp. All Rights Reserved.</p>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<script type="text/javascript">
    //Download csv
    $('#downloadcsv').click(function(){
        $('.alert').hide();
        $('#form-type-download').attr('value','csv');
        $('#form_download_zip').submit();
    });
    //Download pdf
    $('#downloadpdf').click(function(){
        $('.alert').hide();
        $('#form-type-download').attr('value','pdf');
        $('#form_download_zip').submit();
    });

</script>