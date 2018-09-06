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
				<a href="<?= site_url("manager/article-video"); ?>" class="btn btn-warning back-button">	
					Back
					<i class="fa fa-arrow-circle-left fa-lg"></i>
				</a>
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
											<label class="label">Judul</label>
											<label class="input"> 
												<input type="text" readonly="readonly" name="judul" id="judul" value="<?= $judul; ?>" placeholder="Judul Video">
											</label>
										</section>

										<section class="col col-6">
											<label class="label">Sumber</label>
											<label class="input"> 
												<input type="text" readonly="readonly" name="sumber" value="<?= $sumber; ?>" placeholder="Sumber Video">
											</label>
											<div class="note"> Jika video bukan milik sendiri mohon sertakan sumber pemilik asli.</div>
										</section>

										<section class="col col-6">
											<label class="label">Pretty URL (META SEO)</label>
											<label class="input"> 
												<input type="text" id="seo" readonly="readonly" name="pretty_url" value="<?= $pretty_url; ?>" placeholder="Pretty URL (Meta SEO)">
											</label>
											<div class="note">Seo title Auto generate(-)</div>
										</section>
									</div>
									<div class="row">
										<section class="col col-6">
	                            			<label class="label">Description</label>
											<label class="input"> 
												<textarea name="content" disabled="disabled" rows="10" cols="85"><?= $konten  ?></textarea>
											</label>
										</section>
								
										<section class="col col-6">
											<label class="label">URL video (source)<sup class="color-red">*</sup></label>
											<label class="input"> 
												<input type="text" name="url" readonly="readonly" id="url_video" value="<?= $url; ?>" placeholder="URL VIDEO">
											</label>
								
											<?php if(!empty($url)) :?>
												<label class="label">Preview</label>
												<iframe width="560" height="315" src="<?= $url ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
											<?php else: ?>
											    <div></div>
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