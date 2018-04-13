<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "broadcast_agenda".
 *
 * @property string $date
 * @property integer $id_agenda
 * @property integer $id
 */
class BroadcastAgenda extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'broadcast_agenda';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'id_agenda'], 'required'],
            [['date'], 'safe'],
            [['id_agenda'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'date' => 'Date',
            'id_agenda' => 'Id Agenda',
            'id' => 'ID',
        ];
    }
}
