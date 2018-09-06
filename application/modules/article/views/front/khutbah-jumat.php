<div class="col-md-12" style="margin-top: 10px;">
    <div class="row">
        <?php 
            foreach($khutbah['datas'] as $key => $value) :
                $id     = $value['artikel_id'];
                $seo    = $value['artikel_pretty_url'];
                $photo  = $value['artikel_photo'];
                $isi    = $value['artikel_isi'];
                $judul  = $value['artikel_judul'];
                $date   = $value['artikel_created_date'];
                $created_by = $value['username'];
                $photo_real = $value['artikel_photo_real'];
        ?>
        <div class="col-md-4">
            <div class="thumbnail" id="article-container" style="box-shadow: 0 7px 13px rgba(0, 0, 0, 0.5);">
                <img class="img-responsive" src="<?= ($photo) ? base_url($photo) : base_url($photo_real); ?>">
                <div class="caption">
                    <h4><?= $judul ?></h4>
                    <p><?= limit_words($isi, 25) ?></p> 
                    <p><i class="fa fa-calendar"></i>&nbsp;<?= dateformatforview($date); ?></p>
                    <p><i class="fa fa-user"></i>&nbsp;<?= $created_by; ?></p>
                    <a href="<?= site_url("article/read/".$id.'-'.$seo); ?>.html" class="btn btn-info btn-xs" role="button">Read More</a> 
                </div>
            </div>
        </div> 
        <?php endforeach;?>      
    </div><!--/row-->
</div><!--/container -->
<div class="social_link">
    <ul class="sociallink_nav">
        <div class="sharethis-inline-share-buttons"></div>
    </ul>
</div>
<center><?php echo $pagination; ?></center>
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
                <a class="media-left" href="<?= site_url("article/read/".$id.'/'.$seo); ?>.html"> 
                    <img class="img-responsive" src="<?= ($photo) ? base_url($photo) : base_url($photo_real); ?>" alt=""> 
                </a>
                <div class="media-body"> 
                    <a class="catg_title" href="<?= site_url("article/read/".$id.'/'.$seo); ?>.html"> <?= $judul; ?> </a> 
                </div>
            </div>
        </li>
    </ul>
    <?php endforeach;?>
</div>

<?php $this->load->view('article/front/load_js'); ?>