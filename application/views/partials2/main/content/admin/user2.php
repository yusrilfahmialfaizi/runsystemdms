<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data User</h1>
        <div class="col-lg-2 breadcrumb-right">
            <ol class="breadcrumb">
                <?php $this->load->view("partials2/main/breadcrumb/breadcrumb2") ?>
            </ol>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?php echo base_url("admin/user2/add_user") ?>" class="btn btn-success "> + New User</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>UserCode</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Expired Date</th>
                            <th>Notivy Indicator</th>
                            <th>Avatar Image</th>
                            <th>Device id</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>UserCode</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Expired Date</th>
                            <th>Notivy Indicator</th>
                            <th>Avatar Image</th>
                            <th>Device id</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                      <!-- js -->
                      <?php foreach ($dt as $key) {
                          if ($key != null) {
                            ?>
                            <tr>
                                <td><?php echo $key['usercode'] ?></td>
                                <td><?php echo $key['username'] ?></td>
                                <td><?php echo $key['grpcode'] ?></td>
                                <td><?php echo $key['expdt'] ?></td>
                                <td><?php echo $key['notifyind'] ?></td>
                                <td><?php echo $key['avatarimage'] ?></td>
                                <td><?php echo $key['deviceid'] ?></td>
                                <td>
                                <a href="<?php echo base_url("admin/user/edit_user?usercode=").$key["usercode"]; ?>">
                                    <button data-toggle="tooltip" title="Edit" width="20" type="button" data-feather="edit-3"  data-id="<?php echo $key["usercode"]; ?>"><i class="fas fa-edit"></i></button>
                                </a>
                                <button data-toggle="tooltip" title="Delete" width="20" type="button" data-id="<?php echo $key["usercode"]; ?>"data-feather="x"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php } } ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->
