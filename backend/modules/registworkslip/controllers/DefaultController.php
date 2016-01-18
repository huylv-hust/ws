<?php
namespace backend\modules\registworkslip\controllers;
use Yii;
use backend\controllers\WsController;
use backend\components\api;
use app\models\Udenpyo;
use app\models\Sdptd01custommerseq;

use yii\data\Pagination;
class DefaultController extends WsController
{
	public function actionIndex()
    {

		$api = new api();
		$uDenpyo = new Udenpyo();
		$carDefault = $uDenpyo->setDefaultDataObj('car');
		$cusInfo = $uDenpyo->setDefaultDataObj('customer');
		$d03DenNo = 0;
		$totalCarOfCus = 0;
		$car = array(); // No car
		$data['d03DenNo'] = $d03DenNo;
		if($d03DenNo == 0) { // created denpyo
			$denpyo = $uDenpyo->setDefaultDataObj('denpyo'); // set default data
			$cookie = \Yii::$app->request->cookies; // get info cus from cookie
			//$cusInfo = $cookie->getValue('cus_info', '0');
			$cusInfo = $api->getMemberInfo('277426000167'); //
			$cusInfo['type_redirect'] = 1; // check is member or is has card, is guest
			if($cusInfo['type_redirect'] == 1) {  // created denpyo is member
				$uDenpyo->getInforCarCusFromApi($uDenpyo, $api, $carDefault, $cusInfo, $totalCarOfCus, $car);
			}
			else {

				$car = array_pad($car,5,$carDefault);
			}

		}
		else { //
			if($cusInfo['type_redirect'] == 1) {  // edit is member
				$uDenpyo->getInforCarCusFromApi($uDenpyo, $api, $carDefault, $cusInfo, $totalCarOfCus, $car);// get info member and car
			}
			else { // edit is db
				$denpyo = $uDenpyo->getDenpyo(['D03_DEN_NO' => $d03DenNo]);
				$denpyo = current($denpyo);
				$cusDb = $uDenpyo->getTd01Customer(['D01_CUST_NO' => $denpyo['D03_CUST_NO']]);
				$cusInfo = current($cusDb);
				$car = $uDenpyo->getCar($cusInfo['D01_CUST_NO']); // Get Infor Car
				$totalCarOfCus = count($car);
				$car = array_pad($car,5,$carDefault);
			}
		}
		$tempDenpyo['denpyo'] = $denpyo;
		$car = array_merge($tempDenpyo,$car);
		$tm01Sagyo = $uDenpyo->getTm01Sagyo([]); // Work job
		$tm09WarrantyNo = $uDenpyo->getTm09WarrantyNo([]);
		$ssUser = ['0' => ''];
		$tm08Sagyosya = $uDenpyo->getTm08Sagyosya(['M08_SS_CD' => '277426']); // 277426 Is login
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

		//print_r($denpyo);
		//die;


		//print_r($api->getListModel('1005'));
		//die;
		//print_r($car);
		//die;
	//	print_r($cus);
	//	die;
		$data['totalCarOfCus'] = $totalCarOfCus;
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
		$tm08Sagyosya = $uDenpyo->getTm08Sagyosya(['M08_SS_CD' => $ssCode]);
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
	public function actionCar() {

		$uDenpyo = new Udenpyo();
		$carObj = new \app\models\Sdptd02car();
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$request = \Yii::$app->request;
		$data = \Yii::$app->request->post('dataPost');
		$data = json_decode($data,true);
		$denpyoNo = $request->post('D03_DEN_NO');
		$custNo = $request->post('D02_CUST_NO');
		$carSeqInsert = [];
		foreach($data as $tmp) {
			$carSeqInsert[] = $tmp['D02_CAR_SEQ'];
		}

		if( ! $request->post('D02_CUST_NO')) { // Is guest not database
			return ['result' => 0];
		}
		else
		{
			return $uDenpyo->updateCar($custNo, $carSeqInsert,$data);
		}

	}
	public function actionMaker()
	{
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$api = new api();
		$request = Yii::$app->request;
		$maker_code = $request->post('car_maker_code','');
		$model_code = $request->post('car_model_code','');
		$year = $request->post('car_year','');
		$year = substr($year,0,4);
		$type_code = $request->post('car_type_code','');
		$level = $request->post('level','');
		if($maker_code && $model_code && $year && $type_code && $level == 4)
		{
			$list_grade_code = $api::getListGradeCode($maker_code,$model_code,$year,$type_code);
			$list_grade = [];
			foreach($list_grade_code as $gra) {
				$list_grade[$gra['grade_code']] = $gra['grade'];
			}

			return $list_grade;

		}

		if($maker_code && $model_code && $year && $level == 3)
		{
			$list_type_code = $api::getListTypeCode($maker_code,$model_code,$year);
			$list_type = [];
			foreach($list_type_code as $tp) {
				$list_type[$tp['type_code']] = $tp['type'];
			}
			return $list_type;
		}

		if($maker_code && $model_code && $level == 2)
		{
			$list_year = $api::getListYearMonth($maker_code,$model_code);
			$option = '<option value="0">初度登録年を選択して下さい</option>';
			if( ! isset($list_year['result']))
			{
				$option = str_replace('<option value="0"></option>','<option value="0">初度登録年を選択して下さい</option>',\Constants::array_to_option($list_year,'year','year'));
			}

			return new \Response($option, 200,array());
		}

		if($maker_code && $level == 1)
		{
			$list_model_code = $api::getListModel($maker_code);
			$list_model = [];
			foreach($list_model_code as $mod) {
				$list_model[$mod['model_code']] = $mod['model'];
			}

			return $list_model;
		}
	}
	public function actionCus() {

		$api = new api();
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
