<div class="col-lg-8 col-md-8 col-sm-8">
    <div class="left_content">
        <div class="single_post_content">
            <h2><span>Akhlaq As Sunnah</span></h2>
            <div class="single_post_content_left">
                <ul class="business_catgnav  wow fadeInDown">
                    <?php 
                        $id         = $artikel_kiri_akhlaq['artikel_id'];
                        $judul      = $artikel_kiri_akhlaq['artikel_judul'];
                        $seo        = $artikel_kiri_akhlaq['artikel_pretty_url'];
                        $isi        = $artikel_kiri_akhlaq['artikel_isi'];
                        $created_by = $artikel_kiri_akhlaq['create_by'];
                        $date       = $artikel_kiri_akhlaq['artikel_created_date'];
                        $photo      = $artikel_kiri_akhlaq['artikel_photo'];
                    ?>
                    <li>
                        <figure class="bsbig_fig"> 
                            <a href="<?= site_url("article/read/".$id.'-'.$seo); ?>.html" class="featured_img"> 
                                <img alt="" src="<?= base_url($photo); ?>"> 
                                <!-- <span class="overlay"></span>  -->
                            </a>
                            <figcaption> 
                                <a href="<?= site_url("article/read/".$id.'-'.$seo); ?>.html"><?= $judul; ?></a>
                            </figcaption>
                            <p><?= limit_words($isi, 30); ?></p>
                            <p><i class="fa fa-calendar"></i>&nbsp;<?= dateformatforview($date); ?></p>
                            <p><i class="fa fa-user"></i>&nbsp;<?= $created_by; ?></p>
                        </figure>
                    </li>
                </ul>
            </div>

            <div class="single_post_content_right">
                <ul class="spost_nav">
                    <?php 
                        foreach($artikel_kanan_akhlaq as $key => $value) :
                            $id     = $value['artikel_id'];
                            $seo    = $value['artikel_pretty_url'];
                            $photo  = $value['artikel_photo'];
                            $isi    = $value['artikel_isi'];
                            $judul  = $value['artikel_judul'];
                    ?>
                    <li>
                        <div class="media wow fadeInDown"> 
                            <a href="<?= site_url("article/read/".$id.'-'.$seo); ?>.html" class="media-left"> 
                                <img alt="" src="<?= base_url($photo); ?>"> 
                            </a>
                            <div class="media-body"> 
                                <a href="<?= site_url("article/read/".$id.'-'.$seo); ?>.html" class="catg_title"> 
                                    <?= limit_words($isi, 30); ?>
                                </a> 
                            </div>
                        </div>
                    </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
        <div class="fashion_technology_area">
            <div class="fashion">
                <div class="single_post_content">
                    <h2><span>Amalan as sunnah</span></h2>
                    <ul class="business_catgnav wow fadeInDown">
                         <?php 
                            $judul      = $artikel_atas_amalan['artikel_judul'];
                            $seo        = $artikel_atas_amalan['artikel_pretty_url'];
                            $isi        = $artikel_atas_amalan['artikel_isi'];
                            $created_by = $artikel_atas_amalan['create_by'];
                            $date       = $artikel_atas_amalan['artikel_created_date'];
                            $photo      = $artikel_atas_amalan['artikel_photo'];
                        ?>
                        <li>
                            <figure class="bsbig_fig"> 
                                <a href="pages/single_page.html" class="featured_img"> 
                                    <img alt="" src="<?= base_url($photo); ?>"> 
                                    <span class="overlay"></span> 
                                </a>
                                <figcaption> 
                                    <a href="pages/single_page.html"><?= $judul; ?></a>
                                </figcaption>
                                <p><?= limit_words($isi, 30); ?></p>
                                <p><i class="fa fa-calendar"></i>&nbsp;<?= dateformatforview($date); ?></p>
                                <p><i class="fa fa-user"></i>&nbsp;<?= $created_by; ?></p>
                            </figure>
                        </li>
                    </ul>
                    <ul class="spost_nav">
                        <?php 
                            foreach($artikel_bawah_amalan as $key => $value) :
                                $id     = $value['artikel_id'];
                                $seo    = $value['artikel_pretty_url'];
                                $photo  = $value['artikel_photo'];
                                $isi    = $value['artikel_isi'];
                                $judul  = $value['artikel_judul'];
                        ?>
                        <li>
                            <div class="media wow fadeInDown"> 
                            <a href="<?= site_url("article/read/".$id.'-'.$seo); ?>.html" class="media-left"> 
                                <img alt="" src="<?= base_url($photo); ?>"> 
                            </a>
                                <div class="media-body"> 
                                    <a href="<?= site_url("article/read/".$id.'-'.$seo); ?>.html" class="catg_title"> 
                                        <?= limit_words($isi, 30); ?>
                                    </a> 
                                </div>
                            </div>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
            <div class="technology">
                <div class="single_post_content">
                    <h2><span>Jalan kebenaran as sunnah</span></h2>
                    <ul class="business_catgnav">
                        <?php 
                            $judul      = $artikel_atas_jalan['artikel_judul'];
                            $seo        = $artikel_atas_jalan['artikel_pretty_url'];
                            $isi        = $artikel_atas_jalan['artikel_isi'];
                            $created_by = $artikel_atas_jalan['create_by'];
                            $date       = $artikel_atas_jalan['artikel_created_date'];
                            $photo      = $artikel_atas_jalan['artikel_photo'];
                            // pr($artikel_atas_2);exit;
                        ?>
                        <li>
                            <figure class="bsbig_fig"> 
                                <a href="<?= site_url("article/read/".$id.'-'.$seo); ?>.html" class="featured_img"> 
                                    <img alt="" src="<?= base_url($photo); ?>"> 
                                    <span class="overlay"></span> 
                                </a>
                                <figcaption> 
                                    <a href="<?= site_url("article/read/".$id.'-'.$seo); ?>.html"><?= $judul; ?></a>
                                </figcaption>
                                <p><?= limit_words($isi, 30); ?></p>
                                <p><i class="fa fa-calendar"></i>&nbsp;<?= dateformatforview($date); ?></p>
                                <p><i class="fa fa-user"></i>&nbsp;<?= $created_by; ?></p>
                            </figure>
                        </li>
                    </ul>
                    <ul class="spost_nav">
                        <?php 
                            foreach($artikel_bawah_jalan as $key => $value) :
                                $id     = $value['artikel_id'];
                                $seo    = $value['artikel_pretty_url'];
                                $photo  = $value['artikel_photo'];
                                $isi    = $value['artikel_isi'];
                                $judul  = $value['artikel_judul'];
                        ?>
                        <li>
                            <div class="media wow fadeInDown"> 
                            <a href="<?= site_url("artikel/read/".$id.'-'.$seo); ?>.html" class="media-left"> 
                                <img alt="" src="<?= base_url($photo); ?>"> 
                            </a>
                                <div class="media-body"> 
                                    <a href="<?= site_url("artikel/read/".$id.'-'.$seo); ?>.html" class="catg_title"> 
                                        <?= limit_words($isi, 30); ?>
                                    </a> 
                                </div>
                            </div>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
        </div>
       
        <div class="single_post_content">
            <h2><span>Keluarga as sunnah</span></h2>
            <div class="single_post_content_left">
                <ul class="business_catgnav">
                    <?php 
                            $judul      = $artikel_atas_keluarga['artikel_judul'];
                            $seo        = $artikel_atas_keluarga['artikel_pretty_url'];
                            $isi        = $artikel_atas_keluarga['artikel_isi'];
                            $created_by = $artikel_atas_keluarga['create_by'];
                            $date       = $artikel_atas_keluarga['artikel_created_date'];
                            $photo      = $artikel_atas_keluarga['artikel_photo'];
                        ?>
                        <li>
                            <figure class="bsbig_fig"> 
                                <a href="<?= site_url("article/read/".$id.'-'.$seo); ?>.html" class="featured_img"> 
                                    <img alt="" src="<?= base_url($photo); ?>"> 
                                    <span class="overlay"></span> 
                                </a>
                                <figcaption> 
                                    <a href="<?= site_url("article/read/".$id.'-'.$seo); ?>.html"><?= $judul; ?></a>
                                </figcaption>
                                <p><?= limit_words($isi, 30); ?></p>
                                <p><i class="fa fa-calendar"></i>&nbsp;<?= dateformatforview($date); ?></p>
                                <p><i class="fa fa-user"></i>&nbsp;<?= $created_by; ?></p>
                            </figure>
                        </li>
                </ul>
            </div>
            <div class="single_post_content_right">
                <ul class="spost_nav">
                    <?php 
                        foreach($artikel_bawah_keluarga as $key => $value) :
                            $id     = $value['artikel_id'];
                            $seo    = $value['artikel_pretty_url'];
                            $photo  = $value['artikel_photo'];
                            $isi    = $value['artikel_isi'];
                            $judul  = $value['artikel_judul'];
                    ?>
                    <li>
                        <div class="media wow fadeInDown"> 
                        <a href="<?= site_url("artikel/read/".$id.'-'.$seo); ?>.html" class="media-left"> 
                            <img alt="" src="<?= base_url($photo); ?>"> 
                        </a>
                            <div class="media-body"> 
                                <a href="<?= site_url("artikel/read/".$id.'-'.$seo); ?>.html" class="catg_title"> 
                                    <?= limit_words($isi, 30); ?>
                                </a> 
                            </div>
                        </div>
                    </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </div>
</div>