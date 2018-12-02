<div class="row flex-row">
	<div class="col-12">
		<!-- Form -->
		<div class="widget has-shadow">
			<div class="widget-header bordered no-actions d-flex align-items-center">
				<h4><?= $title ?></h4>
			</div>
			<div class="widget-body">
				<?php echo form_open(base_url('admin/slideshow/create'), ['class'=>'form-horizontal create-slideshow-form']); ?>

					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-2 form-control-label d-flex justify-content-md-end">Tên slide</label>
						<div class="col-md-10">
							<input type="text" class="form-control name" name="name" value="<?= set_value('slide_name') ?>" autocomplete="off">
							<small>
								<code>Bắt buộc. Tối thiểu 5 ký tự</code>
							</small>
						</div>
					</div>
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-lg-2 form-control-label d-flex justify-content-md-end">Hình ảnh</label>
						<div class="col-lg-10">
							<div class="form-group">
								<div>
									<img class="slideimage" src="<?= set_value('slide_image') ?>" alt="" style="display: block; max-width: 100%">
								</div>
								<br>
								<div class="input-group">
									<span class="input-group-btn">
										<a href="/filemanager/dialog.php?type=1&field_id=slideimage&relative_url=1" class="btn btn-primary ripple stand-alone-filemanager">
											<i class="la la-image"></i>
										</a>
									</span>
									<input type="text" class="form-control" name="image" id="slideimage" value="<?= set_value('slide_image') ?>" required>
								</div>
							</div>
						</div>
					</div>

					<!-- ======================= -->

					<div class="em-separator separator-dashed"></div>
					<div class="col-md-10 offset-md-2 text-right">
						<button class="btn btn-gradient-02" type="submit">Thêm slide</button>
					</div>
					<!-- ======================= -->
				<?php echo form_close(); ?>
			</div>
		</div>
		<!-- End Form -->
	</div>
</div>
<!-- End Row -->
