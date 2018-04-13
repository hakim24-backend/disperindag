<?php

namespace backend\controllers;

use Yii;
use common\models\Post;
use common\models\AlbumPhoto;
use common\models\Photo;
use common\models\KategoriDownload;
use common\models\Download;
use common\models\LinkTerkait;
use common\models\Contact;
use common\models\User;
use yii\imagine\Image;
use Imagine\Image\Box;

class MigrationController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $rows = Yii::$app->db2->createCommand("select * from berita")->queryAll();
        $i = 1;
        foreach ($rows as $key => $value) {
        	/*if($i > 20){
        	$model = new Post();
        	$model->id_berita = $value['id_berita'];
        	$model->id_kategori = $value['id_kategori'];
        	$model->username = $value['username'];
        	$model->judul = $value['judul'];
        	$model->judul_seo = $value['judul_seo'];
        	$model->headline = $value['headline'];
        	$model->isi_berita = $value['isi_berita'];
        	$model->hari = $value['hari'];
        	$model->tanggal = $value['tanggal'];

        	$model->jam = $value['jam'];

        	$model->dibaca = $value['dibaca'];
        	$model->tag = $value['tag'];
        	$model->status_broadcast = 0;
        	$model->save();
        	
        	}
        	if($i == 30)
        		break;
        	$i++;
			*/
        	
        	//$path = '..'.Yii::$app->params['uploadUrlPost'];
	        //$path = $path."asli/";

	        
	        	
	        	//echo $value['id_berita']. " - " . $path.$value['gambar']." - ";
	        	//echo $path.$new_name_file. "<br>";
	        if($value['gambar'] != ''){
	        	$this->uploadImage($value['gambar'],$value['gambar']);
	        }
        	
        }
    }

    public function actionAlbum()
    {
    	$rows = Yii::$app->db2->createCommand("select * from album")->queryAll();
    	foreach ($rows as $key => $value) {
    		$model = new AlbumPhoto();
    		$model->id_album = $value['id_album'];
    		$model->jdl_album = $value['jdl_album'];
    		$model->album_seo = $value['album_seo'];
    		$model->gbr_album = $value['gbr_album'];
    		$model->aktif = $value['aktif'];
    		$model->save();
    		$path = '..'.Yii::$app->params['uploadUrlGallery'].$model->album_seo."-".md5($model->id_album.Yii::$app->params['specialChar1']);
            if (!file_exists($path)) {
                mkdir($path."/show", 0777, true);
                mkdir($path."/thumb", 0777, true);
            }
    	}
    }

	public function actionPhoto()
    {
    	$rows = Yii::$app->db2->createCommand("select * from gallery")->queryAll();

    	foreach ($rows as $key => $value) {
    		$model = new Photo();
    		$model->id_gallery = $value['id_gallery'];
    		$model->id_album = $value['id_album'];
    		$model->jdl_gallery = $value['jdl_gallery'];
    		$model->gallery_seo = $value['gallery_seo'];
    		$model->keterangan = $value['keterangan'];

    		$model->gbr_gallery = $value['gbr_gallery'];

    		$model->save();
    		$this->uploadImage($model->gbr_gallery,$model->gbr_gallery,$model);
    	}
    }   

    public function actionKategoriDownload()
    {
    	$rows = Yii::$app->db2->createCommand("select * from kategori_download")->queryAll();
    	foreach ($rows as $key => $value) {
    		$model = new KategoriDownload();
    		$model->id_kategori = $value['id_kategori'];
    		$model->nama_kategori = $value['nama_kategori'];
    		$model->kategori_seo = $value['kategori_seo'];
    		$model->aktif = $value['aktif'];
    		 $path = '../'.Yii::$app->params['uploadUrlFile'].$model->kategori_seo."-".md5($model->id_kategori.Yii::$app->params['specialChar1']);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
    		$model->save();
    	}
    }

    public function actionDownload()
    {
    	$rows = Yii::$app->db2->createCommand("select * from download")->queryAll();
    	foreach ($rows as $key => $value) {
    		$model = new Download();
    		$model->id_download = $value['id_download'];
    		$model->judul = $value['judul'];
    		$model->nama_file = $value['nama_file'];
    		$model->tgl_posting = $value['tgl_posting'];
    		$model->hits = $value['hits'];
    		$model->id_kategori = $value['id_kategori'];

    		$path_asli = '../'.Yii::$app->params['uploadUrlFile'];
    		$path = '../'.Yii::$app->params['uploadUrlFile'].$model->kategori->kategori_seo."-".md5($model->id_kategori.Yii::$app->params['specialChar1'])."/";

    		if($model->nama_file != ''){
	    		if(file_exists($path_asli.$model->nama_file))
	    		{
	    			copy($path_asli.$model->nama_file, $path.$model->nama_file);
	    		}
	    		$model->save();
	    	}
    	}
    }

    public function actionBanner()
    {
    	$rows = Yii::$app->db2->createCommand("select * from hubungi")->queryAll();
    	
    	foreach ($rows as $key => $value) {
    		echo $value['id_hubungi'];
    		$model = new Contact();
    		$model->id_hubungi = $value['id_hubungi'];
    		$model->nama = $value['nama'];
    		$model->email = $value['email'];
    		$model->subjek = $value['subjek'];
    		$model->pesan = $value['pesan'];
    		$model->tanggal = $value['tanggal'];
    		$model->tampilkan = 'Y';
    		$model->seen = 1;
    		$model->save();
    	}
    }

    public function uploadImage($old, $file,$model)
    {
        $path = '..'.Yii::$app->params['uploadUrlGallery'];
        $path_show = $this->getPath("show",$model);
        $path_thumb = $this->getPath("thumb",$model);
        
        if(file_exists($path.$old)){
        	copy($path.$file, $path_show.$file);
        	$thumbSpesification = [
                                ['width'=>390, 'height'=>260, 'quality'=>100, 'new_path'=>$path_thumb],
                              ];
        	$this->upFile($path, $file, true, $thumbSpesification);
        	echo "enek ".$file."<br>";
        }else{
        	echo "ga enek ".$file."<br>";
        }
    }

    public function getPath($whichOne,$model)
    {
        $folderName = $model->album->album_seo."-".md5($model->id_album.Yii::$app->params['specialChar1']);
        $path = '../'.Yii::$app->params['uploadUrlGallery'].$folderName;
        return $path."/".$whichOne."/";
    }

    public function getNewName($file)
    {
    	$ext = explode(".", $file);
    	$c = count($ext) - 1;
    	$ext = $ext[$c];
    	return time() . Yii::$app->security->generateRandomString(5).".".$ext;
    }

    /**
     * Upload file
     */
    public function upFile($path, $image, $makeThumbnail=false, $thumbSpecification=null)
    {
        

            if($makeThumbnail){
              if($thumbSpecification != null){
                foreach ($thumbSpecification as $key => $spesifikasi) {
                  $w = $spesifikasi['width'];
                  $h = $spesifikasi['height'];
                  $q = $spesifikasi['quality'];
                  $new_path = $spesifikasi['new_path'];
                  if($h != 0)
                    $this->thumbSpecified($path,$image,$w,$h,$q,$new_path);
                  else
                    $this->thumbNotSpecified($path,$image,$w,$h,$q,$new_path);
                }
              }
            }
    }

    public function thumbSpecified($path, $image, $w, $h, $q, $new_path)
    {
      Image::thumbnail($path.$image, $w, $h)
            ->save(Yii::getAlias($new_path.$image), ['quality' => $q]);
    }

    public function thumbNotSpecified($path, $image, $w, $h, $q, $new_path)
    {
      Image::frame($path.$image)
      ->thumbnail(new Box($w, $w))
      ->save($new_path.$image, ['quality' => $q]);
    }

    public function actionUserHash()
    {
        $users = User::find()->all();
        foreach ($users as $key => $user) {
            $user->generateAuthKey();
            $user->setPassword($user->password);
            $user->save();
        }
    }
}
