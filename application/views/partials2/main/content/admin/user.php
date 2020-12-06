<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-lg-6 main-header">
          <h2>Data<span>User</span></h2>
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
            <a href="<?php echo base_url("admin/user/add_user") ?>" class="btn btn-success "> + New User</a>
          </div>
          <div class="card-body">
            <div class="dt-ext table-responsive">
              <table class="display" id="basic-fixed-header">
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
                                <button data-toggle="tooltip" title="Edit" width="20" type="button" data-feather="edit-3"  data-id="<?php echo $key["usercode"]; ?>">Edit</button>
                              </a>
                              <button data-toggle="tooltip" title="Delete" width="20" type="button" data-id="<?php echo $key["usercode"]; ?>"data-feather="x">Delete</button>
                            </td>
                          </tr>
                  <?php } } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>