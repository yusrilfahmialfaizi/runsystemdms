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
                    <?php $this->load->view("partials2/main//breadcrumb/breadcrumb") ?>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid general-widget">
            <div class="row">
            <?php  foreach ($get as $data) {
              for ($i=0; $i < count($data); $i++) { ?>
              <div class="col-sm-6 col-xl-3 col-lg-6 box-col-6">
                <div class="card gradient-primary o-hidden">
                  <div class="b-r-4 card-body">
                    <div class="media static-top-widget" onClick="project()">
                      <div class="align-self-center text-center"><i data-feather="database"></i></div>
                      <div class="media-body"><span class="m-0 text-white"><?php echo $data[$i]["pgname"]?></span>
                        <h4 class="mb-0 text-white"><?php echo $data[$i]["pgcode"]?></h4><i class="icon-bg" data-feather="database"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php } }?>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <script type="text/javascript">
          function project(){
            window.location = "<?php echo base_url("tabel") ?>";
          }
        </script>