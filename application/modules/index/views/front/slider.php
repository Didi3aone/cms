<section id="sliderSection">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="slick_slider">
                <?php 
                    //set val data
                    foreach( $slider as $key => $value) :
                        $id     = $value['slider_id'];
                        $title  = $value['title'];
                        $image  = $value['image'];
                        $desc   = $value['description'];
                        // pr($image);exit;
                ?>
                <div class="single_iteam"><img src="<?= base_url($image); ?>" alt="">
                    <div class="slider_article">
                        <h2><?= $title; ?></h2>
                        <p><?= $desc; ?></p>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
        <!-- load latest post -->
        <?php $this->load->view('index/front/latest_post'); ?>
        <!-- end load -->
    </div>
</section>