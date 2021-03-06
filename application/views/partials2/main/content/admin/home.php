<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
    <div class="col-lg-20 breadcrumb-right">
      <ol class="breadcrumb">
        <?php $this->load->view("partials2/main/breadcrumb/breadcrumb2") ?>
    </ol>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                        <h6><strong>User</strong></h6></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $user ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-user fa-2x text-bllack-300" ></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        <h6><strong>Project</strong></h6></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $prj ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-briefcase fa-2x text-black-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><h6><strong>Module</strong></h6>
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $modul ?></div>
                            </div>
                            <div class="col">
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-folder fa-2x text-black-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        <h6><strong>Menu</strong></h6></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $menu ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-folder-open fa-2x text-black-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        <h6><strong>Group</strong></h6></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $group ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-users fa-2x text-black-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                        <h6><strong>Group Menu</strong></h6></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $gm ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-copy fa-2x text-black-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
                <!-- /.container-fluid -->