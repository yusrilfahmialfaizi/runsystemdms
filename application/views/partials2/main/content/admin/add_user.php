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
                    <form class="needs-validation" novalidate="" action="<?php echo base_url("admin/user2/add") ?>" method="POST">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="usercode">User Code</label>
                                        <input class="form-control" id="usercode" name="usercode" type="text"
                                            placeholder="user code..." required="">
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
                                            placeholder="user name..." required="">
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
                                            <option value="<?php echo $key['grpcode'] ?>"><?php echo $key['grpname'] ?>
                                            </option>
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
                                            placeholder="password..." required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please provide a valid password.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="expdt">Exp Date</label>
                                        <input class="datepicker-here form-control digits" id="expdt" name="expdt"
                                            type="text" data-language="en" required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please provide a valid date.</div>

                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="notifyind">Notify
                                            Indicator</label>
                                        <input class="form-control" id="notifyind" name="notifyind" type="text"
                                            placeholder="notify indicator...">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0"
                                            for="hasqiscusaccount">Hasqiscusaccount</label>
                                        <input class="form-control" id="hasqiscusaccount" name="hasqiscusaccount" type="text"
                                            placeholder="hasqiscusaccount...">
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="form-group">
                                        <label class="col-form-label pt-0" for="avatarimage">Avatar Image</label>
                                        <input class="form-control" id="avatarimage" type="text" placeholder="avatar image...">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="deviceid">Device Id</label>
                                        <input class="form-control" id="deviceid" type="text" placeholder="device id...">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="createby">Create By</label>
                                        <input class="form-control" id="createby" type="text" placeholder="create by...">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="createdt">Create Date</label>
                                        <input class="form-control" id="createdt" type="text" placeholder="create date...">
                                    </div> -->
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary btn-pill">Submit</button>
                            <!-- <button class="btn btn-secondary btn-pill">Cancel</button> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>