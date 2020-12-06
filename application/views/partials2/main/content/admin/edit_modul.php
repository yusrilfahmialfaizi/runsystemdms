<!-- Right sidebar Ends-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 main-header">
                    <h2>Add<span>Modul</span></h2>
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
                    <form class="needs-validation" novalidate="" action="<?php echo base_url("admin/module/edit") ?>"
                        method="POST">
                        <div class="card-body">
                        <?php foreach ($dt as $data) { ?>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="modulcode">Modul Code</label>
                                        <input class="form-control" id="modulcode" name="modulcode" type="text" placeholder="modul code..." value="<?php echo $data['modulcode'] ?>" required="">
                                        <input class="form-control" id="modulcode_old" name="modulcode_old" readonly="" hidden="" type="text" placeholder="modul code..." value="<?php echo $data['modulcode'] ?>" required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please provide a valid Modulcode.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="modulname">Modul Name</label>
                                        <input class="form-control" id="modulname" name="modulname" type="text" placeholder="modul name..." value="<?php echo $data['modulname'] ?>" required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please provide a valid Modulname.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="projectcode">Project
                                            Name</label>
                                        <select class="custom-select" id="projectcode" name="projectcode" required="">
                                            <option value="">--Pilih--</option>
                                            <?php foreach ($project as $key){ ?>
                                            <?php if ($data['projectcode'] == $key['projectcode']){ ?>
                                            <option selected value="<?php echo $key['projectcode'] ?>"><?php echo $key['projectname'] ?>
                                            </option>
                                            <?php }else{ ?>
                                            <option value="<?php echo $key['projectcode'] ?>"><?php echo $key['projectname'] ?>
                                            </option>
                                            <?php } ?>
                                            <?php } ?>
                                            <div class="valid-feedback">Looks good!</div>
                                            <div class="invalid-feedback">Please select.</div>
                                        </select>
                                    </div>
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