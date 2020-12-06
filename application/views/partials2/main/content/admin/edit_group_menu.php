<!-- Right sidebar Ends-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 main-header">
                    <h2>Edit<span>Group</span></h2>
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
                    <form class="needs-validation" novalidate="" action="<?php echo base_url("admin/groupmenu/edit") ?>"
                        method="POST">
                        <div class="card-body">
                        <?php foreach ($grpmn as $g) { ?>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="menucode">Menu Description</label>
                                        <select class="custom-select" id="menucode" name="menucode" required="">
                                            <option value="">--Pilih--</option>
                                            <?php foreach ($menu as $key){ ?>
                                            <?php if ($g['menucode'] == $key['menucode']){ ?>
                                            <option selected value="<?php echo $key['menucode'] ?>"><?php echo $key['menudesc'] ?>
                                            </option>
                                            <?php }else{ ?>
                                            <option value="<?php echo $key['menucode'] ?>"><?php echo $key['menudesc'] ?>
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
                                        <label class="col-form-label pt-0" for="grpcode">Group Name</label>
                                        <select class="custom-select" id="grpcode" name="grpcode" required="">
                                            <option value="">--Pilih--</option>
                                            <?php foreach ($dt as $key){ ?>
                                            <?php if ($g['grpcode'] == $key['grpcode']){ ?>
                                            <option selected value="<?php echo $key['grpcode'] ?>"><?php echo $key['grpname'] ?>
                                            </option>
                                            <?php }else{ ?>
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
                                        <label class="col-form-label pt-0" for="accessind">Access Indicator</label>
                                        <input class="form-control" id="accessind" name="accessind" type="text" placeholder="access indicator..." value="<?php echo $g['accessind'] ?>" required="">
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
</div>
</div>
</div>