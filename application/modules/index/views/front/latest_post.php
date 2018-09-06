<div class="col-lg-4 col-md-4 col-sm-4">
    <div class="latest_post">
        <h2><span>Latest post</span></h2>
        <div class="latest_post_container">
            <div id="prev-button"><i class="fa fa-chevron-up"></i></div>
            <ul class="latest_postnav">
                <?php 
                    foreach($lat_post as $key => $value) :
                        $id     = $value['artikel_id'];
                        $real   = $value['artikel_photo_real'];
                        $seo    = $value['artikel_pretty_url'];
                        $photo  = $value['artikel_photo'];
                        $isi    = $value['artikel_isi'];
                        $judul  = $value['artikel_judul'];
                        // pr(limit_words($isi, 25));
                        // pr($real);exit;
                ?>
                <li>
                    <div class="media"> 
                        <a href="<?= site_url("article/read/".$id.'/'.$seo); ?>" class="media-left"> 
                            <img alt="" src="<?= base_url($real); ?>"> 
                        </a>
                        <div class="media-body"> 
                            <a href="<?= site_url("article/read/".$id.'/'.$seo); ?>" class="catg_title"> 
                                <?= limit_words(strip_tags($isi), 20); ?>
                            </a> 
                        </div>
                    </div>
                </li>
                <?php endforeach;?>
            </ul>
            <div id="next-button"><i class="fa  fa-chevron-down"></i></div>
        </div>
    </div>
</div>
