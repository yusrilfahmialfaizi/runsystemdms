<?php $this->load->view('partials2/main/header/header_admin'); ?>
<script type="text/javascript" src="assets/ckeditor/ckeditor.js">  </script>
<div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6 main-header">
                  <h2>Home<span> Editor</span></h2>
                  <h6 class="mb-0">Halaman Editor</h6>
                </div>
                </div>
            </div>
          </div>
         
          <!-- Container-fluid starts-->
<div class="container-fluid">
  <div class="row">
                <h1> Berikut Merupakan Teks Editor :)</h1><br>
                <textarea class="form-control" name="deskripsi"></textarea>
                <button type="button" class="btn btn-lg btn-primary btn-block">Simpan</button>
               <div class="clearfix"> 
  </div>

  <script type="text/javascript">
        	window.onload = function(){
        	CKEDITOR.replace('deskripsi');
  		}
        </script>

  </div>
</div>
</div>
          <!-- Container-fluid Ends-->
<?php $this->load->view('partials2/main/footer'); ?>    
