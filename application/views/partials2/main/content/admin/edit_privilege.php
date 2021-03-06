<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Privilege</h1>
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
                <form action="<?php echo base_url("admin/privilege/edit") ?>"
                    method="POST">
                    <div class="card-body">
                    <?php foreach ($dt as $key){ ?>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col-form-label pt-0" for="privilegecode">Privilege Code</label>
                                    <input class="form-control" id="privilegecode" name="privilegecode" type="text" placeholder="Privilege code..." value="<?php echo $key['privilegecode'] ?>" required="">
                                    <input class="form-control" id="privilegecode_old" name="privilegecode_old" type="text" placeholder="Privilege code..." value="<?php echo $key['privilegecode'] ?>" required="" hidden="">
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col-form-label pt-0" for="privilegename">Privilege Name</label>
                                    <input class="form-control" id="privilegename" name="privilegename" type="text" placeholder="Privilege name..." value="<?php echo $key['privilegename'] ?>" required="">
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