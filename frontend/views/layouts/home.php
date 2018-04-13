<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= $identitas->nama_website ?></title>
    <meta name="description" content="<?= $identitas->meta_deskripsi ?>">
    <meta name="keywords" content="<?= $identitas->meta_keyword ?>">
    <link rel="shortcut icon" href="<?= Yii::$app->request->baseUrl.Yii::$app->params['uploadUrlOther'].$identitas->favicon ?>" />
    <meta name="author" content="rahmatheruka and thefiqroh">
    <?php $this->head() ?>
    <script type="text/javascript">var switchTo5x=true;</script>
</head>
<body>


<?php $this->beginBody() ?>


<div class="wrap">
    <?= 
        $this->render("header",[
            'menu'=>$menu,
        ]); 
    ?>
   
    <?= $content ?>
    
</div>

<?= 
    $this->render("footer",[
        'currency_exchange'=>$currency_exchange,
    ]); 
?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
