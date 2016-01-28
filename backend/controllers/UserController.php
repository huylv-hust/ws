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
        $user = new Tm50ssuser();
        if (Yii::$app->request->post()) {
            $isLogin = $user->checkLogin(Yii::$app->request->post());
            if ($isLogin['flag']) {
                $login_info = $isLogin['sql']['0'];
                $login_info['expired'] = time() + Yii::$app->params['timeOutLogin'];
                Yii::$app->session->set('login_info', $login_info);
                $this->redirect(BaseUrl::base(true).'/menu');
            } else {
                Yii::$app->session->setFlash('error', '入力されたSSＩＤまたはパスワードが正しくありません');
            }
        }
        \Yii::$app->params['titlePage'] = 'ログイン';
        \Yii::$app->view->title = 'ログイン';
        $this->layout = '@backend/views/layouts/blank';
        return $this->render('login');
    }

    public function actionLogout()
    {
        $session = Yii::$app->session;
        $session->remove('login_info');
        unset($session['login_info']);
        Yii::$app->session->setFlash('success_logout', '<span class="noti">ログアウトしました。</span>');
        $this->redirect(BaseUrl::base(true).'/login');
    }

    /**
     *time out
     * @author: Dang Bui
     */
    public function actionTimeout()
    {
        \Yii::$app->params['titlePage'] = 'エラー';
        \Yii::$app->view->title = 'エラー';
        $this->layout = '@backend/views/layouts/error';
        return $this->render('timeout');
    }

    /**
     *error page
     * @author: Dang Bui
     */
    public function actionError()
    {
        \Yii::$app->params['titlePage'] = 'エラー';
        \Yii::$app->view->title = 'エラー';
        $this->layout = '@backend/views/layouts/error';
        return $this->render('error');
    }

}