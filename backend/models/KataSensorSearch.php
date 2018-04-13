<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\KataSensor;

/**
 * KataSensorSearch represents the model behind the search form about `common\models\KataSensor`.
 */
class KataSensorSearch extends KataSensor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_jelek'], 'integer'],
            [['kata', 'ganti'], 'safe'],
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
        $query = KataSensor::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_jelek' => $this->id_jelek,
        ]);

        $query->andFilterWhere(['like', 'kata', $this->kata])
            ->andFilterWhere(['like', 'ganti', $this->ganti]);

        return $dataProvider;
    }
}
