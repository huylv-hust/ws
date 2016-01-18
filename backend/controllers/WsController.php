<?php
namespace backend\controllers;

use yii\helpers\BaseUrl;
use yii\web\Controller;
use Yii;

class WsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $session = \Yii::$app->session;
        if ($login_info = $session->get('login_info') and $login_info['expired'] < time()) {
            $session->remove('login_info');
            unset($session['login_info']);
        }
        if ($loginInfo = $session->get('login_info')) {
            $login_info['expired'] = time() + 30 * 60;
            $session->set('login_info', $login_info);
        }

        if (! \Yii::$app->session->has('login_info')) {
            return $this->redirect(BaseUrl::base(true).'/login.html');
        }
    }
}