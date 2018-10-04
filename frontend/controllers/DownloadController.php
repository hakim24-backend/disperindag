<?php

namespace frontend\controllers;

use frontend\components\MainController;
use common\models\KategoriDownload;
use common\models\Download;
use Yii;

class DownloadController extends MainController
{
    /**
     * Halaman list kategori download
     * @return mixed
     */
    public function actionIndex()
    {
    	$list_kategori_download = KategoriDownload::find()
    								->where(['aktif'=>'Y'])
    								->all();
        return $this->render('index',[
        	'list_kategori_download' => $list_kategori_download
        ]);
    }

    /**
     * Menampilkan list file download dari suatu kategori download
     * @param string $content Slug Url dari Kategori Download
     * @return mixed
     */
    public function actionEnter($content)
    {
    	$model_kategori_download = $this->findModelKategori($content);
    	$list_download = Download::find()
    						->where(['id_kategori'=>$model_kategori_download->id_kategori])
    						->all();
    	return $this->render('list-download',[
    		'model_kategori_download' => $model_kategori_download,
    		'list_download' => $list_download,
    	]);
    }

    /**
     * Menampilkan list video
     * @param string $file nama file yang akan di download
     * @return url to directly download
     */
    public function actionDownload($file){
    	
        $model_download = $this->findModelDownload($file);
        $file = $model_download->getPathFrontend().$file;
        
        if (file_exists($file)) {
            $name=basename($file);
            $path=pathinfo($file, PATHINFO_EXTENSION);
            
            $model_download->hits = $model_download->hits+1; 
            $model_download->save();
            // var_dump($file);die;
            /*
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            */
            if (pathinfo($file, PATHINFO_EXTENSION)=="pdf") {
                # code...
                // var_dump("expression");die;
                return \Yii::$app->response->sendFile($file, $name, ['inline'=>true]);
            }else{
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
            }
        }else{
            $pesan = "Maaf terjadi kesalahan saat download, silahkan hubungi kami kalau memang terjadi kesalahan berulang kali";
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Projects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $slug Url Slug
     * @return Projects the loaded model
     * @throws BadRequestHttpException if the model cannot be found
     */
    protected function findModelDownload($file_name)
    {
        if (($model = Download::find()->where(['nama_file'=>$file_name])->one()) !== null) {
            return $model;
        } else {
            throw new BadRequestHttpException('File download yang Anda cari tidak ditemukan');
        }
    }
    /**
     * Finds the Projects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $slug Url Slug
     * @return Projects the loaded model
     * @throws BadRequestHttpException if the model cannot be found
     */
    protected function findModelKategori($slug)
    {
        if (($model = KategoriDownload::find()->where(['kategori_seo'=>$slug])->one()) !== null) {
            return $model;
        } else {
            throw new BadRequestHttpException('Halaman yang Anda cari tidak ditemukan');
        }
    }
}
