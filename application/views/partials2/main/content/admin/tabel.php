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
          <div class="card-body">
            <a style="margin-bottom: 20px;" href="<?php echo base_url("tabel/createDocument") ?>" class="btn btn-success"> + New Document</a>
            <div class="table-responsive">
              <table class="display" id="basic-13">
                <thead>
                  <tr>
                    <?php $this->session->userdata("menu"); ?>
                    <th style="padding-right: 210px;">Docno</th>
                    <th style="padding-right: 50px;">Active Ind</th>
                    <th style="padding-right: 50px;">Status</th>
                    <th style="padding-right: 50px;">Create By</th>
                    <th style="padding-right: 75px;">Create Date</th>
                    <th style="padding-right: 50px;">Last Update By</th>
                    <th style="padding-right: 50px;">Last Update Date</th>
                    <th style="padding-right: 75px;">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- js -->
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
                            <div class="form-group">
                              <button type="button" data-feather="edit" data-docno="<?php echo $key[$i]["docno"]; ?>" data-modulcode="<?php echo $key[$i]["modulcode"]; ?>" data-status="<?php echo $key[$i]["status"]; ?>" data-active="<?php echo $key[$i]["activeind"]; ?>" onClick="modules2(this)" data-id="<?php echo $key[$i]["modulname"]; ?>">Edit</button>
                              <button type="button" data-feather="book-open">Preview</button>
                            </div>
                          </td>
                        </tr>
                  <?php }
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