<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "visitors".
 *
 * @property integer $id
 * @property string $date
 * @property string $user_identifier
 * @property integer $visits
 */
class Visitors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'visitors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'user_identifier', 'visits'], 'required'],
            [['date'], 'safe'],
            [['user_identifier'], 'string'],
            [['visits'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'user_identifier' => 'User Identifier',
            'visits' => 'Visits',
        ];
    }
}
