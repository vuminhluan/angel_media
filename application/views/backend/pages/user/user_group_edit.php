<div class="row flex-row">
	<div class="col-12">
		<!-- Form -->
		<div class="widget has-shadow">
			<div class="widget-header bordered no-actions d-flex align-items-center">
				<h4><?= $title ?></h4>
			</div>
			<div class="widget-body">
				<?php echo form_open(base_url('admin/user-groups/update'), ['class'=>'form-horizontal edit-user-group-form']); ?>
					
					<input type="hidden" name="id" value="<?= $group['id'] ?>">
					<!-- --------------------- -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Tên nhóm</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="group_name_edit" value="<?= $group['group_name'] ?>" required>
							<small>
								<code>Bắt buộc.</code>
							</small>
						</div>
					</div>
					<!-- --------------------- -->
					<div class="em-separator separator-dashed"></div>
					<div class="col-md-6 offset-md-3 text-right">
						<button class="btn btn-gradient-02" type="submit">Cập nhật</button>
					</div>
					<!-- --------------------- -->
				<?php echo form_close(); ?>
			</div>
		</div>
		<!-- End Form -->
	</div>
</div>
<!-- End Row -->