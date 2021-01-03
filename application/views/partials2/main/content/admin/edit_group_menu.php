<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Group Menu</h1>
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
                <form action="<?php echo base_url("admin/groupmenu/edit") ?>" method="POST">
                    <div class="card-body">
                        <?php foreach ($grpmn as $g) { ?>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <span style='color:#F00;'>*</span>
                                    <label class="col-form-label pt-0" for="menucode">Menu Description</label>
                                    <select class="custom-select" id="menucode" name="menucode" required="">
                                        <option value="">--Pilih--</option>
                                        <?php foreach ($menu as $key){ ?>
                                        <?php if ($g['menucode'] == $key['menucode']){ ?>
                                        <option selected value="<?php echo $key['menucode'] ?>">
                                            <?php echo $key['menudesc'] ?>
                                        </option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $key['menucode'] ?>"><?php echo $key['menudesc'] ?>
                                            <?php } ?>
                                            <?php } ?>
                                    </select>
                                    <input class="form-control" id="menucode_old"  name="menucode_old" type="text" placeholder="access indicator..." value="<?php echo $g['menucode'] ?>"required="" hidden="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <span style='color:#F00;'>*</span>
                                    <label class="col-form-label pt-0" for="grpcode">Group Name</label>
                                    <select class="custom-select" id="grpcode" name="grpcode" required="">
                                        <option value="">--Pilih--</option>
                                        <?php foreach ($dt as $key){ ?>
                                        <?php if ($g['grpcode'] == $key['grpcode']){ ?>
                                        <option selected value="<?php echo $key['grpcode'] ?>">
                                            <?php echo $key['grpname'] ?>
                                        </option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $key['grpcode'] ?>"><?php echo $key['grpname'] ?>
                                        </option>
                                        <?php } ?>
                                        <?php } ?>
                                    </select>
                                    <input class="form-control" id="grpcode_old" name="grpcode_old" type="text" placeholder="access indicator..." value="<?php echo $g['grpcode'] ?>"required="" hidden="">
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