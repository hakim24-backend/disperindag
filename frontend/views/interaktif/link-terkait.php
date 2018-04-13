<?php 

$this->title = "UPT Indag";
?>

<div class="list-page">
	<div class="box-content">
	    <div class="box-header">
	        <h3 class="title">Link Terkait</h3>
	    </div>
	    <div class="box-body padding">
	     	<div class="layout-list3">
	     	<?php 
				$i = 1;
				foreach ($list_link_terkait as $key=>$item) {
					if($i==1)
						echo '<div class="row list">';
					
					echo '<div class="col-sm-6">
							<div class="media">';
							if($item->gambar != ''){
							  echo '<div class="media-left">
							    <a href="'. $item->url .'" target="blank">
							      <img class="media-object img-thumbnail" src="'.Yii::$app->request->baseUrl.Yii::$app->params['uploadUrlOther'].$item->gambar.'" alt="'.$item->judul.'">
							    </a>
							  </div>';
							}
							  echo '<div class="media-body media-middle">
							    	<h4 class="media-heading">
							    		<a href="'. $item->url .'" target="blank">'.$item->judul.'</a>
							    		<br><small>	'.$item->keterangan.' </small>
							    	</h4>
							  </div>
							</div>
						</div>';

					if($item == end($list_link_terkait)){
						echo "</div>";
					}else if($i==2){
						echo "</div>";
						echo "<hr>";
						$i=0;
					}

					$i++;
				}
			?>
			</div>
	    </div>
	</div>
</div>