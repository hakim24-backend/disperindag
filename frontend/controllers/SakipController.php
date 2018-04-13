<?php
namespace frontend\controllers;

use Yii;
use frontend\components\MainController;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use common\models\Sakip;
use common\models\SakipKategori;
use common\models\SakipKategoriFile;

/**
 * Site controller
 */
class SakipController extends MainController
{
	/**
	* Menampilkan konten dari profil
	* @param integer $content : slug url
	* @return mixed
	*/
	public function actionIndex()
    {
    	$sakip = Sakip::find()->one();
        $list_sakip_kategori = SakipKategori::find()->all();

        return $this->render('index',[
    		'sakip'         => $sakip,
            'list_sakip_kategori' => $list_sakip_kategori,
    	]);
    }

    /*
    foreach ($list_sakip_kategori as $key => $kategori) {
            $sakip_files = SakipKategoriFile::find()->where(['id_kategori']=>$kategori->id)->all();
            foreach ($sakip_files as $key => $file) {
                $nama_file = $file->nama;
                if($file->file==null)
                    $url_download = $file->url;
                else
                    $url_download = Yii::$app->request->baseUrl."/common/uploaded/sakip/<?= $file->file ?>";
                $list_sakip[$kategori->id][] = [
                    "nama"          => $nama_file,
                    "url_download"  => $url_download,
                ];   
            }
        }
    */

    /**
     * Menampilkan detail file dari suatu kategori sakip
     * @param integer $no id dari kategori sakip
     * @return mixed
     */
    public function actionDetailSakip($no)
    {
        $sakip = Sakip::find()->one();
        $model = SakipKategoriFile::find()->where(['id_kategori'=>$no])->all();
        return $this->render('detail',[
            'file_sakip' => $model,
            'sakip' => $sakip
        ]);
    }

    /**
     * Menampilkan list video
     * @param string $file nama file yang akan di download
     * @return url to directly download
     */
    public function actionDownload($file){
        $file = base64_decode($file);
        $model = $this->findModel($file);
        if($model->file==NULL){
            return $this->redirect($model->url);
        }

        $file = Yii::$app->params['uploadUrlFile']."sakip/".$model->file;
        
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header("Content-Type: octet/stream");
            header("Pragma: private"); 
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private",false); 
            
            header("Content-Disposition: attachment; filename=\"".basename($file)."\";" );
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: ".filesize($file));
            readfile($file);
            exit;
        }else{
            $pesan = "Maaf terjadi kesalahan saat download, silahkan hubungi kami kalau memang terjadi kesalahan berulang kali";
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Projects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id Url Slug
     * @return Projects the loaded model
     * @throws BadRequestHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SakipKategoriFile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new BadRequestHttpException('Halaman yang Anda cari tidak ditemukan');
        }
    }
}