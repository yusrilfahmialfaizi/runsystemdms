<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-lg-6 main-header">
          <h2>Data<span>Menu</span></h2>
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
            <a href="<?php echo base_url("admin/menu/add_modul_menu") ?>" class="btn btn-success "> + New Menu</a>
          </div>
          <div class="card-body">
            <div class="dt-ext table-responsive">
              <table class="display" id="basic-fixed-header">
                <thead>
                  <tr>
                    <th>Menu Code</th>
                    <th>Module Code</th>
                    <th>Menu Desc</th>
                    <th>Parent</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- js -->
                  <?php //if ($get != null) { ?>
                    <?php foreach ($dt as $key) {
                      if ($key != null) {
                        // # code...
                        // for ($i = 0; $i < count($key); $i++) {
                        //   $createdt = strtotime($key[$i]["createdt"]);
                        //   $lastupdt = strtotime($key[$i]["lastupdt"]);
                    ?>

                          <tr>
                            <td><?php echo $key['menucode'] ?></td>
                            <td><?php echo $key['modulcode'] ?></td>
                            <td><?php echo $key['menudesc'] ?></td>
                            <td><?php echo $key['parent'] ?></td>
                            <td>
                              <!-- <button data-toggle="tooltip" title="Edit" width="20" type="button" data-feather="edit" data-docno="<?php echo $key[$i]["docno"]; ?>" data-modulcode="<?php echo $key[$i]["modulcode"]; ?>" data-status="<?php echo $key[$i]["status"]; ?>" data-active="<?php echo $key[$i]["activeind"]; ?>" onClick="modules2(this)" data-id="<?php echo $key[$i]["modulname"]; ?>">Edit</button>
                              <button data-toggle="tooltip" title="Preview" width="20" type="button" data-docno="<?php echo $key[$i]["docno"]; ?>" data-modulcode="<?php echo $key[$i]["modulcode"]; ?>" onClick="preview(this)" data-feather="book-open">Preview</button> -->
                            </td>
                          </tr>
                  <?php }
                      //}
                    //}
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>