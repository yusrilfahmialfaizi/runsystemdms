<!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Module</h1>
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
                    <form action="<?php echo base_url("admin/module/add") ?>"
                        method="POST">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <span style='color:#F00;'>*</span>
                                        <label class="col-form-label pt-0" for="modulcode">Modul Code</label>
                                        <input class="form-control" id="modulcode" name="modulcode" type="text" placeholder="modul code..." required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please provide a valid Modulcode.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <span style='color:#F00;'>*</span>
                                        <label class="col-form-label pt-0" for="modulname">Modul Name</label>
                                        <input class="form-control" id="modulname" name="modulname" type="text" placeholder="modul name..." required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please provide a valid Modulname.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <span style='color:#F00;'>*</span>
                                        <label class="col-form-label pt-0" for="projectcode">Project
                                            Name</label>
                                        <select class="custom-select" id="projectcode" name="projectcode" required="">
                                            <option value="">--Pilih--</option>
                                            <?php foreach ($project as $key){ ?>
                                            <option value="<?php echo $key['projectcode'] ?>"><?php echo $key['projectname'] ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please select.</div>
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
        </div>
        <div class="col-md-3"></div>
    </div>