<?php

namespace app\models;
use yii\db\Query;
use Yii;

/**
 * This is the model class for table "SDP_TD02_CAR".
 *
 * @property integer $D02_CUST_NO
 * @property integer $D02_CAR_SEQ
 * @property string $D02_CAR_NAMEN
 * @property string $D02_JIKAI_SHAKEN_YM
 * @property integer $D02_METER_KM
 * @property string $D02_SYAKEN_CYCLE
 * @property string $D02_RIKUUN_NAMEN
 * @property string $D02_CAR_ID
 * @property string $D02_HIRA
 * @property string $D02_CAR_NO
 * @property string $D02_INP_DATE
 * @property string $D02_INP_USER_ID
 * @property string $D02_UPD_DATE
 * @property string $D02_UPD_USER_ID
 * @property string $D02_MAKER_CD
 * @property string $D02_MODEL_CD
 * @property string $D02_SHONENDO_YM
 * @property string $D02_TYPE_CD
 * @property string $D02_GRADE_CD
 */
class Sdptd02car extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'SDP_TD02_CAR';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

			[['D02_CUST_NO', 'D02_CAR_SEQ'], 'required'],
            [['D02_CUST_NO', 'D02_CAR_SEQ', 'D02_METER_KM'], 'integer'],
            [['D02_CAR_NAMEN'], 'string', 'max' => 100],
            [['D02_JIKAI_SHAKEN_YM', 'D02_MODEL_CD'], 'string', 'max' => 8],
            [['D02_SYAKEN_CYCLE'], 'string', 'max' => 1],
            [['D02_RIKUUN_NAMEN'], 'string', 'max' => 10],
            [['D02_CAR_ID', 'D02_GRADE_CD'], 'string', 'max' => 3],
            [['D02_HIRA'], 'string', 'max' => 2],
            [['D02_CAR_NO', 'D02_MAKER_CD', 'D02_TYPE_CD'], 'string', 'max' => 4],
            [['D02_INP_DATE', 'D02_UPD_DATE'], 'string'],
            [['D02_INP_USER_ID', 'D02_UPD_USER_ID'], 'string', 'max' => 20],
            [['D02_SHONENDO_YM'], 'string', 'max' => 6],
            [['D02_CUST_NO', 'D02_CAR_SEQ'], 'unique', 'targetAttribute' => ['D02_CUST_NO', 'D02_CAR_SEQ'], 'message' => 'The combination of D02  Cust  No and D02  Car  Seq has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'D02_CUST_NO' => 'D02  Cust  No',
            'D02_CAR_SEQ' => 'D02  Car  Seq',
            'D02_CAR_NAMEN' => 'D02  Car  Namen',
            'D02_JIKAI_SHAKEN_YM' => 'D02  Jikai  Shaken  Ym',
            'D02_METER_KM' => 'D02  Meter  Km',
            'D02_SYAKEN_CYCLE' => 'D02  Syaken  Cycle',
            'D02_RIKUUN_NAMEN' => 'D02  Rikuun  Namen',
            'D02_CAR_ID' => 'D02  Car  ID',
            'D02_HIRA' => 'D02  Hira',
            'D02_CAR_NO' => 'D02  Car  No',
            'D02_INP_DATE' => 'D02  Inp  Date',
            'D02_INP_USER_ID' => 'D02  Inp  User  ID',
            'D02_UPD_DATE' => 'D02  Upd  Date',
            'D02_UPD_USER_ID' => 'D02  Upd  User  ID',
            'D02_MAKER_CD' => 'D02  Maker  Cd',
            'D02_MODEL_CD' => 'D02  Model  Cd',
            'D02_SHONENDO_YM' => 'D02  Shonendo  Ym',
            'D02_TYPE_CD' => 'D02  Type  Cd',
            'D02_GRADE_CD' => 'D02  Grade  Cd',
        ];
    }

	private function getWhere($filters = array(), $select = '*')
    {
        $query = new Query();
        $query->select($select)->from(static::tableName());

        if (isset($filters['D02_CUST_NO']) && $filters['D02_CUST_NO']) {
            $query->where('D02_CUST_NO =:cust_no', [':cust_no' => $filters['D02_CUST_NO']]);
        }

        if (isset($filters['D02_CAR_NO']) && $filters['D02_CAR_NO']) {
            $query->where('D02_CAR_NO =:car_no', [':car_no' => $filters['D02_CAR_NO']]);
        }

        if (isset($filters['offset']) && $filters['offset']) {
            $query->offset($filters['offset']);
        }

        if (isset($filters['limit']) && $filters['limit']) {
            $query->limit($filters['limit']);
        }
        return $query;
    }

    public function saveData()
    {
        return $this->obj->save();
    }

    public function setData($data = array(), $id = null)
    {
        $obj = new Sdptd04denpyosagyo();
        if ($id) {
            $obj = static::findOne($id);
        }

        $obj->attributes = $data;
        foreach ($obj->attributes as $k => $v) {
            $obj->{$k} = trim($v) != '' ? trim($v) : null;
        }

        $this->obj = $obj;
    }

    public function getData($filters = array(), $select = '*')
    {
		$query = $this->getWhere($filters, $select);
        $query->orderBy('D02_CAR_SEQ ASC');
        return $query->all();
    }
}
