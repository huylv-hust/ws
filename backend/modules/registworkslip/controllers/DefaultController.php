<?php
namespace backend\modules\registworkslip\controllers;
use Yii;
use backend\controllers\WsController;
use backend\components\Api;
use app\models\Udenpyo;
use app\models\Sdptd01custommerseq;

use yii\data\Pagination;
class DefaultController extends WsController
{
	public function actionIndex()
    {
//		$cus = new \app\models\Sdptd01customer();
//		$cusDb = $cus->getData(['D01_KAIIN_CD' => '277426000167']);
//		print_r($cusDb);
//		die;

		$api = new Api();
		$uDenpyo = new Udenpyo();
		$cookie = \Yii::$app->request->cookies;
		//$cusInfo = $cookie->getValue('cus_info', '0');
		$cusInfo = $api->getMemberInfo('277426000167'); //
		$cusInfo['type_redirect'] = 1;
		if($cusInfo['type_redirect'] == 1) {
			$cusDb = $uDenpyo->getTd01Customer(['D01_KAIIN_CD' => $cusInfo['member_kaiinCd']]);
			$cusDb = current($cusDb);
			$cusInfo = $uDenpyo->convertKeyApiDB($cusInfo);
			$cusInfo['D01_NOTE'] = $cusDb['D01_NOTE'];
			$cusInfo['D01_KAKE_CARD_NO'] = $cusDb['D01_KAKE_CARD_NO'];
			$cusInfo['D01_CUST_NO'] = $cusDb['D01_CUST_NO'];
		}

		$car = $uDenpyo->getCar($cusInfo['D01_KAIIN_CD']); // Get Infor Car
		$tm08Sagyosya = $uDenpyo->getTm08Sagyosya(['M08_SS_CD' => $cusInfo['D01_SS_CD']]);
		$tm01Sagyo = $uDenpyo->getTm01Sagyo([]); // Work job
		$tm09WarrantyNo = $uDenpyo->getTm09WarrantyNo([]);
		$ssUser = ['0' => ''];
		if(count($tm08Sagyosya)) {
			foreach($tm08Sagyosya as $tmp) {
				$ssUser[$tmp['M08_NAME_MEI'].$tmp['M08_NAME_SEI']] = $tmp['M08_NAME_MEI'].$tmp['M08_NAME_SEI'];
			}
		}

		$data['pagination'] = new Pagination([
            'totalCount'      => $uDenpyo->countDataRecord('tm05Com',[]),
            'defaultPageSize' => 10,//Yii::$app->params['defaultPageSize'],
        ]);

		$data['filters']['limit'] = $data['pagination']->limit;
        $data['filters']['offset'] = $data['pagination']->offset;
		$tm05Com = $uDenpyo->getTm05Com($data['filters']);
		$denpyo = array();
		$denpyo = $uDenpyo->getDenpyo(['D03_DEN_NO' =>'21','D03_CUST_NO' => $cusInfo['D01_CUST_NO']]);
		if(count($denpyo) == 0) {
			$denpyo = $uDenpyo->setDefaultDataObj('denpyo');
		}
		else {
			$denpyo = current($denpyo);
		}

		$tempDenpyo = [];
		foreach($denpyo as $field => $val) {
			$tempDenpyo['denpyo'][str_replace('D03','D02',$field)] = $val;
		}

		$car = array_merge($tempDenpyo,$car);
		//print_r($denpyo);
		//die;


		//print_r($api->getListModel('1005'));
		//die;
		//print_r($car);
		//die;
	//	print_r($cus);
	//	die;
		$data['cus'] = $cusInfo;
		$data['car'] = $car;
		$data['tm05Com'] = $tm05Com;
		$data['ssUer'] = $ssUser;
		$data['tm01Sagyo'] = $tm01Sagyo;
		$data['tm09WarrantyNo'] = current($tm09WarrantyNo);

//		$m = new Sdptd04denpyosagyo();
//		$data = [
//			'D04_DEN_NO' => 2001,
//			'D04_INP_DATE' => strtoupper(date('d-M-y')),
//            'D04_INP_USER_ID' => null,
//            'D04_UPD_DATE' => null,
//            'D04_UPD_USER_ID' => null,
//		];

		//echo '<plaintext>';
		//print_r($data);

		//$m->setData($data);

		//var_dump($m->saveData());
		//print_r($m);
		//die;
		return $this->render('index',$data);
    }

