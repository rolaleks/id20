<?php
namespace app\models;

use yii\db\ActiveRecord;


/**
 * This is the model class for table "{{%data}}".
 *
 * @property integer $id
 * @property string  $card_number
 * @property string  $date
 * @property double  $volume
 * @property string  $service
 * @property integer $address_id
 *
 */
class Data extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['card_number'], 'string', 'max' => 20],
        ];
    }

    public static function tableName()
    {
        return '{{%data}}';
    }


}