<!-- Right sidebar Ends-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 main-header">
                    <h2>Add<span>Modul Menu</span></h2>
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
                    <form class="needs-validation" novalidate="" action="<?php echo base_url("admin/menu/add") ?>" method="POST">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="menucode">Menu Code</label>
                                        <input class="form-control" id="menucode" name="menucode" type="text" placeholder="menu code..." required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please provide a valid Menucode.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="modulcode">Modul Name</label>
                                        <select class="custom-select" id="modulcode" name="modulcode" required="">
                                            <option value="">--Pilih--</option>
                                            <?php print_r($dt); 
                                            foreach ($dt as $key){ ?>
                                            <option value="<?php echo $key['modulcode'] ?>"><?php echo $key['modulname'] ?>
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
                                        <label class="col-form-label pt-0" for="menudesc">Menu Description</label>
                                        <textarea class="form-control" name="menudesc" id="menudesc" cols="30" rows="10" required=""></textarea>
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please provide a valid Menudesc.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="parent">Parent</label>
                                        <select class="custom-select" id="parent" name="parent" required="">
                                            <option value="">--Pilih--</option>
                                            <option value="">Root</option>
                                            <?php foreach ($menu as $key){ ?>
                                            <option value="<?php echo $key['menucode'] ?>"><?php echo $key['menudesc'] ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback">Please select </div>
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