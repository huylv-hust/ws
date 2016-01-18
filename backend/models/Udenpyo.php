<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\models;
use yii\db\Query;
class Udenpyo
{
	private $customer;
	private $car;
	private $denpyo;
	private $denpyoSagyo;
	private $denpyoCom;
	private $tm05Com;
	private $tm08Sagyosya;
	private $tm03LagreCom;
	private $tm01Sagyo;
	private $tm09WarrantyNo;


	function __construct() {

		$this->customer = new Sdptd01customer();
		$this->car = new Sdptd02car();
		$this->denpyo = new Sdptd03denpyo();
		$this->denpyoSagyo = new Sdptd04denpyosagyo();
		$this->denpyoCom = new Sdptd05denpyocom();
		$this->tm05Com = new Sdptm05com();
		$this->tm08Sagyosya = new Sdptm08sagyosya();
		$this->tm03LagreCom = new Sdptm03largecom();
		$this->tm01Sagyo = new Sdptm01sagyo();
		$this->tm09WarrantyNo = new Sdptm09warrantyno();
	}

	function getCar($d02CustNo = null) {
		if($d02CustNo == null) {
			return [];
		}

		$dataCar = $this->car->getData(['D02_CUST_NO' => $d02CustNo]);
		return $dataCar;
	}

	public function getDenpyo($filters) {

		$dataDenpyo = $this->denpyo->getData($filters);
		return $dataDenpyo;
	}

	public function getDenpyoCom($filters = []) {
		$dataDenpyoCom = $this->denpyoCom->getData($filters);
		return $dataDenpyoCom;
	}
	public function countDataRecord($obj,$filters)
	{
		return $this->$obj->coutData($filters);
	}
	public function setDefaultDataObj($obj) {

		return $this->$obj->setDataDefault();
	}

	public function getTm05Com($filters) {
		return $this->tm05Com->getData($filters);
	}
	public function getTm08Sagyosya($filters) {
		return $this->tm08Sagyosya->getData($filters);
	}

	public function getTm01Sagyo($filters) {

		return $this->tm01Sagyo->getData($filters);
	}
	public function getTd01Customer($filters) {

		return $this->customer->getData($filters);
	}

	public function getTm09WarrantyNo($filters) {

		return $this->tm09WarrantyNo->getData($filters);
	}
	public function gettm03LagreCom($filters)
	{
		return $this->tm03LagreCom->getData($filters);

	}
	public function convertKeyApiDB($cus) {

		return [
			'D01_KAIIN_CD'		=> $cus['member_kaiinCd'],
			'D01_CUST_NAMEN'    => $cus['member_kaiinName'],
			'D01_CUST_NAMEK'    => $cus['member_kaiinKana'],
			'D01_TEL_NO'        => $cus['member_telNo1'],
			'D01_MOBTEL_NO'     => $cus['member_telNo2'],
			'D01_ADDR'          => $cus['member_address'],
			'D01_KAKE_CARD_NO'  => '',
			'D01_SS_CD'         => $cus['member_ssCode'],
		];
	}


	public function getDenpyoSeq()
	{
		$command = \Yii::$app->db->createCommand('SELECT SDP_TD03_DENPYO_SEQ.nextval FROM dual');
		$res = $command->queryAll();
		return $res['0']['NEXTVAL'];
	}

	public function getCusSeq()
	{
		$command = \Yii::$app->db->createCommand('SELECT SDP_TD01_CUSTOMER.nextval FROM dual');
		$res = $command->queryAll();
		return $res['0']['NEXTVAL'];
	}

