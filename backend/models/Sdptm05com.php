<?php

namespace app\models;
use yii\db\Query;
use Yii;

/**
 * This is the model class for table "SDP_TM05_COM".
 *
 * @property string $M05_COM_CD
 * @property string $M05_NST_CD
 * @property integer $M05_KIND_COM_NO
 * @property integer $M05_LARGE_COM_NO
 * @property integer $M05_MIDDLE_COM_NO
 * @property integer $M05_KIND_DM_NO
 * @property string $M05_COM_NAMEN
 * @property integer $M05_LIST_PRICE
 * @property integer $M05_ORDER
 * @property string $M05_MEMO
 * @property string $M05_INP_DATE
 * @property string $M05_INP_USER_ID
 * @property string $M05_UPD_DATE
 * @property string $M05_UPD_USER_ID
 */
class Sdptm05com extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'SDP_TM05_COM';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['M05_COM_CD', 'M05_NST_CD', 'M05_KIND_COM_NO', 'M05_LARGE_COM_NO', 'M05_MIDDLE_COM_NO'], 'required'],
            [
                [
                    'M05_KIND_COM_NO',
                    'M05_LARGE_COM_NO',
                    'M05_MIDDLE_COM_NO',
                    'M05_KIND_DM_NO',
                    'M05_LIST_PRICE',
                    'M05_ORDER'
                ],
                'integer'
            ],
            [['M05_COM_CD'], 'string', 'max' => 6],
            [['M05_NST_CD'], 'string', 'max' => 3],
            [['M05_COM_NAMEN'], 'string', 'max' => 100],
            [['M05_MEMO'], 'string', 'max' => 500],
            [['M05_INP_DATE', 'M05_UPD_DATE'], 'string'],
            [['M05_INP_USER_ID', 'M05_UPD_USER_ID'], 'string', 'max' => 20],
            [
                ['M05_COM_CD', 'M05_NST_CD'],
                'unique', 'targetAttribute' => ['M05_COM_CD', 'M05_NST_CD'],
                'message' => 'The combination of M05  Com  Cd and M05  Nst  Cd has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'M05_COM_CD' => 'M05  Com  Cd',
            'M05_NST_CD' => 'M05  Nst  Cd',
            'M05_KIND_COM_NO' => 'M05  Kind  Com  No',
            'M05_LARGE_COM_NO' => 'M05  Large  Com  No',
            'M05_MIDDLE_COM_NO' => 'M05  Middle  Com  No',
            'M05_KIND_DM_NO' => 'M05  Kind  Dm  No',
            'M05_COM_NAMEN' => 'M05  Com  Namen',
            'M05_LIST_PRICE' => 'M05  List  Price',
            'M05_ORDER' => 'M05  Order',
            'M05_MEMO' => 'M05  Memo',
            'M05_INP_DATE' => 'M05  Inp  Date',
            'M05_INP_USER_ID' => 'M05  Inp  User  ID',
            'M05_UPD_DATE' => 'M05  Upd  Date',
            'M05_UPD_USER_ID' => 'M05  Upd  User  ID',
        ];
    }

    public function setData($data = array())
    {
        foreach ($data as $k => $v) {
            $data[$k] = trim($v) != '' ? trim($v) : null;
        }

        return $data;
    }

    public function validateImport($line, $data = array())
    {
        $error = array();
        if (count($data) != 10) {
            $error[] = 'error line '.$line;
        }

        if (self::findOne(array($data[0], $data[1]))) {
            $error[] = 'error line '.$line.' : primary key existed';
        }

        for ($i = 0; $i < 5; $i++) {
            if ($data[0] == '') {
                $error[] = $this->setMessageRequire($line, $i + 1);
            }
        }

        if (mb_strlen($data[0]) > 0 && mb_strlen($data[0]) != 6) {
            $error[] = $this->setMessageEqualLength($line, 1, 6);
        }

        if (mb_strlen($data[1]) > 0 && mb_strlen($data[1]) != 3) {
            $error[] = $this->setMessageEqualLength($line, 2, 3);
        }

        if (mb_strlen($data[2]) > 0 && mb_strlen($data[2]) > 3) {
            $error[] = $this->setMessageOverLength($line, 3, 3);
        }

        if (mb_strlen($data[3]) > 0 && mb_strlen($data[3]) > 3) {
            $error[] = $this->setMessageOverLength($line, 4, 3);
        }

        if (mb_strlen($data[4]) > 0 && mb_strlen($data[4]) > 3) {
            $error[] = $this->setMessageOverLength($line, 5, 3);
        }

        if (mb_strlen($data[5]) > 0 && mb_strlen($data[5]) > 3) {
            $error[] = $this->setMessageOverLength($line, 5, 3);
        }

        if (mb_strlen($data[6]) > 0 && mb_strlen($data[6]) > 100) {
            $error[] = $this->setMessageOverLength($line, 6, 100);
        }

        if (mb_strlen($data[7]) > 0 && mb_strlen($data[7]) > 10) {
            $error[] = $this->setMessageOverLength($line, 7, 10);
        }

        if (mb_strlen($data[8]) > 0 && mb_strlen($data[8]) > 3) {
            $error[] = $this->setMessageOverLength($line, $i + 1, 3);
        }

        if (mb_strlen($data[9]) > 0 && mb_strlen($data[9]) > 500) {
            $error[] = $this->setMessageOverLength($line, $i + 1, 500);
        }

        return $error;
    }

    private function setMessageEqualLength($line, $column, $length)
    {
        return 'error line '.$line.', column '.$column.': must '.$length.' character';
    }

    private function setMessageOverLength($line, $column, $length)
    {
        return 'error line '.$line.', column '.$column.': should not exceed '.$length.' character';
    }

    private function setMessageRequire($line, $column)
    {
        return 'error line '.$line.', column '.$column.': should not empty';
    }

    public function saveImport($file)
    {
        $login_info = Yii::$app->session->get('login_info');
        $header = fgetcsv($file);
        $line = 2;
        $insert_data = array();
        while (($data = fgetcsv($file)) !== false) {
            $error = $this->validateImport($line, $data);
            if (!empty($error)) {
                return array('insert' => false, 'error' => $error);
            }

            $data[] = date('y-M-d');
            $data[] = $login_info['M50_USER_ID'];
            $data[] = date('y-M-d');
            $data[] = $login_info['M50_USER_ID'];
            $insert_data[] = $this->setData($data);
            $line ++;
        }

        $columnNameArray = array_keys($this->attributeLabels());
        $insertCount = Yii::$app->db->createCommand()
            ->batchInsert(self::tableName(), $columnNameArray, $insert_data)
            ->execute();
        if ($insertCount) {
            return array('insert' => true, 'error' => $error);
        }
        return array('insert' => false, 'error' => $error);
    }
    private function getWhere($filters = array(), $select = '*')
    {
        $query = new Query();
        $query->select($select)->from(static::tableName());

        if (isset($filters['M05_COM_CD']) && $filters['M05_COM_CD'] != '') {
            $query->andwhere(['like', 'M05_COM_CD', $filters['M05_COM_CD']]);
        }

        if (isset($filters['M05_COM_NAMEN']) && $filters['M05_COM_NAMEN'] != '') {
            $query->andwhere(['like', 'M05_COM_NAMEN', $filters['M05_COM_NAMEN']]);
        }

        if (isset($filters['M05_NST_CD']) && $filters['M05_NST_CD'] != '') {
            $query->andwhere(['like', 'M05_NST_CD', $filters['M05_NST_CD']]);
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

    public function getData($filters = array(), $select = '*')
    {
        $query = $this->getWhere($filters, $select);
        $query->orderBy('M05_COM_CD ASC');
        return $query->all();
    }

    public function coutData($filters)
    {
        $query = $this->getWhere($filters);
        return $query->count();
    }
}
