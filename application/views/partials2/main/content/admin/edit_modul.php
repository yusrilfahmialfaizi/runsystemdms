<!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Module</h1>
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
                    <form action="<?php echo base_url("admin/module/edit") ?>"
                        method="POST">
                        <div class="card-body">
                        <?php foreach ($dt as $data) { ?>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="modulcode">Modul Code</label>
                                        <input class="form-control" id="modulcode" name="modulcode" type="text" placeholder="modul code..." value="<?php echo $data['modulcode'] ?>" required="">
                                        <input class="form-control" id="modulcode_old" name="modulcode_old" readonly="" hidden="" type="text" placeholder="modul code..." value="<?php echo $data['modulcode'] ?>" required=""> 
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="modulname">Modul Name</label>
                                        <input class="form-control" id="modulname" name="modulname" type="text" placeholder="modul name..." value="<?php echo $data['modulname'] ?>" required=""> 
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="projectcode">Project
                                            Name</label>
                                            <input class="form-control" id="projectcode_old" name="projectcode_old" type="text" value="<?php echo $data['projectcode'] ?>" required="" hidden>
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
        <div class="col-md-3"></div>
    </div>