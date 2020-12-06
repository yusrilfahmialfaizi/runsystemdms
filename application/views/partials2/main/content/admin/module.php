<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-lg-6 main-header">
          <h2>Data<span>Module</span></h2>
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
            <a href="<?php echo base_url("admin/module/add_modul") ?>" class="btn btn-success"> + New Module</a>
          </div>
          <div class="card-body">
            <div class="dt-ext table-responsive">
              <table class="display" id="basic-fixed-header">
                <thead>
                  <tr>
                    <th>Module Code</th>
                    <th>Module Name</th>
                    <th>Project Code</th>
                    <th>Action</th>
                  </tr>
                </thead>
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
                              <a href="<?php echo base_url("admin/module/edit_module?modulcode=").$key["modulcode"]; ?>">
                                <button data-toggle="tooltip" title="Edit" width="20" type="button" data-feather="edit-3"  data-id="<?php echo $key["modulcode"]; ?>">Edit</button>
                              </a>
                              <button data-toggle="tooltip" title="Delete" width="20" type="button" data-id="<?php echo $key["modulcode"]; ?>"data-feather="x">Delete</button>
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