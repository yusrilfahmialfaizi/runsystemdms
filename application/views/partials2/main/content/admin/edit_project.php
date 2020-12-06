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
                    <form class="needs-validation" novalidate="" action="<?php echo base_url("admin/project/edit") ?>" method="POST">
                        <div class="card-body">
                        <?php foreach ($dt as $data){ ?>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="Projectcode">Project Code</label>
                                        <input class="form-control" id="projectcode" name="projectcode" type="text" placeholder="Projectcode..." value="<?php echo $data['projectcode'] ?>" required="" readonly="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please provide a valid Projectcode.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="Projectname">Project Name</label>
                                        <input class="form-control" id="projectname" name="projectname" type="text" value="<?php echo $data['projectname'] ?>" placeholder="Project name..." required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please provide a valid Projectname.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="actind">Act Indicator</label>
                                        <select class="custom-select" id="actind" name="actind" required="">
                                            <option value="">--Pilih--</option>
                                            <?php if ($data['actind'] == "Y"){ ?>
                                            <option value="Y" selected>Yes</option>
                                            <?php }else{ ?>
                                            <option value="Y">Yes</option>
                                            <?php } ?>
                                            <?php if ($data['actind'] == "N"){ ?>
                                            <option value="N" selected>No</option>
                                            <?php }else{ ?>
                                            <option value="N">No</option>
                                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback">Please select </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="ctcode">CtCode</label>
                                        <input class="form-control" id="ctcode" name="ctcode" value="<?php echo $data['ctcode'] ?>" type="text" placeholder="CtCode..." >
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please provide a valid CtCode.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary btn-pill">Submit</button>
                            <!-- <button class="btn btn-secondary btn-pill">Cancel</button> -->
                        </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>