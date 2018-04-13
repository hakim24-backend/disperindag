<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Post;

/**
 * PostSearch represents the model behind the search form about `common\models\Post`.
 */
class PostSearch extends Post
{
    public $kategoriPost;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_berita', 'id_kategori', 'dibaca'], 'integer'],
            [['username', 'judul', 'judul_seo', 'headline', 'isi_berita', 'hari', 'tanggal', 'jam', 'gambar', 'tag', 'kategoriPost'], 'safe'],
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
        $query = Post::find();
        
        if(Yii::$app->user->identity->level!='admin'){
            $query->where(['username'=>Yii::$app->user->identity->username]);
        }

        $query->joinWith(['kategoriPost']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort'=> ['defaultOrder' => ['id_berita'=>SORT_DESC]]
        ]);

        $dataProvider->sort->attributes['kategoriPost'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['kategori.nama_kategori' => SORT_ASC],
            'desc' => ['kategori.nama_kategori' => SORT_DESC],
        ];

       
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_berita' => $this->id_berita,
            'id_kategori' => $this->id_kategori,
            'tanggal' => $this->tanggal,
            'jam' => $this->jam,
            'dibaca' => $this->dibaca,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'judul', $this->judul])
            ->andFilterWhere(['like', 'judul_seo', $this->judul_seo])
            ->andFilterWhere(['like', 'headline', $this->headline])
            ->andFilterWhere(['like', 'isi_berita', $this->isi_berita])
            ->andFilterWhere(['like', 'hari', $this->hari])
            ->andFilterWhere(['like', 'gambar', $this->gambar])
            ->andFilterWhere(['like', 'tag', $this->tag])
            ->andFilterWhere(['like', 'kategori.nama_kategori', $this->kategoriPost]);

        return $dataProvider;
    }
}
