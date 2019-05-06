<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "regencies".
 *
 * @property string $id
 * @property string $province_id
 * @property string $name
 *
 * @property Districts[] $districts
 */
class Regencies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'regencies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'province_id', 'name'], 'required'],
            [['id'], 'string', 'max' => 4],
            [['province_id'], 'string', 'max' => 2],
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
            'province_id' => 'Province ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistricts()
    {
        return $this->hasMany(Districts::className(), ['regency_id' => 'id']);
    }
}
