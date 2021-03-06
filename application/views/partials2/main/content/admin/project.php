<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Project</h1>
        <div class="col-lg-3 breadcrumb-right">
            <ol class="breadcrumb">
                <?php $this->load->view("partials2/main/breadcrumb/breadcrumb2") ?>
            </ol>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?php echo base_url("admin/project/add_project") ?>" class="btn btn-success "> + New Project</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Project Code</th>
                            <th>Project Name</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dt as $key) {
                            if ($key != null) {
                        ?>
                        <tr>
                            <td><?php echo $key['projectcode'] ?></td>
                            <td><?php echo $key['projectname'] ?></td>
                            <?php if ($key['actind'] == "Y") { ?>
                            <td>Yes</td>
                            <?php }else if ($key['actind'] == 'N'){ ?>
                            <td>No</td>
                            <?php } ?>
                            <td align="center">
                                <a
                                    href="<?php echo base_url("admin/project/edit_project?projectcode=") . $key["projectcode"]; ?>">
                                    <button class="btn btn-warning btn-circle" data-toggle="tooltip" title="Edit"
                                        width="20" type="button" data-feather="edit-3"
                                        data-id="<?php echo $key["projectcode"]; ?>"><i
                                            class="fas fa-edit"></i></button>
                                </a>
                                <!-- <a href="<?php echo base_url("admin/project/delete_project?projectcode=") . $key["projectcode"]; ?>"> -->
                                <button disabled class="btn btn-danger btn-circle" data-toggle="tooltip" title="Delete"
                                    width="20" type="button" data-id="<?php echo $key["projectcode"]; ?>"
                                    data-feather="x"><i class="fas fa-trash"></i></button>
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