
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
                    <th>Active</th>
                    <th>Status</th>
                    <th>Create By</th>
                    <th>Create Date</th>
                    <th>Last Update By</th>
                    <th>Last Update Date</th>
                    <th style="width:10%">Action </th>
                  </tr>
                </thead>
                <tbody>
                  <!-- js -->
                  <?php if ($get != null) { ?>
                    <?php foreach ($get as $key) {
                      if ($key != null) {
                        # code...
                        for ($i = 0; $i < count($key); $i++) {
                          $createdt = strtotime($key[$i]["createdt"]);
                          $lastupdt = strtotime($key[$i]["lastupdt"]);
                    ?>

                          <tr>
                            <td><?php echo $key[$i]["docno"]; ?></td>
                            <td>
                              <?php if ($key[$i]["activeind"] == "Y") {
                                echo "Yes";
                              } else {
                                echo "No";
                              } ?>
                            </td>
                            <td>
                              <?php if ($key[$i]["status"] == "F") {
                                echo "Final";
                              } else if ($key[$i]["status"] == "O") {
                                echo "Outstanding";
                              } else {
                                echo "Cancel";
                              } ?>
                            </td>
                            <td><?php echo $key[$i]["createby"]; ?></td>
                            <td><?php echo date("d-m-Y H:i", $createdt); ?></td>
                            <td><?php echo $key[$i]["lastupby"]; ?>
                            </td>
                            <?php if ($key[$i]["lastupby"] != null){ ?>
                            <td><?php echo date("d-m-Y H:i", $lastupdt); ?></td>
                            <?php }else{ ?>
                            <td></td>
                            <?php } ?>
                            <td>
                              <button data-toggle="tooltip" title="Edit" width="20" type="button" data-feather="edit" data-docno="<?php echo $key[$i]["docno"]; ?>" data-modulcode="<?php echo $key[$i]["modulcode"]; ?>" data-status="<?php echo $key[$i]["status"]; ?>" data-active="<?php echo $key[$i]["activeind"]; ?>" onClick="modules2(this)" data-id="<?php echo $key[$i]["modulname"]; ?>">Edit</button>
                              <button data-toggle="tooltip" title="Preview" width="20" type="button" data-docno="<?php echo $key[$i]["docno"]; ?>" data-modulcode="<?php echo $key[$i]["modulcode"]; ?>" onClick="preview(this)" data-feather="book-open">Preview</button>
                              <span data-toggle="modal" data-target="#modal-<?php echo str_replace('/', '-',$key[$i]["docno"]); ?>">
                              <button  type="button" data-feather="list" title="Log" data-toggle="tooltip" >
                              Log </button>
                              </span>
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
  <!-- Contoh Modal -->
<?php foreach ($log as $lg) { 
    $logs = $lg['docno'];
  ?>

<div class="modal fade" id="modal-<?php echo str_replace('/', '-', $lg["docno"]); ?>" tabindex="-1" role="dialog" aria-labelledby="modalSayaLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalSayaLabel">Detail Log <?php echo $logs ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-block row">
          <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="dt-ext table-responsive">
              <table class="display" id="basic-fixed-header">
                <thead class="table-primary">
                  <tr>
                    <th scope="col">Log Code</th>
                    <th scope="col">Docno</th>
                    <th scope="col">Last Update By</th>
                    <th scope="col">Last Update Date</th>
                  </tr>
                </thead>
                <tbody>
                    <!-- js -->
                  <?php foreach ($log as $key) {
                    if ($logs == $key['docno']) {
                      # code...
                      $lastupdt = strtotime($key["lastupdt"]);
                  ?>

                  <tr>
                    <td><?php echo $key["logcode"]; ?></td>
                    <td><?php echo $key["docno"]; ?></td>
                    <td><?php echo $key["lastupby"]; ?></td>
                    <td><?php echo date("d-m-Y H:i", $lastupdt); ?></td>
                    <?php } ?>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<?php } ?>
