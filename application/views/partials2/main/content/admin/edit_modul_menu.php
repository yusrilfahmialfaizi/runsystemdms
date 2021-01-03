<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Menu</h1>
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
                <form action="<?php echo base_url("admin/menu/edit") ?>" method="POST">
                    <div class="card-body">
                        <?php foreach ($data as $d) { ?>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <span style='color:#F00;'>*</span>
                                    <label class="col-form-label pt-0" for="menucode">Menu Code</label>
                                    <input class="form-control" id="menucode" name="menucode" type="text"
                                        placeholder="menu code..." value="<?php echo $d['menucode'] ?>" required="">
                                    <input class="form-control" id="menucode_old" name="menucode_old" type="text"
                                        placeholder="menu code..." readonly="" hidden=""
                                        value="<?php echo $d['menucode'] ?>" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <span style='color:#F00;'>*</span>
                                    <label class="col-form-label pt-0" for="modulcode">Modul Name</label>
                                    <select class="custom-select" id="modulcode" name="modulcode" required="">
                                        <option value="">--Pilih--</option>
                                        <?php foreach ($dt as $key){ ?>
                                        <?php if ($d['modulcode'] == $key['modulcode']) { ?>
                                        <option selected value="<?php echo $key['modulcode'] ?>">
                                            <?php echo $key['modulname'] ?>
                                        </option>
                                        <?php }else{ ?>
                                        <?php } ?>
                                        <option value="<?php echo $key['modulcode'] ?>"><?php echo $key['modulname'] ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <span style='color:#F00;'>*</span>
                                    <label class="col-form-label pt-0" for="menudesc">Menu Description</label>
                                    <textarea class="form-control" name="menudesc" id="menudesc" cols="30" rows="2"
                                        required=""><?php echo $d['menudesc'] ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <span style='color:#F00;'>*</span>
                                    <label class="col-form-label pt-0" for="parent">Parent</label>
                                    <select class="custom-select" id="parent" name="parent" required="">
                                        <option value="">--Pilih--</option>
                                        <?php if ($d['parent'] == "") { ?>
                                        <option selected value="">Root</option>
                                        <?php } ?>
                                        <?php foreach ($menu as $key){ ?>
                                        <?php if ($d['parent'] == $key['menucode']) { ?>
                                        <option selected value="<?php echo $key['menucode'] ?>">
                                            <?php echo $key['menudesc'] ?>
                                        </option>
                                        <?php }else{ ?>
                                        <?php if ($d['menudesc'] != $key['menudesc']) { ?>
                                        <option value="<?php echo $key['menucode'] ?>">
                                            <?php echo $key['menudesc'] ?>
                                        </option>
                                        <?php } ?>
                                        <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="card-footer">
                            <button class="btn btn-primary btn-pill">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>