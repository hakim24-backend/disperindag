<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "broadcast_berita".
 *
 * @property string $date
 * @property integer $id_berita
 * @property integer $id
 */
class BroadcastBerita extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'broadcast_berita';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'id_berita'], 'required'],
            [['date'], 'safe'],
            [['id_berita'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'date' => 'Date',
            'id_berita' => 'Id Berita',
            'id' => 'ID',
        ];
    }
}
