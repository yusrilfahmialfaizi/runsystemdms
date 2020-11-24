<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-lg-6 main-header">
          <h2>Dokumen<span>Terdahulu</span></h2>
          <h6 class="mb-0">Document Manajement System</h6>
        </div>
        <div class="col-lg-6 breadcrumb-right">
          <ol class="breadcrumb">
            <?php $this->load->view("partials2/main/breadcrumb/breadcrumb") ?>
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
            <a href="#" class="btn btn-success btnsweet"> + New Document</a>
          </div>
          <div class="card-body">
            <div class="dt-ext table-responsive">
              <table class="display" id="basic-fixed-header">
                <thead>
                  <tr>
                    <th>Docno</th>
                    <th>Active Ind</th>
                    <th>Status</th>
                    <th>Create By</th>
                    <th>Create Date</th>
                    <th>Last Update By</th>
                    <th>Last Update Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- js -->
                  <?php if ($get != null) { ?>
                    <?php foreach ($get as $key) {
                      if ($key != null) {
                        # code...
                        for ($i = 0; $i < count($key); $i++) { ?>

                          <tr>
                            <td><?php echo $key[$i]["docno"]; ?></td>
                            <td><?php echo $key[$i]["activeind"]; ?></td>
                            <td><?php echo $key[$i]["status"]; ?></td>
                            <td><?php echo $key[$i]["createby"]; ?></td>
                            <td><?php echo $key[$i]["createdt"]; ?></td>
                            <td><?php echo $key[$i]["lastupby"]; ?></td>
                            <td><?php echo $key[$i]["lastupdt"]; ?></td>
                            <td>
                              <button width="20" type="button" data-feather="edit" data-docno="<?php echo $key[$i]["docno"]; ?>" data-modulcode="<?php echo $key[$i]["modulcode"]; ?>" data-status="<?php echo $key[$i]["status"]; ?>" data-active="<?php echo $key[$i]["activeind"]; ?>" onClick="modules2(this)" data-id="<?php echo $key[$i]["modulname"]; ?>">Edit</button>
                              <button width="20" type="button" data-docno="<?php echo $key[$i]["docno"]; ?>" data-modulcode="<?php echo $key[$i]["modulcode"]; ?>" onClick="preview(this)" data-feather="book-open">Preview</button>
                            </td>
                          </tr>
                  <?php }
                      }
                    }
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>