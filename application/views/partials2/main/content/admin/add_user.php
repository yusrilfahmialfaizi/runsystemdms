    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add User</h1>
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
                <form action="<?php echo base_url("admin/user/add") ?>" method="POST">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col-form-label pt-0" for="usercode">User Code</label>
                                    <input class="form-control" id="usercode" name="usercode" type="text" placeholder="user code..." required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col-form-label pt-0" for="username">User Name</label>
                                    <input class="form-control" id="username" name="username" type="text" placeholder="user name..." required="">
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
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col-form-label pt-0" for="pwd">Password</label>
                                    <input class="form-control" id="pwd" name="pwd" type="password" placeholder="password..." required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col-form-label pt-0" for="expdt">Exp Date</label>
                                    <input class="datepicker-here form-control digits" id="expdt" name="expdt" type="date" data-language="en" required="">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary btn-pill">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>