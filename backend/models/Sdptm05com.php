<?php

namespace app\models;

use yii\base\Exception;
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
    public $header = array(
        '商品コード',
        '荷姿コード',
        'M05_KIND_COM_NO',
        'M05_LARGE_COM_NO',
        'M05_MIDDLE_COM_NO',
        'DM分類コード',
        '商品名',
        '参考価格',
        'M05_ORDER',
        'M05_MEMO'
    );

    public $error_import = array();

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

    /**
     * validate import data
     * @param $line
     * @param array $data
     */
    public function validateImport($line, $data = array())
    {
        if (count($data) != 10) {
            $this->error_import[] = $line . '行目:CSVファイルのフォーマットが正しくありません';
        } else {
            if ($data[0] == '') {
                $this->error_import[] = $this->setMessageRequire($line, '商品コード');
            }

            if ($data[1] == '') {
                $this->error_import[] = $this->setMessageRequire($line, '荷姿コード');
            }

            if (mb_strlen($data[0]) > 0 && !preg_match('/^[0-9]{6}$/', $data[0])) {
                $this->error_import[] = $this->setMessageEqualLength($line, '商品コード', 6);
            }

            if (mb_strlen($data[1]) > 0 && !preg_match('/^[0-9]{3}$/', $data[1])) {
                $this->error_import[] = $this->setMessageEqualLength($line, '荷姿コード', 3);
            }

            if (mb_strlen($data[2]) > 0 && mb_strlen($data[2]) > 3 && !preg_match('/^[0-9]+$/', $data[5])) {
                $this->error_import[] = $this->setMessageOverLength($line, 'M05_KIND_COM_NO', 3);
            }

            if (mb_strlen($data[3]) > 0 && mb_strlen($data[3]) > 3 && !preg_match('/^[0-9]+$/', $data[5])) {
                $this->error_import[] = $this->setMessageOverLength($line, 'M05_LARGE_COM_NO', 3);
            }

            if (mb_strlen($data[4]) > 0 && mb_strlen($data[4]) > 3 && !preg_match('/^[0-9]+$/', $data[5])) {
                $this->error_import[] = $this->setMessageOverLength($line, 'DM分類コード', 3);
            }

            if (mb_strlen($data[5]) > 0 && mb_strlen($data[5]) > 3 && !preg_match('/^[0-9]+$/', $data[5])) {
                $this->error_import[] = $this->setMessageOverLength($line, 'M05_MIDDLE_COM_NO', 3);
            }

            if (mb_strlen($data[6]) > 0 && mb_strlen($data[6]) > 50) {
                $this->error_import[] = $this->setMessageOverLength($line, '商品名', 50);
            }

            if (mb_strlen($data[7]) > 0 && mb_strlen($data[7]) > 10) {
                $this->error_import[] = $this->setMessageOverLength($line, '参考価格', 10);
            }

            if (mb_strlen($data[8]) > 0 && mb_strlen($data[8]) > 3 && !preg_match('/^[0-9]+$/', $data[8])) {
                $this->error_import[] = $this->setMessageOverLength($line, 'M05_ORDER', 3);
            }

            if (mb_strlen($data[9]) > 0 && mb_strlen($data[9]) > 250) {
                $this->error_import[] = $this->setMessageOverLength($line, 'M05_MEMO', 250);
            }
        }
    }

    private function setMessageEqualLength($line, $column, $length)
    {
        return $line . '行目:' . $column . 'が' . $length . '桁の半角数字で入力して下さい';
    }

    private function setMessageOverLength($line, $column, $length)
    {
        return $line . '行目:' . $column . 'が' . $length . '文字以内を入力して下さい';
    }

    private function setMessageRequire($line, $column)
    {
        return $line . '行目:' . $column . 'を入力して下さい。';
    }

    /**
     * save data import
     * @param $file
     * @return array
     * @throws \yii\db\Exception
     */
    public function saveImport($file)
    {
        $login_info = Yii::$app->session->get('login_info');
        $header = fgetcsv($file);
        $line = 2;
        $insert_data = array();

        $update = array();
        $transaction = $this->getDb()->beginTransaction();
        try {
            while (($data = fgetcsv($file)) !== false) {
                $this->validateImport($line, $data);
                $update_data = array();
                if (count($data) == 10) {
                    if ($obj = self::findOne(array('M05_COM_CD' => $data[0], 'M05_NST_CD' => $data[1]))) {
                        $update_data['update'] = " M05_KIND_COM_NO=:M05_KIND_COM_NO, M05_LARGE_COM_NO=:M05_LARGE_COM_NO"
                            . ", M05_MIDDLE_COM_NO=:M05_MIDDLE_COM_NO, M05_KIND_DM_NO=:M05_KIND_DM_NO"
                            . ", M05_COM_NAMEN=:M05_COM_NAMEN, M05_LIST_PRICE=:M05_LIST_PRICE"
                            . ", M05_ORDER=:M05_ORDER, M05_MEMO=:M05_MEMO, M05_UPD_DATE=:M05_UPD_DATE"
                            . ", M05_UPD_USER_ID=:M05_UPD_USER_ID";
                        $update_data['where'] = " M05_COM_CD=:M05_COM_CD and M05_NST_CD=:M05_NST_CD";
                        //$update[] = 'update ' . self::tableName() . ' set' . $update_data['update'] . ' where' . $update_data['where'];
                        $update = 'update ' . self::tableName() . ' set' . $update_data['update'] . ' where ' . $update_data['where'];
                        $update1 = Yii::$app->db->createCommand($update)
                            ->bindValue(':M05_KIND_COM_NO', $data[2])
                            ->bindValue(':M05_LARGE_COM_NO', $data[3])
                            ->bindValue(':M05_MIDDLE_COM_NO', $data[4])
                            ->bindValue(':M05_KIND_DM_NO', $data[5])
                            ->bindValue(':M05_COM_NAMEN', $data[6])
                            ->bindValue(':M05_LIST_PRICE', $data[7])
                            ->bindValue(':M05_ORDER', $data[8])
                            ->bindValue(':M05_MEMO', $data[9])
                            ->bindValue(':M05_UPD_DATE', date('y-M-d'))
                            ->bindValue(':M05_UPD_USER_ID', $login_info['M50_USER_ID'])
                            ->bindValue(':M05_COM_CD', $data[0])
                            ->bindValue(':M05_NST_CD', $data[1])
                            ->execute();
                        if (!$update1) {
                            $transaction->rollback();
                            return array('insert' => false, 'error' => $this->error_import);
                        }

                    } else {
                        $data[] = date('y-M-d');
                        $data[] = $login_info['M50_USER_ID'];
                        $data[] = date('y-M-d');
                        $data[] = $login_info['M50_USER_ID'];
                        $insert_data[$data[0] . $data[1]] = $this->setData($data);
                    }
                }

            }

            $columnNameArray = array('M05_COM_CD', 'M05_NST_CD', 'M05_KIND_COM_NO', 'M05_LARGE_COM_NO', 'M05_MIDDLE_COM_NO',
                'M05_KIND_DM_NO', 'M05_COM_NAMEN', 'M05_LIST_PRICE', 'M05_ORDER', 'M05_MEMO', 'M05_INP_DATE',
                'M05_INP_USER_ID', 'M05_UPD_DATE', 'M05_UPD_USER_ID');

            if (!empty($this->error_import)) {
                return array('insert' => false, 'error' => $this->error_import);
            }


            if (!empty($insert_data)) {
                $insert = Yii::$app->db->createCommand()
                    ->batchInsert(self::tableName(), $columnNameArray, array_values($insert_data))
                    ->execute();
                if (!isset($insert)) {
                    $transaction->rollback();
                    return array('insert' => false, 'error' => $this->error_import);
                }
            }

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
            $this->error_import[] = 'exception';
            return array('insert' => false, 'error' => $this->error_import);
        }

        return array('insert' => true, 'error' => $this->error_import);
    }

    /**
     * @param array $filters
     * @param string $select
     * @return Query
     */
    private function getWhere($filters = array(), $select = '*')
    {
        $query = new Query();
        $query->select($select)->from(static::tableName());

        if (isset($filters['M05_COM_CD_IN']) && $filters['M05_COM_CD_IN'] != '') {
            $query->andwhere(['IN', 'M05_COM_CD', $filters['M05_COM_CD_IN']]);
        }

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

    /**
     * @return mixed
     */
    public function saveData()
    {
        return $this->obj->save();
    }

    /**
     * @param array $filters
     * @param string $select
     * @return array
     */
    public function getData($filters = array(), $select = '*')
    {
        $query = $this->getWhere($filters, $select);
        $query->orderBy('M05_COM_CD ASC');
        return $query->all();
    }

    /**
     * @param $filters
     * @return int|string
     */
    public function coutData($filters)
    {
        $query = $this->getWhere($filters);
        return $query->count();
    }
}