	public function convertKeyApiDbCar($getCarApi) {

		$carApis = [];
		foreach($getCarApi as $key => $row) {
			if(is_array($row)) {
				for($i = 0 ; $i < count($row);++$i) {
					$carApis[$i][$key]= $row[$i];
				}
			}
			else {
				$carApis['infor'][$key]= $row;
			}
		}
		$info = $carApis['infor'];
		unset($carApis['infor']);
		$arr = [];
		foreach($carApis as $car)
		{
			$arr[] = [
				'D02_CUST_NO' => 0,
				'D02_CAR_SEQ' => $car['car_carSeq'],
				'D02_CAR_NAMEN' => $car['car_carName'],
				'D02_JIKAI_SHAKEN_YM' => $car['car_jikaiSyakenYmd'],
				'D02_METER_KM' => $car['car_meterKm'],
				'D02_SYAKEN_CYCLE' => $car['car_syakenCycle'],
				'D02_RIKUUN_NAMEN' => $car['car_riunJimusyoName'],
				'D02_CAR_ID' => 0,//
				'D02_HIRA' => $car['car_hiragana'],
				'D02_CAR_NO' => $car['car_carNo'],
				'D02_INP_DATE' => date('y-M-d'),
				'D02_INP_USER_ID' => 0,//
				'D02_UPD_DATE' =>date('y-M-d'),//
				'D02_UPD_USER_ID' => 0,//
				'D02_MAKER_CD' => $car['car_makerCd'],
				'D02_MODEL_CD' => $car['car_modelCd'],
				'D02_SHONENDO_YM' => $car['car_syoNendoInsYmd'],
				'D02_TYPE_CD' => $car['car_typeCd'],
				'D02_GRADE_CD' => $car['car_gradeCd'],
				'car_haikiRyou' => $car['car_haikiRyou'],
				'car_gradeNamen' => $car['car_gradeNamen'],
				'car_syataiBangou' => $car['car_syataiBangou'],
				'car_makerNamen' => $car['car_makerNamen'],
				'car_ruibetuKbn' => $car['car_ruibetuKbn'],
				'car_bodyColor' => $car['car_bodyColor'],
				'car_styleBangou' => $car['car_styleBangou'],
				'car_totalJyuuryou' => $car['car_totalJyuuryou'],
				'car_yunyu' => $car['car_yunyu'],
				'car_gendokiStyle' => $car['car_gendokiStyle'],
				'car_maxSekisai' => $car['car_maxSekisai'],
				'car_modelNamen' => $car['car_modelNamen'],
				'car_jyuuryou' => $car['car_jyuuryou'],
				'car_style' => $car['car_style'],
				'car_syubetu' => $car['car_syubetu'],
				'car_typeNamen' => $car['car_typeNamen'],
				'car_mission' => $car['car_mission'],
				'car_handler' => $car['car_handler'],
				'car_riunJimusyoName' => $car['car_riunJimusyoName'],
				'carLength' => $info['carLength']
			];
		}

		return $arr;
	}

	function getInforCarCusFromApi($uDenpyo,$api,$carDefault,&$cusInfo,&$totalCarOfCus,&$car) {
		$cusDb = $uDenpyo->getTd01Customer(['D01_KAIIN_CD' => $cusInfo['member_kaiinCd']]);
		$cusDb = current($cusDb);
		$cusInfo = $uDenpyo->convertKeyApiDB($cusInfo);
		//$car = $uDenpyo->getCar($cusDb['D01_CUST_NO']); // Get Infor Car DB
		$getCarApi = $api->getInfoListCar($cusInfo['D01_KAIIN_CD']); // Api
		$car = $uDenpyo->convertKeyApiDbCar($getCarApi);
		$cusInfo['D01_NOTE'] = $cusDb['D01_NOTE'];
		$cusInfo['D01_KAKE_CARD_NO'] = $cusDb['D01_KAKE_CARD_NO'];
		$cusInfo['D01_CUST_NO'] = $cusDb['D01_CUST_NO'];
		$totalCarOfCus = count($car);
		$car = array_pad($car,5,$carDefault);
	}

	public function deleteDataObj($obj,$where)
	{
		return $this->$obj->deleteData($where);
	}

	public function updateCar($custNo,$carSeqInsert,$data) {
		try {
			//\yii\db\Connection::EVENT_BEGIN_TRANSACTION;
			$listDenpyo = $this->getDenpyo(['D03_CUST_NO'=>$custNo]);
			$carSeqUsed = [];

			if(count($listDenpyo)) {
				foreach($listDenpyo as $key => $row) {
					$carSeqUsed[] = $row['D03_CAR_SEQ'];
				}
			}

			if(count($carSeqInsert) == 0 && count($carSeqUsed)) { // delete all
				return ['result' => -1]; // No delete used
			}
			else
			{
				if(count($carSeqUsed)) { // User
					$compe = array_diff($carSeqUsed, $carSeqInsert);
					if(count($compe))
						return ['result' => 0];
				}
			}

			$this->deleteDataObj('car','D02_CUST_NO = '.$custNo);
			if($this->car->saveDataMuti($data) > 0) {
				return ['result' => 1];
			}
			else
			{
				//\yii\db\Connection::EVENT_ROLLBACK_TRANSACTION;
				return ['result' => 0];

			}
			//\yii\db\Connection::EVENT_COMMIT_TRANSACTION;
		}
		catch (Exception $e) {

			//\yii\db\Connection::EVENT_ROLLBACK_TRANSACTION;
			return ['result' => 0];
		}
	}

}
