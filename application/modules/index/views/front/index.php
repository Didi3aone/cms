<!-- load slider -->
<?php $this->load->view('index/front/slider'); ?>
<!-- end load -->
<section id="contentSection">
    <div class="row">
        <!-- load artikel harian -->
        <?php (isset($view_layout) && $view_layout != null) ? $this->load->view($view_layout) : $this->load->view('index/front/artikel_harian') ?>
        <!-- end load -->
        <div class="col-lg-4 col-md-4 col-sm-4">
            <!-- load sidebar -->
            <?php $this->load->view('index/front/sidebar'); ?>
            <!-- end load -->
        </div>
    </div>
</section>