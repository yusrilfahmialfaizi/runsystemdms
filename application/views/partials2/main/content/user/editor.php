<script type="text/javascript" src="<?= base_url()?>assets/ckeditor/ckeditor.js"> </script>
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
	<?= $this->session->flashdata('alert') ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						<a style="float: left;" href="<?= base_url("/tabel?modulcode=") . $this->session->userdata("modul") ?>" class="btn btn-sm btn-outline-primary">Tabel</a>
						<form action="<?php echo base_url("editor/editdocdetail") ?>" method="POST">
							<?php foreach ($doc as $value) { ?>
								<?php if ($this->session->userdata("active") == 'Y') { ?>
									<div class="col-md-4 offset-md-10">
										<label class="d-block" for="chk-ani">
											<?php if ($value[0]['status'] == "O" || $value[0]['status'] == null) { ?>
												<label><b><p>
												<input class="checkbox_animated" id="chk-ani" name="chk-ani" type="checkbox">Review</p></b></label>
											<?php } else { ?>
												<label><b><p>
												<input class="checkbox_animated" id="chk-ani" name="chk-ani" type="checkbox" checked="checked">Review</b></label>
											<?php } ?>
										</label>
									</div>
									<h4 style="margin-top: 4%;"> Deskripsi</h4><br>
									<textarea class="form-control" rows="10" cols="50" id="deskripsi" name="deskripsi"><?php echo $value[0]['description'] ?></textarea>

									<div class="clearfix"><br>
										<div class="col-md-4 offset-md-10">
											<input type="submit" name="simpan" class="btn btn-lg btn-primary" value="Simpan">
										</div>
									</div>
								<?php } else { ?>
									<div class="col-md-4 offset-md-10">
										<label class="d-block" for="chk-ani">
											<?php if ($value[0]['status'] == "O" || $value[0]['status'] == null) { ?>
												<label><b><p>
												<input class="checkbox_animated" id="chk-ani" name="chk-ani" type="checkbox" disabled>Review</b></label>
											<?php } else { ?>
												<label><b><p>
												<input class="checkbox_animated" id="chk-ani" name="chk-ani" type="checkbox" checked="checked" disabled>Review</b></label>
											<?php } ?>
										</label>
									</div>
									<h4 style="margin-top: 4%;"> Deskripsi</h4><br>
									<textarea class="form-control" rows="10" cols="50" id="deskripsi" name="deskripsi" readonly><?php echo $value[0]['description'] ?> </textarea>

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
						<textarea class="form-control" name="deskripsi"><?php $this->session->userdata("menu"); ?></textarea>

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
						<script>
							CKEDITOR.replace('deskripsi', {
							filebrowserBrowseUrl: 'assets/ckeditor/ckfinder/ckfinder.html',
							filebrowserUploadUrl: 'assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
							});
						</script>
						<!-- <script>
							CKEDITOR.replace('deskripsi', {
							extraPlugins: 'uploadimage,image2',
							height: 300,

							// Upload images to a CKFinder connector (note that the response type is set to JSON).
							uploadUrl: 'assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',

							// Configure your file manager integration. This example uses CKFinder 3 for PHP.
							filebrowserBrowseUrl: 'assets/ckeditor/ckfinder/ckfinder.html',
							filebrowserImageBrowseUrl: 'assets/ckeditor/ckfinder/ckfinder.html?type=Images',
							filebrowserUploadUrl: 'assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
							filebrowserImageUploadUrl: 'assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

							// The following options are not necessary and are used here for presentation purposes only.
							// They configure the Styles drop-down list and widgets to use classes.

							stylesSet: [{
								name: 'Narrow image',
								type: 'widget',
								widget: 'image',
								attributes: {
									'class': 'image-narrow'
								}
								},
								{
								name: 'Wide image',
								type: 'widget',
								widget: 'image',
								attributes: {
									'class': 'image-wide'
								}
								}
							],

							// Load the default contents.css file plus customizations for this sample.
							contentsCss: [
								'http://cdn.ckeditor.com/4.15.1/full-all/contents.css',
								'https://ckeditor.com/docs/ckeditor4/4.15.1/examples/assets/css/widgetstyles.css'
							],

							// Configure the Enhanced Image plugin to use classes instead of styles and to disable the
							// resizer (because image size is controlled by widget styles or the image takes maximum
							// 100% of the editor width).
							image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
							image2_disableResizer: true
							});
						</script> -->
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Container-fluid Ends-->