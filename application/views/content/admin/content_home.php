<?php $this->load->view('partials2/main/header/header_admin'); ?>
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6 main-header">
                  <h2>Home<span>Dashboard</span></h2>
                  <h6 class="mb-0">Halaman Utama</h6>
                </div>
                <div class="col-lg-6 breadcrumb-right">
                  <ol class="breadcrumb">
                    <?php $this->load->view("partials2/main/breadcrumb") ?>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <?php $this->load->view("partials2/main/container_fluid") ?>
<?php $this->load->view('partials2/main/footer'); ?>