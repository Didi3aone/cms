<div class="col-md-12" style="margin-top: 10px;">
    <div class="row">
        <?php 
            foreach($jadwal['datas'] as $key => $value) :
                $id     = $value['jadwal_id'];
                $kat_id = $value['jadwal_kategori_id'];
                $seo    = $value['jadwal_name'];
                $photo  = $value['jadwal_photo'];
                $isi    = $value['jadwal_description'];
                $judul  = $value['jadwal_name'];
                $start  = $value['jadwal_start'];
                $end    = $value['jadwal_end'];
                $lokasi = $value['jadwal_location'];
                $kat    = $value['kategori_name'];
                $fix_url = str_replace(" ", "-", $seo);
        ?>
        <div class="col-md-4">
            <div class="thumbnail" id="article-container" style="box-shadow: 0 7px 13px rgba(0, 0, 0, 0.5);">
                <img class="img-responsive" src="<?= base_url($photo); ?>">
                <div class="caption">
                    <h4><?= $judul ?></h4>
                    <i class="fa fa-location-arrow"></i>&nbsp;Location&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; <strong><?= $lokasi ?></strong><br/>
                    <i class="fa fa-clock-o">&nbsp;<i class="fa fa-calendar"></i></i>Tanggal/Waktu  :&nbsp;&nbsp;<strong><?= $start; ?></strong>
                    <p><?= limit_words($isi, 25) ?></p> 
                    <p><?= $lokasi; ?></p>
                    <a href="<?= site_url("jadwal/detail/".$kat_id.'/'.$fix_url); ?>.html" class="btn btn-info btn-xs" role="button">Read More</a> 
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

<div class="related_post">
    <h2>Yang Mungkin anda suka <i class="fa fa-thumbs-o-up"></i></h2>
    <ul class="spost_nav wow fadeInDown animated">
        <li>
            <div class="media"> 
                <a class="media-left" href=""> 
                    <img class="img-responsive" src="" alt=""> 
                </a>
                <div class="media-body"> 
                    <a class="catg_title" href=""> </a> 
                </div>
            </div>
        </li>
    </ul>
</div>