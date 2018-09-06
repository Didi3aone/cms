<section id="contentSection">
	<!-- <div class="row">
		<div style="margin-bottom: 10px; margin-left: 10px; margin-right:10px;" id="show"> 
			<iframe width="560" height="315" id="frame" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
		</div>
	</div>
	 -->
	<div class="row">
		<?php 
			foreach($video as $key => $value) :
				$id = $value['artikel_video_id'];
				$title = $value['title'];
				$pretty_url = $value['pretty_url'];
				$url 		= $value['url_video'];
				$img_url	= $value['url_image'];
		?>
		<div class="col-md-4">
            <div class="thumbnail" style="box-shadow: 0 7px 13px rgba(0, 0, 0, 0.5);">
                <img class="img-responsive" src="<?= $img_url ?>">
                <div class="caption">
                	<div class="loadiframe">
                		<a href="#"  onclick="changeVideo('<?= $url ?>')" class="btn btn-info"><i class="fa fa-play"></i>Lihat Video</a>
				</div>
                </div>
            </div>
        </div> 
 		<?php endforeach; ?>
	</div>
</section>
<!-- button sosmed -->
<div class="social_link">
    <ul class="sociallink_nav">
        <div class="sharethis-inline-share-buttons"></div>
    </ul>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-body">
	      		<div class='embed-container'>
			        <iframe id="iframeYoutube" class="responsive" width="560" height="315" src="" frameborder="0" allowfullscreen></iframe> 
			    </div>
	      	</div>
	      	<div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		    </div>
	    </div>
  	</div>
</div>

<?php $this->load->view('article_video/front/video-js'); ?>