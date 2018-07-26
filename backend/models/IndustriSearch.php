<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Industri;

/**
 * IndustriSearch represents the model behind the search form of `common\models\Industri`.
 */
class IndustriSearch extends Industri
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'badan_usaha', 'kbli', 'status'], 'integer'],
            [['nama_perusahaan', 'nama_pemilik', 'jalan', 'kelurahan', 'kecamatan', 'telepon', 'fax', 'email', 'web', 'izin_usaha_industri', 'tahun_izin', 'komoditi', 'jenis_produk', 'cabang_industri', 'tahun_data', 'tk_lk', 'tk_pr', 'nilai_investasi', 'jml_kapasitas_produksi', 'satuan', 'nilai_produksi', 'nilai_bb_bp', 'orientasi_ekspor', 'negara_tujuan_ekspor', 'npwp'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Industri::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'badan_usaha' => $this->badan_usaha,
            'kbli' => $this->kbli,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'nama_perusahaan', $this->nama_perusahaan])
            ->andFilterWhere(['like', 'nama_pemilik', $this->nama_pemilik])
            ->andFilterWhere(['like', 'jalan', $this->jalan])
            ->andFilterWhere(['like', 'kelurahan', $this->kelurahan])
            ->andFilterWhere(['like', 'kecamatan', $this->kecamatan])
            ->andFilterWhere(['like', 'telepon', $this->telepon])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'web', $this->web])
            ->andFilterWhere(['like', 'izin_usaha_industri', $this->izin_usaha_industri])
            ->andFilterWhere(['like', 'tahun_izin', $this->tahun_izin])
            ->andFilterWhere(['like', 'komoditi', $this->komoditi])
            ->andFilterWhere(['like', 'jenis_produk', $this->jenis_produk])
            ->andFilterWhere(['like', 'cabang_industri', $this->cabang_industri])
            ->andFilterWhere(['like', 'tahun_data', $this->tahun_data])
            ->andFilterWhere(['like', 'tk_lk', $this->tk_lk])
            ->andFilterWhere(['like', 'tk_pr', $this->tk_pr])
            ->andFilterWhere(['like', 'nilai_investasi', $this->nilai_investasi])
            ->andFilterWhere(['like', 'jml_kapasitas_produksi', $this->jml_kapasitas_produksi])
            ->andFilterWhere(['like', 'satuan', $this->satuan])
            ->andFilterWhere(['like', 'nilai_produksi', $this->nilai_produksi])
            ->andFilterWhere(['like', 'nilai_bb_bp', $this->nilai_bb_bp])
            ->andFilterWhere(['like', 'orientasi_ekspor', $this->orientasi_ekspor])
            ->andFilterWhere(['like', 'negara_tujuan_ekspor', $this->negara_tujuan_ekspor])
            ->andFilterWhere(['like', 'npwp', $this->npwp]);

        return $dataProvider;
    }
}
