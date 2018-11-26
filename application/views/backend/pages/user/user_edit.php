<div class="row flex-row">
	<div class="col-12">
		<!-- Form -->
		<div class="widget has-shadow">
			<div class="widget-header bordered no-actions d-flex align-items-center">
				<h4><?= $title ?></h4>
			</div>
			<div class="widget-body">
				<?php echo form_open(base_url('admin/users/update'), ['class'=>'form-horizontal edit-user-form']); ?>

					<input type="hidden" name="user_id" value="<?= $user['id'] ?>">
					<!-- --------------------- -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Họ tên lót</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="lastname" value="<?= $user['lastname'] ?>">
							<small>
								<code></code>
							</small>
						</div>
					</div>
					<!-- --------------------- -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Tên</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="firstname" value="<?= $user['firstname'] ?>">
							<small>
								<code></code>
							</small>
						</div>
					</div>
					<!-- --------------------- -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Email</label>
						<div class="col-md-6">
							<input type="email" class="form-control" required name="email_edit" value="<?= $user['email'] ?>">
							<small>
								<code>Bắt buộc.</code>
							</small>
						</div>
					</div>
					<!-- --------------------- -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Số điện thoại</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="mobile_no" value="<?= $user['mobile_no'] ?>">
							<small>
								<code></code>
							</small>
						</div>
					</div>
					<!-- --------------------- -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Địa chỉ</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="address" value="<?= $user['address'] ?>">
							<small>
								<code></code>
							</small>
						</div>
					</div>
					<!-- --------------------- -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Trạng thái</label>
						<div class="col-md-6">
							<div class="custom-control custom-radio styled-radio d-inline-block">
								<input class="custom-control-input" type="radio" name="status" id="opt-01" value="1" <?= $user['is_active'] ? 'checked' : '' ?>>
								<label class="custom-control-descfeedback" for="opt-01">Hoạt động</label>
							</div>
							&nbsp;
							&nbsp;
							<div class="custom-control custom-radio styled-radio d-inline-block">
								<input class="custom-control-input" type="radio" name="status" id="opt-02" value="0" <?= !$user['is_active'] ? 'checked' : '' ?>>
								<label class="custom-control-descfeedback" for="opt-02">Khóa</label>
							</div>
						</div>
					</div>
					<!-- --------------------- -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Nhóm</label>
						<div class="col-md-6">
							<select required class="custom-select form-control" name="select_user_groups">
								<?php foreach ($groups as $group): ?>
								<option value="<?= $group['id'] ?>" <?= $user['role'] == $group['id'] ? 'selected' : '' ?> ><?= $group['group_name'] ?></option>
								<?php endforeach; ?>
							</select>
							<small>
								<code>Bắt buộc.</code>
							</small>
						</div>
					</div>

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