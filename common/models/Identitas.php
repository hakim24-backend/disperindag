<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "identitas".
 *
 * @property integer $id_identitas
 * @property string $nama_website
 * @property string $meta_deskripsi
 * @property string $meta_keyword
 * @property string $favicon
 */
class Identitas extends \yii\db\ActiveRecord
{
    public $imageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'identitas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_website', 'meta_deskripsi', 'meta_keyword'], 'required'],
            [['nama_website'], 'string', 'max' => 100],
            [['meta_deskripsi', 'meta_keyword'], 'string', 'max' => 250],
            [['favicon'],'string'],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_identitas' => 'Id Identitas',
            'nama_website' => 'Nama Website',
            'meta_deskripsi' => 'Meta Deskripsi',
            'meta_keyword' => 'Meta Keyword',
            'favicon' => 'Favicon',
            'imageFile' => 'Favicon',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $new_namefile = time() . Yii::$app->security->generateRandomString(5) . '.' . $this->imageFile->extension;
            $this->favicon = $new_namefile;
            $this->save();
            $this->imageFile->saveAs('../'.Yii::$app->params['uploadUrlOther'] . $new_namefile);
            return $new_namefile;
        } else {
            return false;
        }
    }
}
