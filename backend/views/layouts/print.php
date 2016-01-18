<?php
use backend\assets\AppAsset;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
        var baseUrl = '<?php echo \yii\helpers\BaseUrl::base(true); ?>';
    </script>

    <link rel="stylesheet" href="<?php echo \yii\helpers\BaseUrl::base(true) ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo \yii\helpers\BaseUrl::base(true) ?>/font-awesome/css/font-awesome.min.css">
</head>
<body>
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
