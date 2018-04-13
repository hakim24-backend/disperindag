<?php 

namespace backend\components;

use Yii;
use \yii\db\ActiveRecord;
use yii\imagine\Image;
use Imagine\Image\Box;

class MainModel extends ActiveRecord
{
	/**
    * Membuat url slug
    * @param string $text (judul dari content)
    * @return string
    */
    static public function makeSlug($text)
    {
      $text = preg_replace('~[^\pL\d]+~u', '-', $text);
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
      $text = preg_replace('~[^-\w]+~', '', $text);
      $text = trim($text, '-');
      $text = preg_replace('~-+~', '-', $text);
      $text = strtolower($text);

      if (empty($text))
        return 'n-a';
      
      return $text;
    }

    /**
     * New random name file
     * Assign new random name to gambar field
     */
    static public function getNewNameFile($imageFile)
    { 
      $new_namefile = time() . Yii::$app->security->generateRandomString(5) . '.' . $imageFile->extension;
      return $new_namefile;
    }

    /**
     * Upload file
     */
    public function upFile($imageFile, $path, $image, $makeThumbnail=false, $thumbSpecification=null)
    {
        if($imageFile){
            $imageFile->saveAs($path.$image);

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

    public function deleteFolder($dirPath)
    {
      if (is_dir($dirPath)) {
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
      }
    }
}