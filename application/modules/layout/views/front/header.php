<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?= TITLE_WEBSITE; ?></title>
    <meta name="description" content="<?= isset($description) ? $description : "" ?>" />
    <meta name="keywords" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="author" content="<?= isset($header) ? $header : ""; ?>">
    <link rel="alternate" href="<?= base_url() ?>" hreflang="id-id" />
    <meta name="keywords" content="Weblog a Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
    Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/frontend/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/frontend/assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/frontend/assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/frontend/assets/css/font.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/frontend/assets/css/li-scroller.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/frontend/assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/frontend/assets/css/jquery.fancybox.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/frontend/assets/css/theme.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>asset/frontend/assets/css/style.css">
<!--[if lt IE 9]>
<script src="assets/js/html5shiv.min.js"></script>
<script src="assets/js/respond.min.js"></script>
<![endif]-->
</head>
<body>
    <div id="preloader">
        <!-- <div id="status">&nbsp;</div> -->
    </div>
    <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
    <div class="container">
        <header id="header">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="header_top">
                        <div class="header_top_left">
                            <ul class="top_nav">
                            </ul>
                        </div>
                        <div class="header_top_right">
                            <p><?php //date('Y-m-d'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="header_bottom">
                        <div class="logo_area"><a href="<?= site_url(); ?>" class="logo"><img src="<?= base_url(); ?>asset/images/MIAS-LOGO.png" alt=""></a></div>
                        <div class="add_banner"><a href="#"><img src="<?= base_url(); ?>asset/images/Mias-Donasi-2.jpg" alt=""></a></div>
                    </div>
                </div>
            </div>
        </header>
        <section id="navArea">
            <nav class="navbar navbar-inverse" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav main_nav">
                        <li class="active"><a href="<?= site_url(); ?>"><span class="fa fa-home desktop-home"></span><span class="mobile-show">Tentang Kami</span></a></li>
                        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Belajar As Sunnah </a>
                            <ul class="dropdown-menu" role="menu">
                                <?php 
                                    foreach( $kategori as $key => $value ) :
                                    $name   = $value['name'];
                                    $fix_url = str_replace(" ", "-", $name);
                                ?>
                                <li><a href="<?= site_url('article/kategori/'.$fix_url); ?>"><?= $name ?></a></li>
                                <?php endforeach;?>
                            </ul>
                        </li>
                        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Sholat jum'at </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?= site_url('jadwal/sholat-jumat'); ?>">Jadwal Sholat jum'at</a></li>
                                <li><a href="<?= site_url('article/khutbah-jumat'); ?>">Khutbah Jum'at</a></li>
                            </ul>
                        </li>
                        <li class="">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Informasi</a>
                            <ul class="dropdown-menu multi-level">
                                <!-- <li class="divider"></li> -->
                                <li class="dropdown dropdown-submenu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Jadwal Kajian</a>
                                    <ul class="dropdown dropdown-menu">
                                        <li><a href="<?= site_url('jadwal/akhwat'); ?>">Kajian akhwat</a></li>
                                        <li><a href="<?= site_url('jadwal/ikhwan'); ?>">Kajian ikhwan</a></li>
                                        <li><a href="<?= site_url('jadwal'); ?>">Kajian umum</a></li>
                                        <!-- <li class="divider"></li> -->
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dokumentasi Kajian</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?= site_url('gallery-kajian'); ?>">Gallery Kajian</a></li>
                                        <li><a href="<?= site_url('article-video/video'); ?>">Gallery Video Kajian</a></li>
                                        <li><a href="<?= site_url('pembangunan-mias'); ?>">Pembangunan Mias</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="#">Hubungi Kami</a></li>
                        <li><a href="<?= site_url('article-video/video/live-streaming'); ?>">Live Streaming</a></li>
                        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Lainnya </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Donasi</a></li>
                                <!-- <li><a href="#">Tentang Kami</a></li> -->
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </section>
        <!-- marquee latest news -->
        <section id="newsSection">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="latest_newsarea"> <span>Latest article</span>
                        <ul id="ticker01" class="news_sticker">
                            <?php 
                                foreach($lat_post as $val) :
                            ?>
                            <li><a href="<?= site_url('article/read/'.$val['artikel_pretty_url']);?>"><img src="<?= ($val['artikel_photo']) ? base_url($val['artikel_photo']) : base_url($val['artikel_photo_real']); ?>" alt=""><?= $val['artikel_judul']; ?></a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="social_area">
                            <ul class="social_nav">
                                <li class="facebook"><a href="#"></a></li>
                                <li class="youtube"><a href="#"></a></li>
                                <li class="mail"><a href="#"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- load slider -->
        <?php //$this->load->view('index/front/slider'); ?>
        <!-- end load -->