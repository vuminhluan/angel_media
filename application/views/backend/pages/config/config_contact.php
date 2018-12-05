<div class="row flex-row">
	<div class="col-12">
		<!-- Form -->
		<div class="widget has-shadow">
			<div class="widget-header bordered no-actions d-flex align-items-center">
				<h4><?= $title ?></h4>
			</div>
			<div class="widget-body">
				<?php echo form_open(base_url('admin/config/contact/update'), ['class'=>'form-horizontal create-news-form']); ?>

					<input type="hidden" name="id" value="<?= $contact['id'] ?>">
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Tên website</label>
						<div class="col-md-7">
							<input required type="text" class="form-control" name="website_name" value="<?= $contact['website_name'] ?>" autocomplete="off">
						</div>
					</div>
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Hotline</label>
						<div class="col-md-7">
							<input required type="text" class="form-control" name="hotline" value="<?= $contact['hotline'] ?>" autocomplete="off">
						</div>
					</div>
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Email</label>
						<div class="col-md-7">
							<input required type="email" class="form-control" name="email" value="<?= $contact['email'] ?>" autocomplete="off">
						</div>
					</div>
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Địa chỉ</label>
						<div class="col-md-7">
							<input required type="text" class="form-control" name="address" value="<?= $contact['address'] ?>" autocomplete="off">
						</div>
					</div>
					<!-- ======================= -->
					<div class="em-separator separator-dashed"></div>
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Facebook</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="facebook" value="<?= $contact['facebook'] ?>" autocomplete="off">
						</div>
					</div>
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Zalo</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="zalo" value="<?= $contact['zalo'] ?>" autocomplete="off">
						</div>
					</div>
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Skype</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="skype" value="<?= $contact['skype'] ?>" autocomplete="off">
						</div>
					</div>
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Youtube</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="youtube" value="<?= $contact['youtube'] ?>" autocomplete="off">
						</div>
					</div>
					<!-- ======================= -->
					<div class="em-separator separator-dashed"></div>
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Bản đồ</label>
						<div class="col-md-7">
							<textarea class="form-control" name="map"><?= $contact['map'] ?></textarea>
						</div>
					</div>
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end"></label>
						<div class="col-md-7">
							<?= $contact['map'] ?>
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
