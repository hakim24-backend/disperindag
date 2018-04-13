<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "katajelek".
 *
 * @property integer $id_jelek
 * @property string $kata
 * @property string $ganti
 */
class KataSensor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'katajelek';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kata', 'ganti'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_jelek' => 'Id Jelek',
            'kata' => 'Kata',
            'ganti' => 'Ganti',
        ];
    }
}
