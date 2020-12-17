<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit User</h1>
        <div class="col-lg-4 breadcrumb-right">
            <ol class="breadcrumb">
                <?php $this->load->view("partials2/main/breadcrumb/breadcrumb2") ?>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 ">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <form action="<?php echo base_url("admin/user/edit") ?>" method="POST">
                    <div class="card-body">
                        <?php foreach($user as $us){ ?>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col-form-label pt-0" for="usercode">User Code</label>
                                    <input class="form-control" id="usercode" name="usercode" type="text"
                                        placeholder="user code..." value="<?php echo $us['usercode'] ?>" required=""
                                        readonly="">
                                    <input class="form-control" id="usercode_old" name="usercode_old" type="text"
                                        placeholder="user code..." value="<?php echo $us['usercode'] ?>" hidden="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col-form-label pt-0" for="username">User Name</label>
                                    <input class="form-control" id="username" name="username" type="text"
                                        placeholder="user name..." value="<?php echo $us['username'] ?>" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col-form-label pt-0" for="privilegecode">Privilege Code</label>
                                    <select class="custom-select" id="privilegecode" name="privilegecode" required="">
                                        <option value="">--Pilih--</option>
                                        <?php foreach ($prvl as $key) { ?>
                                        <?php if ($key['privilegecode'] == $us['privilegecode']){ ?>
                                        <option value="<?php echo $key['privilegecode'] ?>" selected>
                                            <?php echo $key['privilegename'] ?>
                                        </option>
                                        <?php }else { ?>
                                        <option value="<?php echo $key['privilegecode'] ?>">
                                            <?php echo $key['privilegename'] ?>
                                        </option>
                                        <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col-form-label pt-0" for="grpcode">Group Code</label>
                                    <select class="custom-select" id="grpcode" name="grpcode" required="">
                                        <option value="">--Pilih--</option>
                                        <?php foreach ($dt as $key){ ?>
                                        <?php if ($key['grpcode'] == $us['grpcode']){ ?>
                                        <option value="<?php echo $key['grpcode'] ?>" selected>
                                            <?php echo $key['grpname'] ?>
                                        </option>
                                        <?php }else { ?>
                                        <option value="<?php echo $key['grpcode'] ?>"><?php echo $key['grpname'] ?>
                                        </option>
                                        <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col-form-label pt-0" for="pwd">Password</label>
                                    <input class="form-control" id="pwd" name="pwd" type="password"
                                        placeholder="password..." value="<?php echo $us['pwd'] ?>" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col-form-label pt-0" for="expdt">Exp Date</label>
                                    <?php if ($us['expdt'] != null) { ?>
                                    <?php $expdt = strtotime($us["expdt"]);?>
                                    <input class="datepicker-here form-control digits" id="expdt" name="expdt"
                                        type="date" data-language="en" value="<?php echo date("Y-m-d", $expdt) ?>">
                                    <?php }else{ ?>
                                    <input class="datepicker-here form-control digits" id="expdt" name="expdt"
                                        type="date" data-language="en" value="">
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label class="col-form-label pt-0" for="expdt">Notify</label>
                                        <?php if ($us['notifyind'] == 'N') { ?>
                                        <input style="margin-left: 5px;" id="NotifyInd" type="checkbox">
                                        <?php }else{ ?>
                                        <input style="margin-left: 5px;" id="NotifyInd" name="NotifyInd" checked
                                            type="checkbox">
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label class="col-form-label pt-0" for="expdt">HasQiscusAccount</label>
                                        <?php if ($us['hasqiscusaccout'] == '1'){ ?>
                                        <input style="margin-left: 5px;" id="HasQiscusAccount" name="HasQiscusAccount"
                                            type="checkbox" checked>
                                        <?php }else{ ?>
                                        <input style="margin-left: 5px;" id="HasQiscusAccount" name="HasQiscusAccount"
                                            type="checkbox">
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col-form-label pt-0" for="expdt">Avatar Image</label>
                                    <input class="form-control-file" type="file" name="AvatarImage" id="AvatarImage">
                                    <input class="form-control" id="AvatarImage_old" name="AvatarImage_old" type="text"value="<?php echo $us['avatarimage'] ?>" hidden placeholder="avatar image...">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col-form-label pt-0" for="expdt">Device Id</label>
                                    <input class="form-control" id="deviceid" name="deviceid" type="text"
                                        value="<?php echo $us['deviceid'] ?>" placeholder="device id...">
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="card-footer">
                            <button class="btn btn-primary btn-pill">Submit</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>