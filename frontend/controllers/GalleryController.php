<?php

namespace frontend\controllers;

use frontend\components\MainController;
use common\models\Video;
use common\models\Photo;
use common\models\AlbumPhoto;
use yii\data\Pagination;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

class GalleryController extends MainController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
	/**
	 * Menampilkan list video
	 * @return mixed
	 */
    public function actionVideo()
    {
    	$list_video = Video::find();
    	$countQuery = clone $list_video;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>12]);
        $list_video_page = $list_video->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('list_video',[
        	'pages'			=>	$pages,
        	'list_video'	=> $list_video_page,
        ]);
    }

    /**
	 * Menampilkan list album foto
	 * @return mixed
	 */
    public function actionPhotoAlbum()
    {
    	$list_album = AlbumPhoto::find();
    	$countQuery = clone $list_album;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>12]);
        $list_album_page = $list_album->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('list_album',[
        	'pages'			=> $pages,
        	'list_album' 	=> $list_album_page,
        ]);
    }

    /**
	 * Menampilkan list photo dari suatu album
	 * @param string $content slug url
	 * @return mixed
	 */
    public function actionPhotos($content)
    {
    	$model_album = $this->findModelAlbum($content);
    	$list_photos = Photo::find()
    					->where(['id_album'=>$model_album->id_album]);
    	$countQuery = clone $list_photos;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>16]);
        $list_photos_page = $list_photos->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

    	return $this->render('list_photos',[
    		'model_album'	=> $model_album,
    		'pages' 		=> $pages,
    		'list_photos' 	=> $list_photos_page,
    	]);	
    }

    /**
     * Finds the Projects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $slug Url Slug
     * @return Projects the loaded model
     * @throws BadRequestHttpException if the model cannot be found
     */
    protected function findModelAlbum($slug)
    {
        if (($model = AlbumPhoto::find()->where(['album_seo'=>$slug])->one()) !== null) {
            return $model;
        } else {
            throw new BadRequestHttpException('Halaman yang Anda cari tidak ditemukan');
        }
    }
}
