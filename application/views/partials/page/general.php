<?php $this->load->view('partials/parts/header'); ?>
    <div class="main-grid">
        <div class="social grid">
            <div class="grid-info">
                <h1> Berikut Merupakan Teks Editor :)</h1><br>
                <textarea class="form-control" name="deskripsi"></textarea>
                <button type="button" class="btn btn-lg btn-primary btn-block">Simpan</button>
                <button type="button" class="btn btn-lg btn-primary btn-block">Batal</button>
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
