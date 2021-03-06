<!--MAIN CONTENT -->
<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
            <h1 class="page-title txt-color-blueDark">Tag</h1>
        </div>
        <!-- <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 col-lg-offset-1 text-right">
            <h1>
                <a class="btn btn-primary" href="" rel="tooltip" title="Add new Group" data-placement="left">
                    <i class="fa fa-plus fa-lg"></i>
                </a>
            </h1>
        </div> -->
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
                        <h2>Tag list</h2>
                    </header>

                    <!-- widget div-->
                    <div>
                        <!-- widget content -->
                        <div class="widget-body no-padding">
                            <div class="advanced-search">
                                <!-- extra advaced search put here -->
                                <form class="smart-form adv-search-form">
                                    <header class="adv-search-form-header">
                                        <a href="#search-body" data-toggle="collapse" class="collapsed" aria-expanded="false">Advanced Search</a>
                                    </header>
                                    <div id="search-body" class="collapse" aria-expanded="false" style="height: 0px;">
                                        <fieldset>
                                            <section class="col col-6">
                                                <label class="label">Tanggal Terdaftar</label>
                                                <label class="input">
                                                    <input type="text" class="input-sm date-range-picker filter-this" name="filter[create_date]" id="created-date-range" readonly="readonly">
                                                </label>
                                            </section>
                                            <section class="col col-6">
                                                <label class="label">Tanggal Terupdate</label>
                                                <label class="input">
                                                    <input type="text" class="input-sm date-range-picker filter-this" name="filter[update_date]" id="updated-date-range" readonly="readonly">
                                                </label>
                                            </section>
                                        </fieldset>
                                        <footer class="adv-search-form-footer">
                                            <button type="button" class="btn btn-default" id="reset-button">Hapus</button>
                                            <button type="button" class="btn btn-info" id="search-button">Cari</button>
                                        </footer>
                                    </div>
                                </form>
                            </div>

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
                                        <th class="hasinput" style="width:280px">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" id="name_filter" name="filter[name]" class="form-control filter-this" placeholder="Nama Kategori" />
                                                    <div class="input-group-btn"><button type="button" class="clear-filter btn"><i class="fa fa-close"></i></button></div>
                                                </div>
                                            </div>
                                        </th>
                                        <!-- <th class="hasinput">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" id="username_filter" name="filter[username]" class="form-control filter-this" placeholder="Nama Group" />
                                                    <div class="input-group-btn"><button type="button" class="clear-filter btn"><i class="fa fa-close"></i></button></div>
                                                </div>
                                            </div>
                                        </th> -->
                                       <!--  <th class="hasinput">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" id="email_filter" name="filter[email]" class="form-control filter-this" placeholder="Email Admin" />
                                                    <div class="input-group-btn"><button type="button" class="clear-filter btn"><i class="fa fa-close"></i></button></div>
                                                </div>
                                            </div>
                                        </th> -->
                                     
                                        <!-- <th style="width:60px">
                                            <div class="btn-group btn-group-sm" data-toggle="buttons">
                                                <label class="btn btn-default btn-sm active">
                                                    <input type="radio" class="filter-this" name="filter[status]" value="active" autocomplete="off" checked> Y
                                                </label>
                                                <label class="btn btn-default btn-sm">
                                                    <input type="radio" class="filter-this" name="filter[status]" value="inactive" autocomplete="off"> N
                                                </label>
                                            </div> -->
                                      <!--   </th>
                                        <th style="width:100px">
                                        </th> -->
                                        <th style="width: 180px;"></th>
                                        <th style="width: 180px;"></th>
                                    </tr>
                                    <tr>
                                        <th data-hide="phone,tablet"> ID</th>
                                        <th data-class="expand"> Nama Kategori </th>
                                        <th data-hide="phone"> Created Date </th>
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