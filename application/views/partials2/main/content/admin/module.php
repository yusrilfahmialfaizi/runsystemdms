<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Module</h1>
        <div class="col-lg-3 breadcrumb-right">
            <ol class="breadcrumb">
                <?php $this->load->view("partials2/main/breadcrumb/breadcrumb2") ?>
            </ol>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?php echo base_url("admin/module/add_modul") ?>" class="btn btn-success "> + New Module</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Modul Code</th>
                            <th>Modul Name</th>
                            <th>Project Code</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Modul Code</th>
                            <th>Modul Name</th>
                            <th>Project Code</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <!-- js -->
                        <?php foreach ($dt as $key) {
                            if ($key != null) {
                        ?>

                                <tr>
                                    <td><?php echo $key['modulcode'] ?></td>
                                    <td><?php echo $key['modulname'] ?></td>
                                    <td><?php echo $key['projectcode'] ?></td>
                                    <td>
                                        <a href="<?php echo base_url("admin/module/edit_module?modulcode=") . $key["modulcode"]; ?>">
                                            <button class="btn btn-warning" data-toggle="tooltip" title="Edit" width="20" type="button" data-feather="edit-3" data-id="<?php echo $key["modulcode"]; ?>"><i class="fas fa-edit"></i></button>
                                        </a>
                                        <!-- <a href="<?php echo base_url("admin/module/delete_modul?modulcode=") . $key["modulcode"]; ?>"> -->
                                        <button disabled class="btn btn-danger" data-toggle="tooltip" title="Delete" width="20" type="button" data-id="<?php echo $key["modulcode"]; ?>" data-feather="x"><i class="fas fa-trash"></i></button>
                                        <!-- </a> -->
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->