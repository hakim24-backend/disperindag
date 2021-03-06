<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "villages".
 *
 * @property string $id
 * @property string $district_id
 * @property string $name
 *
 * @property Districts $district
 */
class Villages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'villages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'district_id', 'name'], 'required'],
            [['id'], 'string', 'max' => 10],
            [['district_id'], 'string', 'max' => 7],
            [['name'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => Districts::className(), 'targetAttribute' => ['district_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'district_id' => 'District ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(Districts::className(), ['id' => 'district_id']);
    }

    public function getSubCatList($cat_id){
        $subCategories = self::find()
        ->select(['id','name'])
        ->where(['district_id'=>$cat_id])
        ->asArray()
        ->all();

        return $subCategories;
    }
}
