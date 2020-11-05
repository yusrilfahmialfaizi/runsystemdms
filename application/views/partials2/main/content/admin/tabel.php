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
            <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg"> + New Document</button>
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
                <tbody id="datacos">
                  <!-- js -->
                  <?php foreach ($post as $key) {
		 	                for ($i=0; $i < count($key); $i++) { ?>
                    <tr>
		                  <td><?php echo $key[$i]["docno"];?></td>
		                  <td><?php echo $key[$i]["activeind"];?></td>
		                  <td><?php echo $key[$i]["status"];?></td>
		                  <td><?php echo $key[$i]["createby"];?></td>
		                  <td><?php echo $key[$i]["createdt"];?></td>
		                  <td><?php echo $key[$i]["lastupby"];?></td>
		                  <td><?php echo $key[$i]["lastupdt"];?></td>
		                  <td>Action</td>
                    </tr>
	                <?php }} ?>
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