<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Kbli;

/**
 * SakipKategoriFileSearch represents the model behind the search form about `common\models\SakipKategoriFile`.
 */
class KbliSearch extends Kbli
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
      return [
          [['nama','kode'], 'string', 'max' => 255]
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
        $query = Kbli::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        if($this->load($params)){
          $query
            ->andFilterWhere(['like', 'kode', $params['KbliSearch']['kode']])
            ->andFilterWhere(['like', 'nama', $params['KbliSearch']['nama']]);
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }
}
