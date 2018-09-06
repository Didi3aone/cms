<section id="newsSection">
    <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
            <div class="single_page">
                <ol class="breadcrumb">
                    <li><a href="<?= site_url(); ?>">Home</a></li>
                    <li><a href="#"><?= $breadcrumb ?></a></li>
                    <li class="active">Read</li>
                </ol>

                <?php 
                    $id         = $jadwal['jadwal_id'];
                    $judul      = $jadwal['jadwal_name'];
                    // $seo        = $jadwal['artikel_pretty_url'];
                    $isi        = $jadwal['jadwal_description'];
                    $created_by = $jadwal['username'];
                    $date       = $jadwal['jadwal_created_date'];
                    $photo      = $jadwal['jadwal_photo'];
                    // $photo_real = $jadwal['artikel_photo_real'];
                    $kategori   = $jadwal['kategori_name'];
                ?>
                <h1><?= $judul; ?></h1>
                <div class="post_commentbox"> <a href="#"><i class="fa fa-user"></i><?= $created_by; ?></a> <span><i class="fa fa-calendar"></i><?= dateformatforview($date); ?></span> <a href="#"><i class="fa fa-tags"></i><?= $kategori; ?></a> </div>
                <div class="single_page_content"> <img class="img-center" src="<?= ($photo) ? base_url($photo) : base_url($photo_real); ?>" alt="">
                    <p><?= $isi ?>.</p>
                    <!-- <blockquote> Donec volutpat nibh sit amet libero ornare non laoreet arcu luctus. Donec id arcu quis mauris euismod placerat sit amet ut metus. Sed imperdiet fringilla sem eget euismod. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque adipiscing, neque ut pulvinar tincidunt, est sem euismod odio, eu ullamcorper turpis nisl sit amet velit. Nullam vitae nibh odio, non scelerisque nibh. Vestibulum ut est augue, in varius purus. </blockquote> -->
                    <!-- <ul>
                        <li>Nullam vitae nibh odio, non scelerisque nibh</li>
                        <li>Nullam vitae nibh odio, non scelerisque nibh</li>
                        <li>Nullam vitae nibh odio, non scelerisque nibh</li>
                        <li>Nullam vitae nibh odio, non scelerisque nibh</li>
                        <li>Nullam vitae nibh odio, non scelerisque nibh</li>
                        <li>Nullam vitae nibh odio, non scelerisque nibh</li>
                    </ul> -->
                </div>
                <div class="social_link">
                    <ul class="sociallink_nav">
                        <div class="sharethis-inline-share-buttons"></div>
                    </ul>
                </div>
                <div class="related_post">
                    <h2>Artikel Lainnya <i class="fa fa-thumbs-o-up"></i></h2>
                    <?php 
                        foreach($other_article as $key => $value) :
                            $id     = $value['artikel_id'];
                            $seo    = $value['artikel_pretty_url'];
                            $photo  = $value['artikel_photo'];
                            $isi    = $value['artikel_isi'];
                            $judul  = $value['artikel_judul'];
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
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4">
        <!-- load sidebar -->
        <?php $this->load->view('index/front/sidebar'); ?>
        <!-- end load -->
    </div>
</section>