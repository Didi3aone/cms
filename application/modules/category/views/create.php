<?php
    $id                 = isset($item["category_id"]) ? $item["category_id"] : "";
    $name               = isset($item["name"]) ? $item["name"] : "";
    $selected = "";
    $btn_msg            = ($id == 0) ? "Create" : " Update";
    $header_title       = ($id == 0) ? "Buat Kategori Baru" : " Edit Kategori";
    // print_r($category);
?>

<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
            <h1 class="page-title txt-color-blueDark"><?= $title_page ?></h1>
        </div>
    </div>

    <section id="widget-grid" class="">
        <article>
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-pencil-square-o"></i> </span>
                    <h2><?= $header_title; ?></h2>
                </header>

                <!-- FORM FIELDS -->
                <div>
                    <form class="smart-form" id="category-create" action="/manager/category/do-create" method="post">
                        <fieldset>
                            <div class="row">
                                <section class="col col-6">
                                    <label class="label">Parent <sup class="color-red">*</sup></label>
                                    <label class="input">
                                        <select name="parent" class="form-control custom-select" id="myselect" data-placeholder="Choose a Category" tabindex="1">
                                            <option>Root</option>
                                            <?php
                                                foreach($category as $key => $value) {
                                                    // print_r($value);
                                                    if($value['name'] == $parent) {
                                                        echo '<option selected>'.$value['name'].'</option>';
                                                    }
                                                    else{
                                                        echo '<option>'.$value['name'].'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </label>
                                </section>
                                <section class="col col-6">
                                    <label class="label">Category Name <sup class="color-red">*</sup></label>
                                    <label class="input">
                                        <input type="text" name="name" value="<?= $name ?>">
                                    </label>
                                </section>
                            </div>     
                        </fieldset>

                        <footer>
                            <button type="submit" class="btn btn-primary"><?= $btn_msg ?></button>
                            <button type="button" class="btn btn-danger" onclick="go('/web_dakwah/manager/category')">Cancel</button>
                        </footer>

                        <!-- HIDDEN FIELDS -->
                        <input type="hidden" name="id" value="<?= $id ?>" />
                    </form>
                </div>
                <!-- END OF FORM FIELDS -->
            </div>
        </article>
    </section>
</div>