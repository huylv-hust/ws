<?php
namespace backend\controllers;

use Yii;

use yii\helpers\BaseUrl;
use yii\web\Controller;
use app\models\Tm50ssuser;

/**
 * Created by PhpStorm.
 * User: HP400
 * Date: 1/12/2016
 * Time: 8:44 AM
 */
class UserController extends Controller
{
    public function actionLogin()
    {
        if (\Yii::$app->session->has('login_info')) {
            return $this->goHome();
        }

        $user = new Tm50ssuser();
        if (Yii::$app->request->post()) {
            $isLogin = $user->checkLogin(Yii::$app->request->post());
            if ($isLogin['flag']) {
                $login_info = $isLogin['sql']['0'];
                $login_info['expired'] = time() + Yii::$app->params['timeOutLogin'];
                Yii::$app->session->set('login_info', $login_info);
                $this->redirect(BaseUrl::base(true).'/menu.html');
            } else {
                Yii::$app->session->setFlash('error', '入力されたSSＩＤまたはパスワードが正しくありません');
            }
        }

        $this->layout = 'login';
        return $this->render('login');
    }

    public function actionLogout()
    {
        $session = Yii::$app->session;
        $session->remove('login_info');
        unset($session['login_info']);
        Yii::$app->session->setFlash('success_logout', '<span class="noti">ログアウトしました。</span>');
        $this->redirect(BaseUrl::base(true).'/login.html');
    }
}