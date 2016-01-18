<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "SDP_TW01_DEL_DENPYO".
 *
 * @property string $W01_KANRI_ID
 * @property integer $W01_DEN_NO
 * @property string $W01_INP_DATE
 * @property string $W01_INP_USER_ID
 * @property string $W01_UPD_DATE
 * @property string $W01_UPD_USER_ID
 */
class Sdptw01deldenpyo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'SDP_TW01_DEL_DENPYO';
    }

    public $obj;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['W01_KANRI_ID', 'W01_DEN_NO'], 'required'],
            [['W01_DEN_NO'], 'integer'],
            [['W01_KANRI_ID'], 'string', 'max' => 17],
            [['W01_INP_DATE', 'W01_UPD_DATE'], 'string'],
            [['W01_INP_USER_ID', 'W01_UPD_USER_ID'], 'string', 'max' => 20],
            [['W01_KANRI_ID', 'W01_DEN_NO'], 'unique', 'targetAttribute' => ['W01_KANRI_ID', 'W01_DEN_NO'], 'message' => 'The combination of W01  Kanri  ID and W01  Den  No has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'W01_KANRI_ID' => 'W01  Kanri  ID',
            'W01_DEN_NO' => 'W01  Den  No',
            'W01_INP_DATE' => 'W01  Inp  Date',
            'W01_INP_USER_ID' => 'W01  Inp  User  ID',
            'W01_UPD_DATE' => 'W01  Upd  Date',
            'W01_UPD_USER_ID' => 'W01  Upd  User  ID',
        ];
    }

    public function setData($data = array(), $id = null)
    {
        $login_info = Yii::$app->session->get('login_info');
        $data['W01_KANRI_ID'] = date('YmdHis');
        $data['W01_UPD_DATE'] = date('d-M-y');
        $data['W01_UPD_USER_ID'] = $login_info['M50_USER_ID'];

        if ($id) {
            $obj = static::findOne($id);
        } else {
            $obj = new Sdptw01deldenpyo();
            $data['W01_INP_DATE'] = date('d-M-y');
            $data['W01_INP_USER_ID'] = $login_info['M50_USER_ID'];
        }

        $obj->attributes = $data;

        foreach ($obj->attributes as $k => $v) {
            $obj->{$k} = trim($v) != '' ? trim($v) : null;
        }

        $this->obj = $obj;
    }

    public function saveData()
    {
        return $this->obj->save();
    }
}
