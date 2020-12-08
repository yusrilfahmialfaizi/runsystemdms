<!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Project</h1>
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
                    <form action="<?php echo base_url("admin/project/edit") ?>" method="POST">
                        <div class="card-body">
                        <?php foreach ($dt as $data){ ?>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="Projectcode">Project Code</label>
                                        <input class="form-control" id="projectcode" name="projectcode" type="text" placeholder="Projectcode..." value="<?php echo $data['projectcode'] ?>" required="" readonly="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="Projectname">Project Name</label>
                                        <input class="form-control" id="projectname" name="projectname" type="text" value="<?php echo $data['projectname'] ?>" placeholder="Project name..." required="">
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
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="ctcode">CtCode</label>
                                        <input class="form-control" id="ctcode" name="ctcode" value="<?php echo $data['ctcode'] ?>" type="text" placeholder="CtCode..." >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary btn-pill">Submit</button>
                        </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>