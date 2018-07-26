<?php

namespace backend\controllers;

use Yii;
use common\models\Industri;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\components\MainController;
use backend\models\IndustriSearch;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


/**
 * IndustriController implements the CRUD actions for Industri model.
 */
class IndustriController extends MainController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Industri models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IndustriSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    /**
     * Displays a single Industri model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Industri model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Industri();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Industri model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        // var_dump(Yii::$app->request->post());die();
        // var_dump($model);die();
        if ($model->load(Yii::$app->request->post())) {
            // var_dump(Yii::$app->request->post('Industri')['status']);die();
            $model->status=intval(Yii::$app->request->post('Industri')['status']);
            // $model->save();
            if ($model->save(false)) {
                # code...
                return $this->redirect(['view', 'id' => $model->id]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->redirect(['view', 'id' => $model->id]);

        // $model->status=
        // return $this->redirect(['view', 'id' => $model->id]);



        // return $this->render('update', [
        //     'model' => $model,
        // ]);
    }

    /**
     * Deletes an existing Industri model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionExportExcel(){
        $kolom = 2;
        $spreadsheet = new Spreadsheet();
        $Excel_writer = new Xlsx($spreadsheet);
        $spreadsheet->setActiveSheetIndex(0);
        $activeSheet = $spreadsheet->getActiveSheet();
        $activeSheet->setCellValue('A1', 'Badan Usaha');
        $activeSheet->setCellValue('B1', 'Nama Perusahaan');
        $activeSheet->setCellValue('C1', 'Nama Pemilik');
        $activeSheet->setCellValue('D1', 'Jalan');
        $activeSheet->setCellValue('E1', 'Desa/Kel');
        $activeSheet->setCellValue('F1', 'Kecamatan');
        $activeSheet->setCellValue('G1', 'Telepon');
        $activeSheet->setCellValue('H1', 'Fax');
        $activeSheet->setCellValue('I1', 'Email');
        $activeSheet->setCellValue('J1', 'Web');
        $activeSheet->setCellValue('K1', 'Izin Usaha Industri');
        $activeSheet->setCellValue('L1', 'Nomor/Tahun izin');
        $activeSheet->setCellValue('M1', 'KBLI');
        $activeSheet->setCellValue('N1', 'Komoditi');
        $activeSheet->setCellValue('O1', 'Jenis Produk');
        $activeSheet->setCellValue('P1', 'Cabang Indutri');
        $activeSheet->setCellValue('Q1', 'Tahun Data');
        $activeSheet->setCellValue('R1', 'TK LK');
        $activeSheet->setCellValue('S1', 'TK PR');
        $activeSheet->setCellValue('T1', 'Nilai Investasi');
        $activeSheet->setCellValue('U1', 'Jml Kapasitas Produksi');
        $activeSheet->setCellValue('V1', 'Sat');
        $activeSheet->setCellValue('W1', 'Nilai produksi');
        $activeSheet->setCellValue('X1', 'Nilai BB/BP');
        $activeSheet->setCellValue('Y1', 'Orientasi Ekspor');
        $activeSheet->setCellValue('Z1', 'Negara Tujuan Ekspor');
        $activeSheet->setCellValue('AA1', 'NPWP');

        $activeSheet->getColumnDimension("A")->setAutoSize(true);
        $activeSheet->getColumnDimension("B")->setAutoSize(true);
        $activeSheet->getColumnDimension("C")->setAutoSize(true);
        $activeSheet->getColumnDimension("D")->setAutoSize(true);
        $activeSheet->getColumnDimension("E")->setAutoSize(true);
        $activeSheet->getColumnDimension("F")->setAutoSize(true);
        $activeSheet->getColumnDimension("G")->setAutoSize(true);
        $activeSheet->getColumnDimension("H")->setAutoSize(true);
        $activeSheet->getColumnDimension("I")->setAutoSize(true);
        $activeSheet->getColumnDimension("J")->setAutoSize(true);
        $activeSheet->getColumnDimension("K")->setAutoSize(true);
        $activeSheet->getColumnDimension("L")->setAutoSize(true);
        $activeSheet->getColumnDimension("M")->setAutoSize(true);
        $activeSheet->getColumnDimension("N")->setAutoSize(true);
        $activeSheet->getColumnDimension("O")->setAutoSize(true);
        $activeSheet->getColumnDimension("P")->setAutoSize(true);
        $activeSheet->getColumnDimension("Q")->setAutoSize(true);
        $activeSheet->getColumnDimension("R")->setAutoSize(true);
        $activeSheet->getColumnDimension("S")->setAutoSize(true);
        $activeSheet->getColumnDimension("T")->setAutoSize(true);
        $activeSheet->getColumnDimension("U")->setAutoSize(true);
        $activeSheet->getColumnDimension("V")->setAutoSize(true);
        $activeSheet->getColumnDimension("W")->setAutoSize(true);
        $activeSheet->getColumnDimension("X")->setAutoSize(true);
        $activeSheet->getColumnDimension("Y")->setAutoSize(true);
        $activeSheet->getColumnDimension("Z")->setAutoSize(true);
        $activeSheet->getColumnDimension("AA")->setAutoSize(true);


        $industri=Industri::find()->where(['status'=>1])->orderBy(['id' => SORT_ASC])->all();
        // var_dump($industri);die();
        foreach ($industri as $key => $val) {
            # code...
            if ($val->badan_usaha) {
                # code...
                $activeSheet->setCellValue('A'. $kolom, $val->badanUsaha->nama_badan_usaha);
            }else{
                $activeSheet->setCellValue('A'. $kolom, '-');
            }
            $activeSheet->setCellValue('B'. $kolom, $val->nama_perusahaan);
            $activeSheet->setCellValue('C'. $kolom, $val->nama_pemilik);
            $activeSheet->setCellValue('D'. $kolom, $val->jalan);
            $activeSheet->setCellValue('E'. $kolom, $val->kelurahan);
            $activeSheet->setCellValue('F'. $kolom, $val->kecamatan);
            $activeSheet->setCellValue('G'. $kolom, $val->telepon);
            $activeSheet->setCellValue('H'. $kolom, $val->fax);
            $activeSheet->setCellValue('I'. $kolom, $val->email);
            $activeSheet->setCellValue('J'. $kolom, $val->web);
            if ($val->izin_usaha_industri==0) {
                $activeSheet->setCellValue('K'. $kolom, 'belum');
            }else if ($val->izin_usaha_industri==1) {
                $activeSheet->setCellValue('K'. $kolom, 'TDI');
            }else if ($val->izin_usaha_industri==2) {
                $activeSheet->setCellValue('K'. $kolom, 'IUI');
            }else if ($val->izin_usaha_industri==3) {
                $activeSheet->setCellValue('K'. $kolom, 'IUMK');
            }else if ($val->izin_usaha_industri==4) {
                $activeSheet->setCellValue('K'. $kolom, 'IZIN LAINNYA');
            }else{
                $activeSheet->setCellValue('K'. $kolom, '-');
            }
            $activeSheet->setCellValue('L'. $kolom, $val->tahun_izin);
            if ($val->kbli) {
                # code...
                $activeSheet->setCellValue('M'. $kolom, $val->kbli0->nama);
            }else{
                $activeSheet->setCellValue('M'. $kolom, '-');
            }
            $activeSheet->setCellValue('N'. $kolom, $val->komoditi);
            $activeSheet->setCellValue('O'. $kolom, $val->jenis_produk);
            $activeSheet->setCellValue('P'. $kolom, $val->cabang_industri);
            $activeSheet->setCellValue('Q'. $kolom, $val->tahun_data);
            $activeSheet->setCellValue('R'. $kolom, $val->tk_lk);
            $activeSheet->setCellValue('S'. $kolom, $val->tk_pr);
            $activeSheet->setCellValue('T'. $kolom, $val->nilai_investasi);
            $activeSheet->setCellValue('U'. $kolom, $val->jml_kapasitas_produksi);
            $activeSheet->setCellValue('V'. $kolom, $val->satuan);
            $activeSheet->setCellValue('W'. $kolom, $val->nilai_produksi);
            $activeSheet->setCellValue('X'. $kolom, $val->nilai_bb_bp);
            $activeSheet->setCellValue('Y'. $kolom, $val->orientasi_ekspor);
            $activeSheet->setCellValue('Z'. $kolom, $val->negara_tujuan_ekspor);
            $activeSheet->setCellValue('AA'. $kolom, $val->npwp);

            $kolom++;
        }
        $filename = "daftar_industri". date("d-M-Y H:i:s") .".xlsx"; //just some random filename
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        $Excel_writer->save('php://output');
        exit;

    }

    /**
     * Finds the Industri model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Industri the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Industri::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
