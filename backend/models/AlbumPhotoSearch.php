<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AlbumPhoto;

/**
 * AlbumPhotoSearch represents the model behind the search form about `common\models\AlbumPhoto`.
 */
class AlbumPhotoSearch extends AlbumPhoto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_album'], 'integer'],
            [['jdl_album', 'album_seo', 'gbr_album', 'aktif', 'user_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AlbumPhoto::find();

        if(Yii::$app->user->identity->level!='admin'){
            $query->where(['user_id'=>Yii::$app->user->identity->username]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort'=> ['defaultOrder' => ['id_album'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_album' => $this->id_album,
        ]);

        $query->andFilterWhere(['like', 'jdl_album', $this->jdl_album])
            ->andFilterWhere(['like', 'album_seo', $this->album_seo])
            ->andFilterWhere(['like', 'gbr_album', $this->gbr_album])
            ->andFilterWhere(['like', 'aktif', $this->aktif]);

        return $dataProvider;
    }
}
