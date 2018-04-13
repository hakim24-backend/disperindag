<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sekilasinfo".
 *
 * @property integer $id_sekilas
 * @property string $info
 * @property string $tgl_posting
 * @property string $gambar
 */
class RunningText extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sekilasinfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['info', 'required'],
            ['info', 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_sekilas' => 'Id Sekilas',
            'info' => 'Info',
            'tgl_posting' => 'Tgl Posting',
            'gambar' => 'Gambar',
        ];
    }

    public function simpan()
    {
        if($this->validate()){
            if($this->isNewRecord)
                $this->tgl_posting = date("Y-m-d");
            $this->save();
            return true;
        }
        return false;
    }
}
