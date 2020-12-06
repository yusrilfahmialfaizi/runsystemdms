<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-lg-6 main-header">
          <h2>Data<span>Project</span></h2>
          <h6 class="mb-0">Document Manajement System</h6>
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
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <a href="<?php echo base_url("admin/project/add_project") ?>" class="btn btn-success"> + New Project</a>
          </div>
          <div class="card-body">
            <div class="dt-ext table-responsive">
              <table class="display" id="basic-fixed-header">
                <thead>
                  <tr>
                    <th>Project Code</th>
                    <th>Project Name</th>
                    <th>Action Indicator</th>
                    <th>CT Code</th>
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
                            <td><?php echo $key['actind'] ?></td>
                            <td><?php echo $key['ctcode'] ?></td>
                            <td>
                              <a href="<?php echo base_url("admin/project/edit_project?projectcode=").$key["projectcode"]; ?>">
                                <button data-toggle="tooltip" title="Edit" width="20" type="button" data-feather="edit-3"  data-id="<?php echo $key["projectcode"]; ?>">Edit</button>
                              </a>
                              <button data-toggle="tooltip" title="Delete" width="20" type="button" data-id="<?php echo $key["projectcode"]; ?>"data-feather="x">Delete</button>
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
    </div>
  </div>