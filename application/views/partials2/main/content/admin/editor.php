
<script type="text/javascript" src="assets/ckeditor/ckeditor.js"> </script>
<div class="page-body">
	<div class="container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-6 main-header">
					<h2>Home<span> Editor</span></h2>
					<h6 class="mb-0">Halaman Editor</h6>
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
						<div class="col-md-4 offset-md-10">
							<label class="d-block" for="chk-ani">
								<input class="checkbox_animated" id="chk-ani" type="checkbox" >Status
							</label>
						</div>
						<a> Berikut Merupakan Teks Editor :)</a></br>
						<textarea class="form-control" name="deskripsi"></textarea>

						<script type="text/javascript">
							window.onload = function() {
								CKEDITOR.replace('deskripsi');
							}
							</script>
						<div class="clearfix"><br>
							<div class="col-md-4 offset-md-10">
								<input type="submit" name="simpan" class="btn btn-lg btn-primary" value="Simpan">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Container-fluid Ends-->

