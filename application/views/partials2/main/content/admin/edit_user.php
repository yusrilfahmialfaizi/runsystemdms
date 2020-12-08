<!-- Right sidebar Ends-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 main-header">
                    <h2>Add<span>Group</span></h2>
                    <h6 class="mb-0">admin dms</h6>
                </div>
                <div class="col-lg-6 breadcrumb-right">
                    <ol class="breadcrumb">
                        <?php $this->load->view("partials2/main/breadcrumb/breadcrumb2") ?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <!-- <h5>Basic form control</h5> -->
                    </div>
                    <form class="needs-validation" novalidate="" action="<?php echo base_url("admin/user2/edit") ?>" method="POST">
                        <div class="card-body">
                        <?php foreach($user as $us){ ?>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="usercode">User Code</label>
                                        <input class="form-control" id="usercode" name="usercode" type="text" placeholder="user code..." value="<?php echo $us['usercode'] ?>" required="">
                                        <input class="form-control" id="usercode_old" name="usercode_old" type="text" placeholder="user code..." value="<?php echo $us['usercode'] ?>" hidden="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please provide a valid usercode.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="username">User Name</label>
                                        <input class="form-control" id="username" name="username" type="text"
                                            placeholder="user name..." value="<?php echo $us['username'] ?>" required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please provide a valid username.</div>
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
                                            <option value="<?php echo $key['grpcode'] ?>" selected><?php echo $key['grpname'] ?>
                                            </option>
                                            <?php }else { ?>
                                            <option value="<?php echo $key['grpcode'] ?>"><?php echo $key['grpname'] ?>
                                            </option>
                                            <?php } ?>
                                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback">Please select </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="pwd">Password</label>
                                        <input class="form-control" id="pwd" name="pwd" type="password"
                                            placeholder="password..." value="<?php echo $us['pwd'] ?>" required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please provide a valid password.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="expdt">Exp Date</label>
                                        <?php $expdt = strtotime($us["expdt"]);?>
                                        <input class="datepicker-here form-control digits" id="expdt" name="expdt"
                                            type="text" data-language="en" value="<?php echo date("m/d/Y", $expdt) ?>" required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please provide a valid date.</div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input class="form-control" id="NotifyInd" name="NotifyInd" type="text" placeholder="user code..." value="<?php echo $us['notifyind'] ?>" hidden="" >
                                        <input class="form-control" id="HasQiscusAccount" name="HasQiscusAccount" type="text" placeholder="user code..." value="<?php echo $us['hasqiscusaccout'] ?>" hidden="" >
                                        <input class="form-control" id="NotifyInd" name="NotifyInd" type="text" placeholder="user code..." value="<?php echo $us['avatarimage'] ?>" hidden="" >
                                        <input class="form-control" id="NotifyInd" name="NotifyInd" type="text" placeholder="user code..." value="<?php echo $us['deviceid'] ?>" hidden="" >
                                </div>
                            </div>
                        <?php } ?>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary btn-pill">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>