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
                    <form class="needs-validation" novalidate="" action="<?php echo base_url("admin/groupmenu2/add") ?>"
                        method="POST">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="menucode">Menu Code</label>
                                        <select class="custom-select" id="menucode" name="menucode" required="">
                                            <option value="">--Pilih--</option>
                                            <?php print_r($menu); 
                                            foreach ($menu as $key){ ?>
                                            <option value="<?php echo $key['menucode'] ?>"><?php echo $key['menudesc'] ?>
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
                                        <label class="col-form-label pt-0" for="accessind">Access Indicator</label>
                                        <input class="form-control" id="accessind" name="accessind" type="text" placeholder="access indicator...">
                                    </div>
                                </div>
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
</div>
</div>
</div>