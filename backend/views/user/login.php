<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="container">
    <?php
    if(Yii::$app->session->hasFlash('success_logout'))
    {
        echo Yii::$app->session->get('success_logout');
    }
    ?>
        <?php
            if(Yii::$app->session->hasFlash('error'))
            {
        ?>
    <div class="alert alert-warning">
        <?php
            echo Yii::$app->session->getFlash('error');
        ?>
    </div>
        <?php
            }
        ?>
    <?php
    $form = ActiveForm::begin([
        'id' => 'frmLogin',
        'options' => ['name' => 'frmLogin'],
    ])
    ?>
        <div class="frmContent">
            <div class="row">
                <div class="cell bgGray frmLabel">
                    <label for="ssid">SSID</label>
                </div>
                <div class="cell bgGrayTrans">
                    <?= Html::input('text', 'ssid', Yii::$app->request->post('ssid'), ['class' => 'borderGreen borderRadius']) ?>
                </div>
            </div>

            <div class="row">
                <div class="cell bgGray frmLabel">
                    <label for="password">バスワード</label>
                </div>
                <div class="cell bgGrayTrans">
                    <?= Html::input('password', 'password', '', ['class' => 'borderGreen borderRadius']) ?>
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
<script type="text/javascript" src="js/module/login.js"></script>

