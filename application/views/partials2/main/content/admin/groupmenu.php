<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Group Menu</h1>
        <div class="col-lg-3 breadcrumb-right">
            <ol class="breadcrumb">
                <?php $this->load->view("partials2/main/breadcrumb/breadcrumb2") ?>
            </ol>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?php echo base_url("admin/groupmenu/add_groupmenu") ?>" class="btn btn-success "> + New Group
                Menu</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Menu Description</th>
                            <th>Group Name</th>
                            <th>Access Indicator</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Menu Description</th>
                            <th>Group Name</th>
                            <th>Acces Indicator</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($dt as $key) {
                            if ($key != null) { ?>
                        <tr>
                            <td><?php echo $key['menudesc'] ?></td>
                            <td><?php echo $key['grpname'] ?></td>
                            <td><?php echo $key['accessind'] ?></td>
                            <td align="center">
                                <a
                                    href="<?php echo base_url("admin/groupmenu/edit_grpmenu?menucode=" . $key['menucode'] . "&grpcode=" . $key["grpcode"]); ?>">
                                    <button class="btn btn-warning btn-circle" data-toggle="tooltip" title="Edit"
                                        width="20" type="button" data-feather="edit-3"><i
                                            class="fas fa-edit"></i></button>
                                </a>
                                <!-- <a href="<?php echo base_url("admin/groupmenu/delete_grpmenu?menucode=" . $key['menucode'] . "&grpcode=" . $key["grpcode"]); ?>"> -->
                                <button class="btn btn-danger btn-circle" data-toggle="tooltip" title="Delete"
                                    width="20" type="button" disabled><i class="fas fa-trash"></i></button>
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