	public function actionSearch() {

		$code = \Yii::$app->request->post('code');
		$uDenpyo = new Udenpyo();
		$tm05Com = $uDenpyo->getTm05Com(['M05_COM_CD' => substr($code,0,6),'M05_NST_CD' => substr($code,6,3)]);
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return current($tm05Com);
	}
	public function actionSs() {
		$ssCode = Yii::$app->request->post('ssCode');
		$uDenpyo = new Udenpyo();
		$tm08Sagyosya = $uDenpyo->getSagyosy(['M08_SS_CD' => $ssCode]);
		$ssUser = ['0' => ''];
		if(count($tm08Sagyosya)) {
			foreach($tm08Sagyosya as $tmp) {
				$ssUser[] = $tmp['M08_NAME_MEI'].$tmp['M08_NAME_SEI'];
			}
		}

		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $ssUser;
	}
	public function actionLargecom() {
		$m05KindComNo = Yii::$app->request->post('M05_KIND_COM_NO');
		$m05LargeComNo = Yii::$app->request->post('M05_LARGE_COM_NO');
		$uDenpyo = new Udenpyo();
		$tm03LagreCom = $uDenpyo->gettm03LagreCom(['M03_KIND_COM_NO' => $m05KindComNo,'M03_LARGE_COM_NO' => $m05LargeComNo]);
		$tm03LagreCom = current($tm03LagreCom);
		$tm03LagreCom['M03_HOZON_KIKAN'] = mktime(0,0,0,date('m',time()) + $tm03LagreCom['M03_HOZON_KIKAN'],date('d',time()),date('Y',time()));
		$tm03LagreCom['M03_HOZON_KIKAN'] = date('Y年m月d日',$tm03LagreCom['M03_HOZON_KIKAN']);
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $tm03LagreCom;
	}
	public function actionCus() {

		$api = new Api();
		$uDenpyo = new Udenpyo();
		$cusObj = new \app\models\Sdptd01customer();
		$request = Yii::$app->request;
		$cookie = \Yii::$app->request->cookies;
		//$cusInfo = $cookie->getValue('cus_info', '0');
		$cusInfo['type_redirect'] = 1;
		if($cusInfo['type_redirect'] == 1) { // Is member
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			$usappyId = $request->post('D01_KAIIN_CD');
			$dataCsApi = array(
				'member_kaiinName' => $request->post('D01_CUST_NAMEN'),
				'member_kaiinKana' => $request->post('D01_CUST_NAMEK'),
				'member_telNo1'    => $request->post('D01_TEL_NO'),
				'member_telNo2'    => $request->post('D01_MOBTEL_NO'),
				'member_address'   => $request->post('D01_ADDR'),
			);

			$res = $api->updateMemberBasic($usappyId, $dataCsApi);
			$resDb = 1;
			$cusDb = $cusObj->getData(['D01_KAIIN_CD' => $usappyId]);
			if(count($cusDb)) {
				$dataDb = array(
							'D01_NOTE' => $request->post('D01_NOTE'),
							'D01_KAKE_CARD_NO' => $request->post('D01_KAKE_CARD_NO')
						  );
				$cusObj->setData($dataDb,$cusDb['0']['D01_CUST_NO']);
				$resDb = (int)$cusObj->saveData();
			}

			return ['result_api' => (int)$res,'result_db' =>$resDb];
		}
		elseif($cusInfo['type_redirect'] == 2) { // has card

		}
		else { // guest


		}
	}





}
