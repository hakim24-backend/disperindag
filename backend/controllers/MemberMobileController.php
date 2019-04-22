<?php

namespace backend\controllers;

use Yii;
use backend\models\MemberMobile;
use backend\models\MemberMobileSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\components\MainController;
use backend\components\AccessRule;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use kartik\mpdf\Pdf;

/**
 * MemberMobileController implements the CRUD actions for MemberMobile model.
 */
class MemberMobileController extends MainController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class'=> AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules'=> [
                    [
                        'allow'=>true,
                        'roles'=>['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all MemberMobile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MemberMobileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MemberMobile model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->seen();
        $model->status_before = $model->status;

        if ($model->load(Yii::$app->request->post()) && $model->simpan()) 
            return $this->redirect(['view', 'id' => $model->id]);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new MemberMobile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MemberMobile();

        if ($model->load(Yii::$app->request->post()) && $model->simpan()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MemberMobile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->seen();
        $model->status_before = $model->status;

        if ($model->load(Yii::$app->request->post()) && $model->simpan()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MemberMobile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteSelected($id)
    {
        if ($id == null) {
            Yii::$app->session->setFlash('warning', "Tidak ada data yang dihapus");
            return $this->redirect(['index']);
        } else {

            $stringToArrayId = explode(',', $id);

            foreach ($stringToArrayId as $key => $value) {
                $data[$key] = $this->findModel($value);
                $data[$key]->delete();
            }

            Yii::$app->session->setFlash('success', "Hapus data yang dipilih berhasil");
            return $this->redirect(['index']);
        }
    }

    public function actionExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        //setting colomn
        $sheet->getColumnDimension("A")->setAutoSize(true);
        $sheet->getColumnDimension("B")->setAutoSize(true);
        $sheet->getColumnDimension("C")->setAutoSize(true);
        $sheet->getColumnDimension("D")->setAutoSize(true);
        $sheet->getColumnDimension("E")->setAutoSize(true);
        $sheet->getColumnDimension("F")->setAutoSize(true);
        $sheet->getColumnDimension("G")->setAutoSize(true);
        $sheet->getColumnDimension("H")->setAutoSize(true);

        //colomn
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Instansi');
        $sheet->setCellValue('E1', 'Alamat');
        $sheet->setCellValue('F1', 'No Telpon');
        $sheet->setCellValue('G1', 'Member Sejak');
        $sheet->setCellValue('H1', 'Status');

        //row
        $item = MemberMobile::find()->all();
        $indeks = 2;
        $no = 1;

        foreach ($item as $key => $value) {
            $sheet->setCellValue('A'.$indeks, (string)$no);
            $sheet->setCellValue('B'.$indeks, $value['nama']);
            $sheet->setCellValue('C'.$indeks, $value['email']);
            $sheet->setCellValue('D'.$indeks, $value['instansi']);
            $sheet->setCellValue('E'.$indeks, $value['alamat']);
            $sheet->setCellValue('F'.$indeks, $value['no_telp']);
            $sheet->setCellValue('G'.$indeks, date("d M Y",$value['created_at']));

            if ($value['status'] == 10) {
                $sheet->setCellValue('H'.$indeks, 'Aktif');
            } else {
                $sheet->setCellValue('H'.$indeks, 'Non-Aktif');
            }
            
            $indeks++;
            $no++;
        }

        //save file excel
        $writer = new Xlsx($spreadsheet);
        $filename = "Export_Excel_". date("d-M-Y H:i:s") .".xlsx"; //just some random filename
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        die;
    }

    public function actionPdf()
    {
        //get data
        $model = MemberMobile::find()->all();

        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('report_pdf',[
            'model' => $model
        ]);
        
        // setup kartik\mpdf\ExportPdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE, 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE, 
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER, 
            // your html content input
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}', 
             // set mPDF properties on the fly
            'options' => ['title' => 'Krajee Report Title'],
             // call mPDF methods on the fly
            'methods' => [ 
                'SetHeader'=>['Data Member Mobile'], 
                'SetFooter'=>['{PAGENO}'],
            ]
        ]);
        
        // return the pdf output as per the destination setting
        return $pdf->render(); 
    }

    /**
     * Finds the MemberMobile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MemberMobile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MemberMobile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
