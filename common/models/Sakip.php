<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sakip".
 *
 * @property string $deskripsi
 * @property integer $updated_at
 */
class Sakip extends \yii\db\ActiveRecord
{
    protected $primaryKey = null;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sakip';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['judul','deskripsi'], 'required'],
            [['judul','deskripsi'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'deskripsi' => 'Deskripsi',
            'updated_at' => 'Updated At',
        ];
    }

    public function simpan()
    {
        if($this->validate()){
            $this->updated_at = time();
            $this->save();
            return true;
        }
        return false;
    }
}
