<aside class="right_content">
    <div class="single_sidebar">
        <h2><span>Popular Post</span></h2>
        <ul class="spost_nav">
            <?php 
                foreach($pop_post as $key => $value) :
                    // pr($pop_post);exit;
                    $id     = $value['artikel_id'];
                    $seo    = $value['artikel_pretty_url'];
                    $photo  = $value['artikel_photo'];
                    $isi    = $value['artikel_isi'];
                    $judul  = $value['artikel_judul'];
                    $photo_real = $value['artikel_photo_real'];
            ?>
            <li>
                <div class="media wow fadeInDown"> 
                <a href="<?= site_url("article/read/".$id.'/'.$seo); ?>.html" class="media-left"> 
                    <img alt="" src="<?= ($photo) ? base_url($photo) : base_url($photo_real); ?>"> 
                </a>
                    <div class="media-body"> 
                        <a href="<?= site_url("article/read/".$id.'/'.$seo); ?>.html" class="catg_title"> 
                            <?= limit_words(strip_tags($isi), 20); ?>
                        </a> 
                    </div>
                </div>
            </li>
            <?php endforeach;?>
        </ul>
    </div>
    <div class="single_sidebar">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#category" aria-controls="home" role="tab" data-toggle="tab">Category</a></li>
            <!-- <li role="presentation"><a href="#video" aria-controls="profile" role="tab" data-toggle="tab">Latest Video</a></li> -->
            <li role="presentation"><a href="#tag" aria-controls="messages" role="tab" data-toggle="tab">#Tag</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="category">
                <ul>
                    <?php 
                        foreach( $kategori as $key => $value ) :
                            $name   = $value['name'];
                            $fix_url = str_replace(" ", "-", $name);
                            // pr($kategori);exit;
                    ?>
                    <li class="cat-item" style="margin-left: 2.8px;">
                        <a href="<?= site_url("article/kategori/".$fix_url); ?>"><?= $name; ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div role="tabpanel" class="tab-pane" id="video">
                <!-- <div class="vide_area">
                    <iframe width="100%" height="250" src="http://www.youtube.com/embed/h5QWbURNEpA?feature=player_detailpage" frameborder="0" allowfullscreen></iframe>
                </div> -->
            </div>
            <div role="tabpanel" class="tab-pane" id="tag">
                <ul>
                    <?php 
                        foreach($tag as $key => $value) :
                            $id         = $value['id'];
                            $name       = $value['tag'];
                            $seo        = $value['artikel_pretty_url'];
                            $artikel_id = $value['artikel_id'];
                            // pr($value);
                    ?>
                    <li class="cat-item" style="margin-left: 2.8px;">
                        <a href="<?= site_url("article/tag/".$id.'/'.$seo); ?>"><?= "#".$name; ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="single_sidebar wow fadeInDown">
        <h2><span>Infaq & Shodaqoh</span></h2>
        <a class="sideAdd" href="#">
            <img src="<?= base_url(); ?>asset/images/Infaq-Shodaqoh.jpg" alt="">
        </a> 
        <p style="margin-left: 2.8px;">EXAMPLE</p>
    </div>
    <div class="single_sidebar wow fadeInDown">
        <!-- <p style="text-align: center;"><iframe src="https://time.wf/widget.php" scrolling="no" frameborder="0" width="110" height="45"></iframe><br><iframe src="https://www.jadwalsholat.org/adzan/ajax.row.php?id=308" frameborder="0" width="220" height="220"></iframe><a href="https://www.jadwalsholat.org" target="_blank"><img class="aligncenter" style="text-align: center;" alt="jadwal-sholat" src="https://www.jadwalsholat.org/wp-content/uploads/2013/09/jadwal-sholat.png" width="81" height="18" /></a></p> -->
    </div>
    <!-- <div class="single_sidebar wow fadeInDown">
        <h2><span>Category Archive</span></h2>
        <select class="catgArchive">
            <option>Select Category</option>
            <option>Life styles</option>
            <option>Sports</option>
            <option>Technology</option>
            <option>Treads</option>
        </select>
    </div> -->
    <!-- <div class="single_sidebar wow fadeInDown">
        <h2><span>Links</span></h2>
        <ul>
            <li><a href="#">Rss Feed</a></li>
            <li><a href="#">Login</a></li>
            <li><a href="#">Life &amp; Style</a></li>
        </ul>
    </div> -->
    <!-- <div class="singele_sidebar wow fadeInDown">
        <p style="text-align: center;"><iframe src="https://time.wf/widget.php" scrolling="no" frameborder="0" width="110" height="45"></iframe><br><iframe src="https://www.jadwalsholat.org/adzan/ajax.row.php?id=308" frameborder="0" width="220" height="220"></iframe><a href="https://www.jadwalsholat.org" target="_blank"><img class="aligncenter" style="text-align: center;" alt="jadwal-sholat" src="https://www.jadwalsholat.org/wp-content/uploads/2013/09/jadwal-sholat.png" width="81" height="18" /></a></p>
    </div> -->
</aside>