<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Menu</h1>
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
                <form action="<?php echo base_url("admin/menu/add") ?>" method="POST">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <span style='color:#F00;'>*</span>
                                    <label class="col-form-label pt-0" for="menucode">Menu Code</label>
                                    <input class="form-control" id="menucode" name="menucode" type="text"
                                        placeholder="menu code..." required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="col-form-label pt-0" for="add_projectcode">Project Name</label>
                                    <select class="custom-select" id="add_projectcode" name="add_projectcode" required="">
                                        <option value="">--Pilih--</option>
                                        <?php print_r($dt1); 
                                            foreach ($dt1 as $key){ ?>
                                        <option value="<?php echo $key['projectcode']?>"><?php echo $key['projectcode'] ." - ". $key['projectname'] ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <span style='color:#F00;'>*</span>
                                    <label class="col-form-label pt-0" for="modulcode">Modul Name</label>
                                    <select class="custom-select" id="modulcode" name="modulcode" required="" disabled>
                                        <option value="">--Pilih--</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <span style='color:#F00;'>*</span>
                                    <label class="col-form-label pt-0" for="menudesc">Menu Description</label>
                                    <textarea class="form-control" name="menudesc" id="menudesc" cols="30" rows="2"
                                        required=""></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <span style='color:#F00;'>*</span>
                                    <label class="col-form-label pt-0" for="parent">Parent</label>
                                    <select class="custom-select" id="parent" name="parent" required="">
                                        <option value="">--Pilih--</option>
                                        <option value="">Root</option>
                                        <?php foreach ($menu as $key){ ?>
                                        <option value="<?php echo $key['menucode'] ?>"><?php echo $key['menudesc'] ?>
                                        </option>
                                        <?php } ?>
                                    </select>
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