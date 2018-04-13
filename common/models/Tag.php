<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id_tag
 * @property string $nama_tag
 * @property string $tag_seo
 * @property integer $count
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_tag'], 'required'],
            [['count'], 'integer'],
            [['nama_tag', 'tag_seo'], 'string', 'max' => 100],
            ['nama_tag', 'unique', 'message' => 'Nama tag sudah ada.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tag' => 'Id Tag',
            'nama_tag' => 'Nama Tag',
            'tag_seo' => 'Tag Seo',
            'count' => 'Jumlah Post',
        ];
    }
}
