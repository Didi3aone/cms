<?php 
    $id          = isset($artikel['artikel_id']) ? $artikel['artikel_id'] : "";
    $Judul 		 = isset($artikel['artikel_judul']) ? $artikel['artikel_judul'] : "";
    $seo  		 = isset($artikel['artikel_pretty_url'])  ? $artikel['artikel_pretty_url'] : "";
    $create_date = isset($artikel['artikel_create_date']) ? $artikel['artikel_create_date'] : "";
    $content     = isset($artikel['artikel_isi']) ? $artikel['artikel_isi'] : "";
    $image       = isset($artikel['artikel_photo']) ? $artikel['artikel_photo'] : "";
    $kategori_id = isset($artikel['kategori_id']) ? $artikel['kategori_id'] : "";
    $kategori    = isset($artikel['name']) ? $artikel['name'] : ""; 
    $tag_id      = isset($artikel_detail['tag_id']) ? $artikel_detail['tag_id'] : "";
    $tag         = isset($artikel_detail['name']) ? $artikel_detail['name'] : "";
    $file_url    = isset($artikel['artikel_photo_real']) ? $artikel['artikel_photo_real'] : ""; 
    $types       = isset($artikel['artikel_type_id']) ? $artikel['artikel_type_id'] : "";  
    $types_name  = isset($artikel['type_nam']) ? $artikel['type_nam'] : "";  
    // pr($artikel);exit;
    $btn_msg     = ($id) ? "Change" : "Upload"; 

?>
<div id="content">
	<div class="row">
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
			<h1 class="page-title txt-color-blueDark"><?= $title_page ?></h1>
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
							<form id="form" class="smart-form" method="POST" action="<?php echo site_url('manager/article/process_form') ?>" enctype="multipart/form-data">
								<?php if($id != '' ) :?>
									<input type="hidden" name="artikel_id" value="<?= $id ?>">
								<?php endif;?>
								<fieldset>
									<div class="row">
										<section class="col col-6">
											<label class="label">Artikel Judul <sup class="color-red">*</sup></label>
											<label class="input"> 
												<input type="text" name="judul" id="judul" value="<?= $Judul; ?>" placeholder="Artikel Judul">
											</label>
										</section>

										<section class="col col-6">
											<label class="label">Artikel SEO <sup class="color-red">*</sup></label>
											<label class="input"> 
												<input type="text" name="artikel_seo" id="seo" value="<?= $seo ?>" placeholder="SEO Artikel">
											</label>
											<div class="note">SEO friendly (automatic generate (-))</div>
										</section>
									</div>

									<div class="row">
										<section class="col col-6">
											<label class="select">Tag Artikel</label>
											<label class="select">
												<?php if($tag_id != "") : ?>
												<select name="tag[]" id="tag" multiple="multiple" style="width: 100%;">
													<option selected value="<?= $tag_id ?>"><?= $tag ?></option>
												</select>
												<?php else: ?>
												<select name="tag[]" id="tag" multiple="multiple" style="width: 100%;"></select>
												<?php endif; ?>
											</label>
											<div class="note">#Tags sesuaikan dengan artikel terkait</div>
										</section>
										
										<section class="col col-6">
											<label class="label">Kategori Artikel <sup class="color-red">*</sup></label>
											<label class="select">
												<?php if($kategori != "") : ?>
												<select name="category_id" id="kategori" style="width: 100%;">
													<option selected value="<?= $kategori_id?>"><?= $kategori ?></option>
												</select>
													<?php else: ?>
												<select name="category_id" id="kategori"></select>
												<?php endif; ?>
											</label>
											<div class="note">Kategori artikel sesuaikan dengan artikel terkait</div>
										</section>

	                                </div>
									<div class="row">
		                                <div class="col-xs-12">
		                                    <div id="image_preview_primary" class="add-image-preview"></div>
		                                </div>
										<section class="col col-6">
											<label class="label">Upload Foto Artikel</label>
												<?php if(!empty($image)) :?>
													<a href="<?php echo base_url($image) ?>"  data-lightbox="roadtrip">
														<img src="<?php echo base_url($image) ?>" alt="" height=100 width=100></a>
												<?php endif; ?> &nbsp;
												<button type="button" id="addimage" data-maxsize="<?= MAX_UPLOAD_IMAGE_SIZE ?>" data-maxwords="<?= WORDS_MAX_UPLOAD_IMAGE_SIZE ?>" data-edit="0" class="btn btn-primary"><?= $btn_msg ?></button>
											 <div class="note"> Klik Button (add image) Foto Sesuaikan dengan artikel terkait</div>
										</section>
										<section class="col col-6">
	                                        <label class="label">File Real</label>
	                                        <label class="input">
	                                            <input type="file" name="real_image" class="form-control" placeholder="File Real" value="<?= $file_url; ?>" /> <br>
	                                            <?php if($file_url): ?>
	                                            <div class="file_tech_div">
	                                                <img src="<?= base_url($file_url) ?>" style="width: 90px;height: 70px;">
	                                            <?php  endif; ?>
	                                        </label>
	                                        <div class="note"></div>
	                                    </section>
									</div>
									<div class="row">
										<section class="col col-6">
											<label class="label">Tipe Artikel</label>
											<label class="select">
												<?= select_type("type_id", $types); ?>
												<i></i> </label>
										</section>
									</div>
		                            <div class="row">
										<section class="col col-lg-12">
											<label class="textarea"> 										
												<textarea name="artikel_isi" class="tinymce"><?= $content ?></textarea> 
											</label>
										</section>
									</div>

									<footer>
										<button type="submit" class="btn  btn-submit btn-primary"> <i class="fa fa-save"></i>
											Save
										</button>
										<a href="<?= site_url() ?>manager/article" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Cancel</a>
									</footer>

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