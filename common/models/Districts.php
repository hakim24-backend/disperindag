<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "districts".
 *
 * @property string $id
 * @property string $name
 *
 * @property Villages[] $villages
 */
class Districts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'districts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['id'], 'string', 'max' => 7],
            [['name'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVillages()
    {
        return $this->hasMany(Villages::className(), ['district_id' => 'id']);
    }

    public function getDistricts()
    {
        return self::find()->select(['name','id'])->indexBy('id')->column();
    }
}
