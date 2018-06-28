<?php

namespace frontend\controllers;

use frontend\components\MainController;
use common\models\KategoriPost;
use common\models\Post;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\data\Pagination;
use yii\db\Query;
use yii\base\Component;
// use yii\base\Object;
use Yii;

class PostController extends MainController
{
    /**
     * Menampilkan semua list Post
     * @return mixed
     */
    public function actionIndex()
    {
        $list_post = Post::find()
                            ->orderBy(['id_berita'=>SORT_DESC]);
        $countQuery = clone $list_post;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>12]);
        $list_post_page = $list_post->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
            
        return $this->render('list-post-all',[
            'pages'                 => $pages,
            'list_post'             => $list_post_page,
        ]);
    }

	 /**
     * Menampilkan list Post dari suatu kategori Post
     * @param string $content Url Slug
     * @return mixed
     */
    public function actionKategori($content)
    {
    	$model_kategori = $this->findModelKategori($content);
    	$list_post = Post::find()
    						->where(['id_kategori'=>$model_kategori->id_kategori])
                            ->orderBy(['id_berita'=>SORT_DESC]);
        $countQuery = clone $list_post;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>12]);
        $list_post_page = $list_post->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
            
        return $this->render('list-post',[
        	'model_kategori_post' 	=> $model_kategori,
            'pages'                 => $pages,
        	'list_post'				=> $list_post_page,
        ]);
    }
    
    /**
     * Menampilkan detail dari Post
     * Related Post
     * Tambah jumlah view (yang membaca post)
     * @param string $content Url Slug
     * @return mixed
     */
    public function actionDetail($content)
    {
        $model_post = $this->findModelPost($content);
        $sql = Yii::$app->db->createCommand("
            SELECT *, MATCH(judul, isi_berita) AGAINST('".addslashes($model_post->judul)."') AS score
            FROM berita 
            WHERE MATCH(judul, isi_berita) AGAINST('".addslashes($model_post->judul)."') AND 
            judul NOT IN ('".addslashes($model_post->judul)."')
            ORDER BY score DESC LIMIT 8
        ");
        $list_related_post = $sql->queryAll();

        $model_post->dibaca = $model_post->dibaca+1;
        $model_post->save();

    	return $this->render('detail-post',[
    		'model_post'          => $model_post,
            'list_related_post'  => $list_related_post,
    	]);
    }

    /**
     * Menampilkan list Post dari Pencarian
     * @param string $s kata kunci pencarian
     * @return mixed
     */
    public function actionPencarian($s)
    {
        $list_post = Post::find()
                            ->where(['LIKE', 'judul', $s])
                            ->orderBy(['id_berita'=>SORT_DESC]);
        
        $countQuery = clone $list_post;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>12]);
        $list_post_page = $list_post->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
            
        return $this->render('list-post-search',[
            'pages'                 => $pages,
            'list_post'             => $list_post_page,
        ]);
    }

    /**
     * Menampilkan list Post dari Pencarian
     * @param string $s kata kunci pencarian
     * @return mixed
     */
    public function actionTag($content)
    {
        $list_post = Post::find()
                            ->where(['LIKE', 'tag', $content])
                            ->orderBy(['id_berita'=>SORT_DESC]);
        
        $countQuery = clone $list_post;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>12]);
        $list_post_page = $list_post->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
            
        return $this->render('list-post-search-tag',[
            'pages'                 => $pages,
            'list_post'             => $list_post_page,
        ]);
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
        if (($model = KategoriPost::find()->where(['kategori_seo'=>$slug])->one()) !== null) {
            return $model;
        } else {
            throw new BadRequestHttpException('Halaman yang Anda cari tidak ditemukan');
        }
    }

    /**
     * Finds the Projects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $slug Url Slug
     * @return Projects the loaded model
     * @throws BadRequestHttpException if the model cannot be found
     */
    protected function findModelPost($slug)
    {
        if (($model = Post::find()->where(['judul_seo'=>$slug])->one()) !== null) {
            return $model;
        } else {
            throw new BadRequestHttpException('Halaman yang Anda cari tidak ditemukan');
        }
    }

    public function actionSakip()
    {
        return $this->render('sakip');
    }

    public function actionPelayanan()
    {
        return $this->render('layanan');
    }
}
