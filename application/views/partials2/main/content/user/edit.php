<script type="text/javascript" src="assets/ckeditor/ckeditor.js"> </script>
<div class="page-body">
	<div class="container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-6 main-header">
					<h2>Tabel<span> Edit</span></h2>
					<h6 class="mb-0">Halaman Edit Deskripsi</h6>
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
	<?= $this->session->flashdata('alert'); ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						<!-- <a style="float: left;" href="<?= base_url() ?>tabel" class="btn btn-sm btn-outline-primary">Tabel</a> -->
						<form action="<?php echo base_url("edit/editdocdetail") ?>" method="POST">
							<?php foreach ($doc as $value) { ?>
								<?php if ($this->session->userdata("active") == 'Y' && $hdr['status'] == 'O') { ?>
									<div class="col-md-4 offset-md-10">
										<label class="d-block" for="chk-ani">
											<?php if ($value[0]['status'] == "O" || $value[0]['status'] == null ) { ?>
												<input class="checkbox_animated" id="chk-ani" name="chk-ani" type="checkbox">Review
											<?php } else { ?>
												<input class="checkbox_animated" id="chk-ani" name="chk-ani" type="checkbox" checked="checked">Review
											<?php } ?>
										</label>
									</div>
									<h4 style="margin-top: 4%;"> Deskripsi</h4><br>
									<textarea class="form-control" rows="10" cols="50" id="deskripsi" name="deskripsi"><?php echo $value[0]['description'] ?> </textarea>

									<div class="clearfix"><br>
										<div class="col-md-4 offset-md-10">
											<input type="submit" name="simpan" class="btn btn-lg btn-primary" value="Simpan">
										</div>
									</div>
								<?php } else { ?>
									<div class="col-md-4 offset-md-10">
										<label class="d-block" for="chk-ani">
											<?php if ($value[0]['status'] == "O" || $value[0]['status'] == null) { ?>
												<input class="checkbox_animated" id="chk-ani" name="chk-ani" type="checkbox" disabled>Review
											<?php } else { ?>
												<input class="checkbox_animated" id="chk-ani" name="chk-ani" type="checkbox" checked="checked" disabled>Review
											<?php } ?>
										</label>
									</div>
									<h4 style="margin-top: 4%;"> Deskripsi</h4><br>
									<textarea class="form-control" rows="10" cols="50" id="deskripsi" name="deskripsi" readonly><?php echo $value[0]['description'] ?></textarea>

									<div class="clearfix"><br>
										<div class="col-md-4 offset-md-10">
											<input type="submit" name="simpan" class="btn btn-lg btn-primary" value="Simpan" disabled>
										</div>
									</div>
								<?php } ?>
							<?php } ?>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Container-fluid Ends-->