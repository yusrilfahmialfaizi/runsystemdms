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
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div id="grid" class="row"></div>
  </div>
  <!-- Container-fluid Ends-->
</div>
<script type="text/javascript">
  $(document).ready(function(){
    // menampilkan data project dalam bentuk card di dashboard
    var url = 'http://127.0.0.1:8080/runsystemdms/getPG';
    $.ajax({ 
      type: 'GET', 
      url: url,
      dataType: 'json',
      cache :false,
      success: function (data) {
        data = JSON.parse(JSON.stringify(data));
        data = data.pg;
        var grid = [];
        for (i = 0; i < data.length; i++){
          grid.push('<div class="col-sm-6 col-xl-3 col-lg-6 box-col-6"><div class="card gradient-primary o-hidden"><div class="b-r-4 card-body"><div class="media static-top-widget" onClick="project()"><div class="align-self-center text-center"><i data-feather="database"></i></div><div class="media-body"><span class="m-0 text-white">'+data[i].pgcode+'</span><h4 class="mb-0 counter">'+data[i].pgname+'</h4><i class="icon-bg" data-feather="database"></i></div></div></div></div></div>');
        }
        $("#grid").html(grid);
      }
    });
  });
</script>
<script type="text/javascript">
  function project(){
    window.location = "<?php echo base_url("tabel") ?>";
  }
</script>
<?php $this->load->view('partials2/main/footer'); ?>