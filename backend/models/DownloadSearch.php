<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Download;

/**
 * DownloadSearch represents the model behind the search form about `common\models\Download`.
 */
class DownloadSearch extends Download
{
    public $kategori;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_download', 'id_kategori'], 'integer'],
            [['username','judul', 'nama_file', 'tgl_posting', 'kategori'], 'safe'],
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
        $query = Download::find();
        $query->joinWith(['kategori']);

        if(Yii::$app->user->identity->level!='admin'){
            $query->where(['username'=>Yii::$app->user->identity->username]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => ['defaultOrder'=>['id_download'=>SORT_DESC]]
        ]);

        $dataProvider->sort->attributes['kategori'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['kategori_download.nama_kategori' => SORT_ASC],
            'desc' => ['kategori_download.nama_kategori' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_download' => $this->id_download,
            'tgl_posting' => $this->tgl_posting,
            'id_kategori' => $this->id_kategori,
        ]);

        $query->andFilterWhere(['like', 'judul', $this->judul])
            ->andFilterWhere(['like', 'nama_file', $this->nama_file])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'kategori_download.nama_kategori', $this->kategori]);

        return $dataProvider;
    }
}
