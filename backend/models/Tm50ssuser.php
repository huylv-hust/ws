<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "TM50_SS_USER".
 *
 * @property string $M50_USER_ID
 * @property string $M50_USER_NAME
 * @property string $M50_PASSWORD
 * @property string $M50_SS_CD
 * @property string $M50_DEL_FLG
 * @property string $M50_OPE_ID
 * @property string $M50_INP_YMDHMS
 * @property string $M50_UPD_YMDHMS
 */
class Tm50ssuser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TM50_SS_USER';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['M50_USER_ID', 'M50_USER_NAME', 'M50_PASSWORD', 'M50_SS_CD'], 'required'],
            [['M50_USER_ID', 'M50_OPE_ID'], 'string', 'max' => 20],
            [['M50_USER_NAME'], 'string', 'max' => 256],
            [['M50_PASSWORD'], 'string', 'max' => 64],
            [['M50_SS_CD'], 'string', 'max' => 6],
            [['M50_DEL_FLG'], 'string', 'max' => 1],
            [['M50_INP_YMDHMS', 'M50_UPD_YMDHMS'], 'string', 'max' => 14],
            [['M50_USER_ID'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'M50_USER_ID' => 'M50  User  ID',
            'M50_USER_NAME' => 'M50  User  Name',
            'M50_PASSWORD' => 'M50  Password',
            'M50_SS_CD' => 'M50  Ss  Cd',
            'M50_DEL_FLG' => 'M50  Del  Flg',
            'M50_OPE_ID' => 'M50  Ope  ID',
            'M50_INP_YMDHMS' => 'M50  Inp  Ymdhms',
            'M50_UPD_YMDHMS' => 'M50  Upd  Ymdhms',
        ];
    }

    /*
     * Check login
     * */
    public function checkLogin($dataUser = [])
    {
        $sql = [];
        $flag = false;
        if (!isset($dataUser['ssid']) || !isset($dataUser['password'])) {
            $flag = false;
        } else {
            $password = md5($dataUser['password'] . md5('12345' . $dataUser['password']));
            $sql = (new Query())
                ->select(['M50_USER_ID', 'M50_SS_CD', 'M50_USER_NAME'])
                ->from(self::tableName())
                ->where('M50_USER_ID = :ssid', [':ssid' => $dataUser['ssid']])
                ->andWhere('M50_PASSWORD = :password', [':password' => $password])
                ->andWhere('M50_DEL_FLG != 1 or M50_DEL_FLG is NULL')
                ->all();

            if (count($sql) == 1) {
                $flag = true;
            }
        }
        return ['flag' => $flag, 'sql' => $sql];
    }
}
