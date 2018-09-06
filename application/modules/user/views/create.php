<?php
    $id   = isset($item["id"]) ? $item["id"] : 0;
    $name       = isset($item["name"]) ? $item["name"] : "";
    $username   = isset($item["username"]) ? $item["username"] : "";
    $email      = isset($item["email"]) ? $item["email"] : "";
    $password   = isset($item["password"]) ? $item["password"] : "";
    $lastlogin_date  = isset($item["lastlogin_date"]) ? $item["lastlogin_date"] : "";
    $created_by_name     = isset($item["created_by_name"]) ? $item["created_by_name"] : "";
    $last_updated_by_name     = isset($item["last_updated_by_name"]) ? $item["last_updated_by_name"] : "";
    $deleted_by_name     = isset($item["deleted_by_name"]) ? $item["deleted_by_name"] : "";
    $created_date     = isset($item["created_date"]) ? $item["created_date"] : "";
    $updated_date     = isset($item["updated_date"]) ? $item["updated_date"] : "";
    $deleted_date     = isset($item["deleted_date"]) ? $item["deleted_date"] : "";
    $status        = isset($item["status"]) ? $item["status"] : "";
    $status_name        = isset($item["status_name"]) ? $item["status_name"] : "";
    $type        = isset($item["type"]) ? $item["type"] : "";

    $btn_msg = ($id == 0) ? "Create" : " Update";
    $title_msg = ($id == 0) ? "Create" : " Update";
?>
<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
			<h1 class="page-title txt-color-blueDark"><?= $title_page ?></h1>
		</div>
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 col-lg-offset-1 text-right">
			<h1>
                <button class="btn btn-warning back-button" onclick="<?= (isset($back) ? "go('".$back."');" : "window.history.back();") ?>" title="Back" rel="tooltip" data-placement="left" data-original-title="Batal">
					<i class="fa fa-arrow-circle-left fa-lg"></i>
				</button>
				<button class="btn btn-primary submit-form" data-form-target="admin-form" title="Simpan" rel="tooltip" data-placement="top" >
					<i class="fa fa-floppy-o fa-lg"></i>
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
                        <span class="widget-icon"> <i class="fa fa-pencil-square-o"></i> </span>
                        <h2><?= $title_msg ?> User</h2>

                    </header>

                    <!-- widget div-->
                    <div>

                        <form class="smart-form" id="admin-form" action="/manager/admin/process-form" method="post">
                                <?php if($id != 0): ?>
                                    <input type="hidden" name="id" value="<?= $id ?>" />
                                <?php endif; ?>
                                <fieldset>
                                    <section>
                                        <label class="label">Name <sup class="color-red">*</sup></label>
                                        <label class="input">
                                            <input type="text" name="name" value="<?= $name ?>" placeholder="Admin Name">
                                        </label>
                                    </section>
                                    <section>
                                        <label class="label">Level <sup class="color-red">*</sup></label>
                                        <label class="select">
                                            <?php select_role("role_id", $type, '') ?>
                                            <i></i>
                                        </label>
                                    </section>

                                    <div class="row">
                                        <section class="col col-6">
                                            <label class="label">Username <sup class="color-red">*</sup></label>
                                            <label class="input">
                                                <input type="text" name="username" value="<?= $username ?>" placeholder="Username">
                                            </label>
                                        </section>
                                        <section class="col col-6">
                                            <label class="label">Email <sup class="color-red">*</sup></label>
                                            <label class="input">
                                                <input type="text" name="email" value="<?= $email ?>" placeholder="Email">
                                            </label>
                                        </section>
                                        <?php if($id == 0): ?>
                                        <section class="col col-6">
                                            <label class="label">Password <sup class="color-red">*</sup></label>
                                            <label class="input">
                                                <input type="password" name="password" id="password" placeholder="Password">
                                            </label>
                                        </section>
                                        <section class="col col-6">
                                            <label class="label">Confirm New Password <sup class="color-red">*</sup></label>
                                            <label class="input">
                                                <input type="password" name="conf_password" placeholder="Confirm Password">
                                            </label>
                                        </section>
                                        <?php else: ?>
                                        <section class="col col-6">
                                            <label class="label">New Password</label>
                                            <label class="input">
                                                <input type="password" name="new_password" id="new_password" placeholder="New Password">
                                            </label>
                                        </section>
                                        <section class="col col-6">
                                            <label class="label">Confirm New Password</label>
                                            <label class="input">
                                                <input type="password" name="conf_new_password" placeholder="Confirm New Password">
                                            </label>
                                        </section>
                                        <?php endif; ?>

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
