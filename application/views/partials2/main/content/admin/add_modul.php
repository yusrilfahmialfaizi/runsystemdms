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
            <div class="col-sm-12 col-xl-6">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="theme-form">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="modulcode">Modul Code</label>
                                        <input class="form-control" id="modulcode" type="text" placeholder="modul code...">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="modulname">Modul Name</label>
                                        <input class="form-control" id="modulname" type="text" placeholder="modul name...">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="projectcode">Project Code</label>
                                        <input class="form-control" id="projectcode" type="text" placeholder="project code...">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="createby">Create By</label>
                                        <input class="form-control" id="createby" type="text" placeholder="create by...">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="createdt">Create Date</label>
                                        <input class="form-control" id="createdt" type="text" placeholder="create date...">
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary btn-pill">Submit</button>
                                <button class="btn btn-secondary btn-pill">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>