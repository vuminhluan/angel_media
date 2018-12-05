<div class="row flex-row">
	<div class="col-12">
		<!-- Form -->
		<div class="widget has-shadow">
			<div class="widget-header bordered no-actions d-flex align-items-center">
				<h4><?= $title ?></h4>
			</div>
			<div class="widget-body">
				<?php echo form_open(base_url('admin/config/seo/update'), ['class'=>'form-horizontal create-news-form']); ?>

					<input type="hidden" name="id" value="<?= $seo['id'] ?>">
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Title</label>
						<div class="col-md-7">
							<input required type="text" class="form-control" name="seo_title" value="<?= $seo['seo_title'] ?>" autocomplete="off">
						</div>
					</div>
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Keyword</label>
						<div class="col-md-7">
							<input required type="text" class="form-control" name="seo_keyword" value="<?= $seo['seo_keyword'] ?>" autocomplete="off">
						</div>
					</div>
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Description</label>
						<div class="col-md-7">
							<input required type="text" class="form-control" name="seo_description" value="<?= $seo['seo_description'] ?>" autocomplete="off">
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
