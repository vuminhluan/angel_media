<div class="row flex-row">
	<div class="col-12">
		<!-- Form -->
		<div class="widget has-shadow">
			<div class="widget-header bordered no-actions d-flex align-items-center">
				<h4><?= $title ?></h4>
			</div>
			<div class="widget-body">
				<?php echo form_open(base_url('admin/config/logo/update'), ['class'=>'form-horizontal create-news-form']); ?>
				<!-- ======================= -->
				<input type="hidden" name="id" value="<?= $logos['id'] ?>">
				<!-- ======================= -->
				<div class="form-group row d-flex align-items-center mb-5">
					<label class="col-md-3 form-control-label d-flex justify-content-md-end">Logo</label>
					<div class="col-md-7">
						<div class="form-group">
							<div>
								<img class="websitelogo" src="<?= $logos['logo'] ?>" alt="" style="display: block; max-width: 150px">
							</div>
							<br>
							<div class="input-group">
								<span class="input-group-btn">
									<a href="/filemanager/dialog.php?type=1&field_id=websitelogo&relative_url=1" class="btn btn-primary ripple upload-news-image-btn stand-alone-filemanager">
										<i class="la la-image"></i>
									</a>
								</span>
								<input type="text" class="form-control" name="logo" id="websitelogo" value="<?= $logos['logo'] ?>" required>
							</div>
						</div>
					</div>
				</div>
				<!-- ======================= -->
				<div class="form-group row d-flex align-items-center mb-5">
					<label class="col-md-3 form-control-label d-flex justify-content-md-end">Logo footer</label>
					<div class="col-md-7">
						<div class="form-group">
							<div>
								<img class="logo-footer" src="<?= $logos['logo_footer'] ?>" alt="" style="display: block; max-width: 150px">
							</div>
							<br>
							<div class="input-group">
								<span class="input-group-btn">
									<a href="/filemanager/dialog.php?type=1&field_id=logo-footer&relative_url=1" class="btn btn-primary ripple upload-news-image-btn stand-alone-filemanager">
										<i class="la la-image"></i>
									</a>
								</span>
								<input type="text" class="form-control" name="logo_footer" id="logo-footer" value="<?= $logos['logo_footer'] ?>">
							</div>
						</div>
					</div>
				</div>
				<!-- ======================= -->
				<div class="form-group row d-flex align-items-center mb-5">
					<label class="col-md-3 form-control-label d-flex justify-content-md-end">Favicon</label>
					<div class="col-md-7">
						<div class="form-group">
							<div>
								<img class="favicon" src="<?= $logos['favicon'] ?>" alt="" style="display: block; max-width: 150px">
							</div>
							<br>
							<div class="input-group">
								<span class="input-group-btn">
									<a href="/filemanager/dialog.php?type=1&field_id=favicon&relative_url=1" class="btn btn-primary ripple upload-news-image-btn stand-alone-filemanager">
										<i class="la la-image"></i>
									</a>
								</span>
								<input type="text" class="form-control" name="favicon" id="favicon" value="<?= $logos['favicon'] ?>" required>
							</div>
						</div>
					</div>
				</div>
				<!-- ======================= -->


				<div class="em-separator separator-dashed"></div>
				<div class="col-md-7 offset-md-3 text-right">
					<button class="btn btn-gradient-02" type="submit">Cập nhật</button>
				</div>
				<!-- ======================= -->
				<?php echo form_close(); ?>
			</div>
		</div>
		<!-- End Form -->
	</div>
</div>
<!-- End Row -->
