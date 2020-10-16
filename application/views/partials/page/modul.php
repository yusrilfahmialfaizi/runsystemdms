<?php $this->load->view('partials/parts/header'); ?>
    <div class="main-grid">
        <div class="social grid">
            <div class="grid-info">
            	<textarea class="form-control" name="deskripsi"></textarea>
               <div class="clearfix"> 
                </div>
            </div>
        </div>

        <script type="text/javascript">
        	window.onload = function(){
        	CKEDITOR.replace('deskripsi');
  		}
        </script>


<?php $this->load->view('partials/parts/footer'); ?>
