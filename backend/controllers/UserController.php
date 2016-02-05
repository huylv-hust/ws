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
    /**
     *Login admin
     * @author: Dang Bui
     */
    public function actionLoginadmin()
    {
        $session = \Yii::$app->session;
        $count = 0;
        $list_user = Yii::$app->params['admin_user'];
        if ($user_info = Yii::$app->request->post()) {
            $id = $user_info['ssid'];
            $pass = $user_info['password'];
            foreach ($list_user as $k => $v) {
                if ($id == $v['ssid'] and $pass == $v['password']) {
                    $count++;
                }
            }
            if ($count > 0) {
                Yii::$app->session->set('login_admin_info', ['status' => 'login_success', 'expired' => time() + Yii::$app->params['timeOutLogin']]);
                $this->redirect(BaseUrl::base(true).'/operator/punc');
            } else {
                Yii::$app->session->setFlash('error', '入力されたSSＩＤまたはパスワードが正しくありません');
            }
        }

        $this->layout = '@backend/views/layouts/blank';
        return $this->render('login_admin');
    }
    /**
     *Login
     * @author: Dang Bui
     */
    public function actionLogin()
    {
        $session = \Yii::$app->session;
        if ($session->get('login_info')) {
            $this->goHome();
        }
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
    /**
     *Logout
     * @author: Dang Bui
     */
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