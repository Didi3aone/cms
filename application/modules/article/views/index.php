<!--MAIN CONTENT -->
<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
            <h1 class="page-title txt-color-blueDark"><?= $title_page ?></h1>
        </div>
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 col-lg-offset-1 text-right">
            <h1>
                <a class="btn btn-primary" href="<?= site_url(); ?>manager/article/create" rel="tooltip" title="Add new Group" data-placement="left">
                    <i class="fa fa-plus fa-lg"></i>
                </a>
            </h1>
        </div>
    </div>

    <!-- widget grid -->
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-001"
                    data-widget-editbutton="false"
                    data-widget-deletebutton="false"
                    data-widget-attstyle="jarviswidget-color-blueLight">

                    <header>
                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                        <h2> Article List</h2>
                    </header>

                    <!-- widget div-->
                    <div>
                        <!-- widget content -->
                        <div class="widget-body no-padding">
                            <!-- <div class="advanced-search"> -->
                            <table id="dataTable" class="table table-striped table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th class="hasinput" style="width:80px">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" id="id_filter" name="filter[id]" class="form-control filter-this" placeholder="Id" />
                                                    <div class="input-group-btn"><button type="button" class="clear-filter btn"><i class="fa fa-close"></i></button></div>
                                                </div>
                                            </div>

                                        </th>
                                        <th class="hasinput">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" id="name_filter" name="filter[judul]" class="form-control filter-this" placeholder="Judul" />
                                                    <div class="input-group-btn"><button type="button" class="clear-filter btn"><i class="fa fa-close"></i></button></div>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="hasinput">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" id="last_login_filter" name="filter[created]" class="form-control filter-this date-range-picker" placeholder="created Date" readonly />
                                                    <div class="input-group-btn"><button class="btn open-calendar-button" type="button"><i class="fa fa-calendar" aria-hidden="true"></i></button></div>
                                                </div>
                                            </div>
                                        </th>
                                        <th style="width:70px;"></th>
                                        <th></th>
                                        <th style="width:50px;"></th>
                                        <th style="width:97px;"></th>
                                    </tr>
                                    <tr>
                                        <th data-hide="expand">Artikel ID</th>
                                        <th data-class="expand"> Artikel Judul</th>
                                        <th data-hide="expand"> Artikel Created Date</th>
                                        <th data-hide="expand"> Penulis</th>
                                        <th data-hide="expand"> Gambar</th>
                                        <th data-hide="expand"> Status</th>
                                        <th> Action</th>
                                    </tr>
                                </thead>

                            </table>
                        </div> <!-- end widget content -->
                    </div> <!-- end widget div -->
                </div> <!-- end widget -->
            </article> <!-- WIDGET END -->
        </div> <!-- end row -->
    </section> <!-- end widget grid -->
</div> <!-- END MAIN CONTENT