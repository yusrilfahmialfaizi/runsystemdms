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
            <div class="col-sm-12 col-xl-6">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="theme-form">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="usercode">User Code</label>
                                        <input class="form-control" id="usercode" type="text" placeholder="user code...">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="username">User Name</label>
                                        <input class="form-control" id="username" type="text" placeholder="user name...">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="grpcode">Group Code</label>
                                        <input class="form-control" id="grpcode" type="text" placeholder="group code...">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="pwd">Password</label>
                                        <input class="form-control" id="pwd" type="password" placeholder="password...">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="expdt">Exp Date</label>
                                        <input class="form-control" id="expdt" type="text" placeholder="exp date...">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="notifyind">Notify Indicator</label>
                                        <input class="form-control" id="notifyind" type="text" placeholder="notify indicator...">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="hasqiscusaccount">Hasqiscusaccount</label>
                                        <input class="form-control" id="hasqiscusaccount" type="text" placeholder="hasqiscusaccount...">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="avatarimage">Avatar Image</label>
                                        <input class="form-control" id="avatarimage" type="text" placeholder="avatar image...">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label pt-0" for="deviceid">Device Id</label>
                                        <input class="form-control" id="deviceid" type="text" placeholder="device id...">
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