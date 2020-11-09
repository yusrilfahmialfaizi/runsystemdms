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
            <a href="<?php echo base_url("tabel/createDocument")?>" class="btn btn-success"> + New Document</a>
            <!-- <button type="button" class="btn btn-success sweet-11" data-toggle="modal" data-target=".bs-example-modal-lg" > + New Document</button> -->
            <!-- <button class="btn btn-danger sweet-11" type="button" onclick="_gaq.push(['_trackEvent', 'example', 'try', 'sweet-11']);">Danger</button> -->
          </div>
          <div class="card-body">
            <div class="dt-ext table-responsive">
              <table class="display" id="responsive">
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
                  <?php foreach ($get as $key) {
                    if ($key != null) {
                      # code...
                      for ($i=0; $i < count($key); $i++) { ?>

                        <tr>
                          <td><?php echo $key[$i]["docno"];?></td>
                          <td><?php echo $key[$i]["activeind"];?></td>
                          <td><?php echo $key[$i]["status"];?></td>
                          <td><?php echo $key[$i]["createby"];?></td>
                          <td><?php echo $key[$i]["createdt"];?></td>
                          <td><?php echo $key[$i]["lastupby"];?></td>
                          <td><?php echo $key[$i]["lastupdt"];?></td>
                          <!-- <td><a onClick="modules('<?php echo $key[$i]["modulcode"];?>')" >Edit</a></td> -->
                          <td><?php echo $key[$i]["modulcode"];?></td>
                        </tr>
                        <?php }}} ?>
                      </tbody>
                      <tfoot>
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
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>