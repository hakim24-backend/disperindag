<?php 

use yii\widgets\LinkPager;
$this->title = "UPT Indag";
?>

<div class="list-page">
	<div class="box-content">
	    <div class="box-header">
	        <h3 class="title">UPT Indag</h3>
	    </div>
	    <div class="box-body">
	    	<div class="layout-list3">
	     	<?php 
				$i = 1;
				foreach ($list_upt_indag as $key=>$item) {
					if($i==1)
						echo '<div class="row list">';
					
					echo '<div class="col-sm-6">
							<div class="media">
							  <div class="media-left">
							    <a href="'.Yii::$app->request->baseUrl.'/upt-indag/detail?content='.$item->slug.'">
							      <img class="media-object img-thumbnail" src="'.Yii::$app->request->baseUrl.'/common/uploaded/other/thumb/'.$item->gambar.'" alt="'.$item->judul.'">
							    </a>
							  </div>
							  <div class="media-body media-middle">
							    	<h4 class="media-heading">
							    		<a href="'.Yii::$app->request->baseUrl.'/upt-indag/detail?content='.$item->slug.'">'.$item->judul.'</a>
							    		<br><small>	'.$item->tgl_posting.' </small>
							    	</h4>
							  </div>
							</div>
						</div>';

					if($item == end($list_upt_indag)){
						echo "</div>";
					}else if($i==2){
						echo "</div>";
						echo "<hr>";
						$i=0;
					}

					$i++;
				}
				echo LinkPager::widget([
				    'pagination' => $pages,
				    'maxButtonCount' => 5,
				]);
			?>
			</div>
	    </div>
	</div>
</div>