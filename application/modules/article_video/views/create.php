<?php 
    $id          = isset($artikel['artikel_video_id']) ? $artikel['artikel_video_id'] : "";
    $url         = isset($artikel['url_video']) ? $artikel['url_video'] : "";
    $sumber      = isset($artikel['copyright']) ? $artikel['copyright'] : "";
    $pretty_url  = isset($artikel['pretty_url']) ? $artikel['pretty_url'] : "";
    $judul       = isset($artikel['title']) ? $artikel['title'] : "";
    $konten      = isset($artikel['content']) ? $artikel['content'] : "";
    // pr($artikel);exit;
    $btn_msg     = ($id == null) ? "Upload" : "Change"; 
    
?>
<script>
	var id = "<?php echo $id ?>";
</script>
<!-- START ROW -->
<div id="content">
	<div class="row">
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
			<h1 class="page-title txt-color-blueDark"><?= $title_page ?></h1>
		</div>
		<div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 col-lg-offset-1 text-right">
			<h1>
				<button class="btn btn-warning back-button" onclick="<?= (isset($back) ? "go('".$back."');" : "window.history.back();") ?>" title="Back" rel="tooltip" data-placement="left" data-original-title="Batal">
					<i class="fa fa-arrow-circle-left fa-lg"></i>
				</button>
				<button class="btn btn-primary submit-form" data-form-target="article-video-form" title="Simpan" rel="tooltip" data-placement="top" >
					<i class="fa fa-floppy-o fa-lg"></i>
				</button>
			</h1>
		</div>
	</div>

	<section id="widget-grid" class="">
		<div class="row">

			<!-- NEW COL START -->
			<article class="col-sm-12 col-md-12 col-lg-12">
				
				<!-- Widget ID (each widget will need unique ID)-->
				<div class="jarviswidget" id="wid-id-1" data-widget-editbutton="false" data-widget-custombutton="false">
					<header>
						<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
						<h2><?php echo $title_page ?> </h2>				
						
					</header>

					<!-- widget div-->
					<div>
						<!-- widget content -->
						<div class="widget-body no-padding">
							
							<form id="article-video-form" class="smart-form" method="POST" action="<?php echo site_url('manager/article_video/process_form') ?>">
								<?php if($id != '' ) :?>
									<input type="hidden" name="id" value="<?= $id ?>">
								<?php endif;?>
								<fieldset>
									<div class="row">
										<section class="col col-6">
											<label class="label">Judul<sup class="color-red">*</sup></label>
											<label class="input"> 
												<input type="text" name="judul" id="judul" value="<?= $judul; ?>" placeholder="Judul Video">
											</label>
										</section>

										<section class="col col-6">
											<label class="label">Sumber</label>
											<label class="input"> 
												<input type="text" name="sumber" value="<?= $sumber; ?>" placeholder="Sumber Video">
											</label>
											<div class="note"> Jika video bukan milik sendiri mohon sertakan sumber pemilik asli.</div>
										</section>

										<section class="col col-6">
											<label class="label">Pretty URL (META SEO) <sup class="color-red">*</sup></label>
											<label class="input"> 
												<input type="text" id="seo" name="pretty_url" value="<?= $pretty_url; ?>" placeholder="Pretty URL (Meta SEO)">
											</label>
											<div class="note">Seo title Auto generate(-)</div>
										</section>
									</div>
									<div class="row">
										<section class="col col-6">
	                            			<label class="label">Description</label>
											<label class="input"> 
												<textarea name="content" class="tinymce"><?= $konten  ?></textarea>
											</label>
										</section>
								
										<section class="col col-6">
											<label class="label">URL video (source)<sup class="color-red">*</sup></label>
											<label class="input"> 
												<input type="text" name="url" id="url_video" value="<?= $url; ?>" placeholder="URL VIDEO">
											</label>
											<div class="note"> Link video. example: https://www.youtube.com/watch?v=0RiLu3S4Vzg (auto generate [embed])</div>

											<?php if(!empty($url)) :?>
												<label class="label">Preview</label>
												<iframe src="<?= $url; ?>" id="url_youtubesedit" height="100%" scrolling="yes" width="90%" frameborder="0"></iframe>
											<?php else : ?>
		                                    	<div id="url_youtube" style="display: none;">
		                                    		<label class="label">Preview</label>
		                                    		<iframe width="100%" height="345" src="" id="url_youtubes">
													</iframe>
		                                    	</div>
		                                    <?php endif;?>
										</section>
										
                                    </div>
								</fieldset>
							</form>
						</div>
						<!-- end widget content -->
					</div>
					<!-- end widget div -->
				</div>
				<!-- end widget -->
			</article>
			<!-- END COL -->	
		</div>
		<!-- END ROW -->
	</section>
</div>