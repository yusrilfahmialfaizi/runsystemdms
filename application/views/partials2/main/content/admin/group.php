<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Group</h1>
        <div class="col-lg-2 breadcrumb-right">
            <ol class="breadcrumb">
                <?php $this->load->view("partials2/main/breadcrumb/breadcrumb2") ?>
            </ol>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?php echo base_url("admin/group/add_group") ?>" class="btn btn-success "> + New Group</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Group Code</th>
                            <th>Group Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Group Code</th>
                            <th>Group Name</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($dt as $key) {
                            if ($key != null) {
                                ?>
                                <tr>
                                    <td><?php echo $key['grpcode'] ?></td>
                                    <td><?php echo $key['grpname'] ?></td>
                                    <td>
                                        <a href="<?php echo base_url("admin/group/edit_grp?grpcode=").$key["grpcode"]; ?>">
                                            <button class="btn btn-warning" data-toggle="tooltip" title="Edit" width="20" type="button" data-feather="edit-3"  ><i class="fas fa-edit"></i></button>
                                        </a>
                                        <button class="btn btn-danger" data-toggle="tooltip" title="Delete" width="20" type="button" ><i class="fas fa-trash"></i></button>
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
