<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\models;
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

	function getCar($member_kaiinCd = null) {

		if($member_kaiinCd == null) {
			return [];
		}

		$dataCus = $this->customer->getData(['D01_KAIIN_CD' => $member_kaiinCd]);
		if(count($dataCus)) {
			$dataCus = current($dataCus);
			$cusCustNo = $dataCus['D01_CUST_NO'];
			$dataCar = $this->car->getData(['D02_CUST_NO' => $cusCustNo]);
			return $dataCar;
		}

		return [];
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
	public function convertKeyApiDB($cus){

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

}
