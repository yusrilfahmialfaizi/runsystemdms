<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Group</h1>
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
                <form action="<?php echo base_url("admin/group/add") ?>"
                    method="POST">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <span style='color:#F00;'>*</span>
                                    <label class="col-form-label pt-0" for="grpcode">Group Code</label>
                                    <input class="form-control" id="grpcode" name="grpcode" type="text" placeholder="group code..." required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <span style='color:#F00;'>*</span>
                                    <label class="col-form-label pt-0" for="grpname">Group Name</label>
                                    <input class="form-control" id="grpname" name="grpname" type="text" placeholder="group name..." required="">
                                </div>
                            </div>
                        </div>
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