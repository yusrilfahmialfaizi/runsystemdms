<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Privilege</h1>
        <div class="col-lg-2 breadcrumb-right">
            <ol class="breadcrumb">
                <?php $this->load->view("partials2/main/breadcrumb/breadcrumb2") ?>
            </ol>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?php echo base_url("admin/privilege/add_privilege") ?>" class="btn btn-success "> + New
                Privilege</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Privilege Code</th>
                            <th>Privilege Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- js -->
                        <?php foreach ($dt as $key) {
                        ?>
                        <tr>
                            <td><?php echo $key['privilegecode'] ?></td>
                            <td><?php echo $key['privilegename'] ?></td>
                            <td align="center">
                                <a
                                    href="<?php echo base_url("admin/privilege/edit_privilege?privilegecode=") . $key["privilegecode"]; ?>">
                                    <button class="btn btn-warning btn-circle" data-toggle="tooltip" title="Edit"
                                        width="20" type="button" data-feather="edit-3"
                                        data-id="<?php echo $key["privilegecode"]; ?>"><i
                                            class="fas fa-edit"></i></button>
                                </a>
                                <!-- <a href="<?php echo base_url("admin/privilege/delete?privilegecode=") . $key["privilegecode"]; ?>"> -->
                                <button disabled class="btn btn-danger btn-circle" data-toggle="tooltip" title="Delete"
                                    width="20" type="button" data-id="<?php echo $key["privilegecode"]; ?>"
                                    data-feather="x"><i class="fas fa-trash"></i></button>
                                <!-- </a> -->
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->