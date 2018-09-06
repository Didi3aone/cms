<?php
    $id   = isset($item["id"]) ? $item["id"] : "";
    $name       = isset($item["name"]) ? $item["name"] : "";
    $username   = isset($item["username"]) ? $item["username"] : "";
    $email      = isset($item["email"]) ? $item["email"] : "";
    $password   = isset($item["password"]) ? $item["password"] : "";
    $level   = isset($item["role_name"]) ? $item["role_name"] : "";
    // $last_login_time  = isset($item["last_login_time"]) ? $item["last_login_time"] : "";
    // $created_by_name     = isset($item["created_by_name"]) ? $item["created_by_name"] : "";
    // $last_updated_by_name     = isset($item["last_updated_by_name"]) ? $item["last_updated_by_name"] : "";
    // $deleted_by_name     = isset($item["deleted_by_name"]) ? $item["deleted_by_name"] : "";
    // $created_date     = isset($item["created_date"]) ? $item["created_date"] : "";
    // $updated_date     = isset($item["updated_date"]) ? $item["updated_date"] : "";
    // $deleted_date     = isset($item["deleted_date"]) ? $item["deleted_date"] : "";
    // $is_active        = isset($item["is_active"]) ? $item["is_active"] : "";
    // $is_active_name        = isset($item["is_active_name"]) ? $item["is_active_name"] : "";
    // $type        = isset($item["type"]) ? $item["type"] : "";
?>
<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
			<h1 class="page-title txt-color-blueDark"><?= $title_page ?></h1>
		</div>
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 col-lg-offset-1 text-right">
			<h1>
                <button class="btn btn-warning back-button" onclick="<?= (isset($back) ? "go('".$back."');" : "window.history.back();") ?>" title="Back" rel="tooltip" data-placement="left">
					<i class="fa fa-arrow-circle-left fa-lg"></i>
				</button>

                <button class="btn btn-primary back-button" onclick="go('/manager/admin/edit/<?= $id ?>');" title="Edit" rel="tooltip" data-placement="top">
					<i class="fa fa-pencil fa-lg"></i>
				</button>
			</h1>
		</div>
	</div>

    <!-- widget grid -->
    <section id="widget-grid" class="">

        <div class="row">
            <!-- NEW WIDGET ROW START -->
            <article class="col-sm-12 col-md-12 col-lg-12">

                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget" id="wid-id-0"
                data-widget-editbutton="false"
                data-widget-deletebutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
                        <h2>Detail Admin</h2>

                    </header>

                    <!-- widget div-->
                    <div>

                        <form class="smart-form" id="admin-form" method="post">
                            <fieldset>
                                <section>
                                    <label class="label">Name</label>
                                    <label class="input">
                                        <input type="text" name="name" value="<?= $name ?>" readonly>
                                    </label>
                                </section>
                                <section>
                                    <label class="label">User Level</label>
                                    <label class="input">
                                        <input type="text" name="name" value="<?= $level ?>" readonly>
                                        <i></i>
                                    </label>
                                </section>

                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label">Username</label>
                                        <label class="input">
                                            <input type="text" name="username" value="<?= $username ?>" readonly>
                                        </label>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label">Email</label>
                                        <label class="input">
                                            <input type="text" name="email" value="<?= $email ?>" readonly>
                                        </label>
                                    </section>
                                <div>
                            </fieldset>
                        </form>
                    </div>
                    <!-- end widget content -->
                </div>
                <!-- end widget div -->
            </article>
        </div>
    </section> <!-- end widget grid -->
</div> <!-- END MAIN CONTENT -->
