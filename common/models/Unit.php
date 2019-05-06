<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "unit".
 *
 * @property int $id
 * @property string $name_unit
 */
class Unit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_unit'], 'required'],
            [['name_unit'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_unit' => 'Name Unit',
        ];
    }
}
