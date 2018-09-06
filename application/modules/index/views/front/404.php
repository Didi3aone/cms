<section id="contentSection">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="left_content">
                <div class="error_page">
                    <h3>Mohon Maaf .....</h3>
                    <h1>404</h1>
                    <p>Halaman yang anda cari belum tersedia ..!!! </p>
                    <span></span> <a href="<?= site_url(); ?>" class="wow fadeInLeftBig">Go to home page</a> 
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <!-- load sidebar -->
            <?php $this->load->view('index/front/sidebar'); ?>
            <!-- end load -->
        </div>
    </div>
    <div class="related_post">
        <h2>Artikel Lainnya <i class="fa fa-thumbs-o-up"></i></h2>
        <?php 
            foreach($other_article as $key => $value) :
                $id         = $value['artikel_id'];
                $seo        = $value['artikel_pretty_url'];
                $photo      = $value['artikel_photo'];
                $isi        = $value['artikel_isi'];
                $judul      = $value['artikel_judul'];
                $photo_real = $value['artikel_photo_real'];
        ?>
        <ul class="spost_nav wow fadeInDown animated">
            <li>
                <div class="media"> 
                    <a class="media-left" href="<?= site_url("article/read/".$id.'-'.$seo); ?>.html"> 
                        <img src="<?= ($photo) ? base_url($photo) : base_url($photo_real); ?>" alt=""> 
                    </a>
                    <div class="media-body"> 
                        <a class="catg_title" href="<?= site_url("article/read/".$id.'-'.$seo); ?>.html"> <?= $judul; ?> </a> 
                    </div>
                </div>
            </li>
        </ul>
        <?php endforeach;?>
    </div>
</section>
