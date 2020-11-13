
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
						<form action="<?php echo base_url("editor/editdocdetail")?>" method="POST">
							<?php foreach ($doc as $value) {?>
								<?php if($this->session->userdata("active") == 'Y'){?> 
									<div class="col-md-4 offset-md-10">
										<label class="d-block" for="chk-ani">
									<?php if($value[0]['status'] == "O" || $value[0]['status'] == null) {?>
											<input class="checkbox_animated" id="chk-ani" name="chk-ani" type="checkbox"  >Review
									<?php }else {?>
											<input class="checkbox_animated" id="chk-ani" name="chk-ani" type="checkbox" checked="checked" >Review
									<?php }?>
										</label>
									</div>
									<h4> Deskripsi</h4><br>
									<textarea class="form-control" rows="10" cols="50" id="deskripsi" name="deskripsi"><?php echo $value[0]['description']?> </textarea>

									<div class="clearfix"><br>
										<div class="col-md-4 offset-md-10">
											<input type="submit" name="simpan" class="btn btn-lg btn-primary" value="Simpan">
										</div>
									</div>
								<?php }else{ ?>	
									<div class="col-md-4 offset-md-10">
										<label class="d-block" for="chk-ani">
									<?php if($value[0]['status'] == "O" || $value[0]['status'] == null) {?>
											<input class="checkbox_animated" id="chk-ani" name="chk-ani" type="checkbox" disabled>Review
									<?php }else {?>
											<input class="checkbox_animated" id="chk-ani" name="chk-ani" type="checkbox" checked="checked" disabled>Review
									<?php }?>
										</label>
									</div>
									<h4> Deskripsi</h4><br>
									<textarea class="form-control" rows="10" cols="50" id="deskripsi" name="deskripsi" readonly><?php echo $value[0]['description']?> </textarea>

									<div class="clearfix"><br>
										<div class="col-md-4 offset-md-10">
											<input type="submit" name="simpan" class="btn btn-lg btn-primary" value="Simpan" disabled>
										</div>
									</div>
								<?php } ?>	
							<?php } ?>
						</form>
						<!-- <div class="col-md-4 offset-md-10">
							<label class="d-block" for="chk-ani">
								<input class="checkbox_animated" id="chk-ani" type="checkbox" >Status
							</label>
						</div></br>
						<textarea class="form-control" name="deskripsi"><?php $this->session->userdata("menu");?></textarea>

						<div class="clearfix"><br>
							<div class="col-md-4 offset-md-10">
								<input type="submit" name="simpan" class="btn btn-lg btn-primary" value="Simpan">
							</div>
						</div> -->
						<script type="text/javascript">
							window.onload = function() {
								CKEDITOR.replace('deskripsi');
							}
						</script>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Container-fluid Ends-->

