<?php 
	$id              	= isset($jadwal['jadwal_id']) ? $jadwal['jadwal_id'] : "";
	$Judul 		     	= isset($jadwal['jadwal_name']) ? $jadwal['jadwal_name'] : "";
	$lokasi  		 	= isset($jadwal['jadwal_location'])  ? $jadwal['jadwal_location'] : "";
	$content     	 	= isset($jadwal['jadwal_description']) ? $jadwal['jadwal_description'] : "";
	$start     		 	= isset($jadwal['jadwal_start']) ? $jadwal['jadwal_start'] : "";
	$end     		 	= isset($jadwal['jadwal_end']) ? $jadwal['jadwal_end'] : "";
	$event    			= isset($jadwal['jadwal_event_date']) ? $jadwal['jadwal_event_date'] : "";
	$image       	 	= isset($jadwal['jadwal_photo']) ? $jadwal['jadwal_photo'] : "";
	$jadwal_kategori_id = isset($jadwal['jadwal_kategori_id']) ? $jadwal['jadwal_kategori_id'] : "";
	$kategori 			= isset($jadwal['kategori_name']) ? $jadwal['kategori_name'] : "";
	$btn_msg     		= ($id == null) ? "Upload" : "Change"; 
?>
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
				<button class="btn btn-primary submit-form" data-form-target="jadwal-form" title="Simpan" rel="tooltip" data-placement="top" >
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
							
							<form id="jadwal-form" class="smart-form" method="POST" action="<?php echo site_url('manager/jadwal/process_form') ?>" enctype="multipart/form-data">
								<?php if($id != ""): ?>
									<input type="hidden" name="jadwal_id" value="<?= $id ?> ">
								<?php endif; ?>
								<fieldset>
									<div class="row">
										<section class="col col-6">
											<label class="label">Nama Jadwal <sup class="color-red">*</sup></label>
											<label class="input"> 
												<input type="text" name="jadwal_name" value="<?= $Judul; ?>" placeholder="Nama Jadwal">
											</label>
										</section>
										<section class="col col-6">
											<label class="label">Lokasi  <sup class="color-red">*</sup></label>
											<label class="input"> 
												<input type="text" name="jadwal_location" value="<?= $lokasi ?>" placeholder="Lokasi">
											</label>
										</section>
										
										<section class="col col-6">
											<label class="select">Kategori</label>
											<label class="select">
												<?php if($jadwal_kategori_id != "") : ?>
												<select name="jadwal_kategori_id" id="kategori" style="width: 100%;">
													<option selected value="<?= $jadwal_kategori_id ?>"><?= $kategori ?></option>
												</select>
												<?php else: ?>
												<select name="jadwal_kategori_id" id="kategori" style="width: 100%;"></select>
												<?php endif; ?>
											</label>
											<div class="note">#</div>
										</section>

										<?php if(!empty($id)) : ?>
										<section class="col col-6" id="event">
											<label class="label"> Tanggal Jadwal <sup class="color-red">*</sup></label>
											<label class="input"> 
												<i class="icon-append fa fa-calendar"></i>
												<input type="text" name="jadwal_start_date" class="datepicker-addon" value="<?= $event; ?>" placeholder="Jadwal Start Date">
											</label>
										</section>

										<?php else : ?>

										<section class="col col-6" id="event">
											<label class="label"> Tanggal Jadwal <sup class="color-red">*</sup></label>
											<label class="input"> 
												<i class="icon-append fa fa-calendar"></i>
												<input type="text" name="jadwal_start_date" class="datepicker-addon" id="periode_start" placeholder="Jadwal Start Date">
											</label>
										</section>
										<?php endif;?>
									</div>
									<!-- <div class="row" style="display: none;" id="kajian">
										<section class="col col-6">
											<label class="label"> Jadwal Start Date <sup class="color-red">*</sup></label>
											<label class="input"> 
												<i class="icon-append fa fa-calendar"></i>
												<input type="text" name="jadwal_start_date" class="datepicker-addon" id="periode_start" value=" placeholder="Jadwal Start Date">
											</label>
										</section>
									</div> -->
									<div class="row">
										<section class="col col-6">
	                                        <label class="label">Photo</label>
	                                        <label class="input">
		                                        <input name="images" type="file" id="image-upload" class="form-control" placeholder="Upload File" value="" /> <br>
	                                            <div id="image-preview">
	                                            </div>
	                                        </label>
	                                    </section>
									</div>

		                            <div class="row">
										<section class="col col-lg-12">
											<label class="textarea"> 										
												<textarea name="jadwal_description" class="tinymce"><?= $content ?></textarea> 
											</label>
										</section>
									</div>

									<footer>
										<button type="submit" class="btn  btn-submit btn-primary"> <i class="fa fa-save"></i>
											Save
										</button>
										<a href="<?= site_url() ?>manager/jadwal" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Cancel</a>
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