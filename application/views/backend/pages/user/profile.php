<div class="row flex-row">
	<div class="col-xl-3">
		<!-- Begin Widget -->
		<div class="widget has-shadow">
			<div class="widget-body">
				<div class="mt-5">
					<?php $noimage = base_url('public/backend/assets/img/others/noimage.jpg') ?>
					<img src="<?= $user->avatar ?>" alt="avatar" style="width: 120px;" class="avatar d-block mx-auto">
					<div class="avatar-action">
						<?php echo form_open_multipart(base_url('admin/profile/update/avatar'), ['class'=>'update-avatar-form']); ?>
							<input type="hidden" name="avatar" id="avatar" value="">
							<a href="/filemanager/dialog.php?type=1&field_id=avatar&relative_url=1" class="btn btn-secondary btn-square change-avatar-btn"><i class="la la-upload"></i></a>
							<button type="submit" class="btn btn-danger btn-square"><i class="la la-save"></i></button>
						<?php echo form_close(); ?>
					</div>
				</div>
				<h3 class="text-center mt-3 mb-1"><?= $user->lastname.' '.$user->firstname ?></h3>
				<p class="text-center"><?= ellipsize($user->email, 20, 1) ?></p>
				<div class="em-separator separator-dashed"></div>
				<ul class="nav flex-column">
					<li class="nav-item">
						<a class="nav-link" href="javascript:void(0)"><i class="la la-bell la-2x align-middle pr-2"></i>Notifications</a>
					</li>
					<!-- <li class="nav-item">
						<a class="nav-link" href="javascript:void(0)"><i class="la la-bolt la-2x align-middle pr-2"></i>Activity</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="javascript:void(0)"><i class="la la-comments la-2x align-middle pr-2"></i>Messages</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="javascript:void(0)"><i class="la la-bar-chart la-2x align-middle pr-2"></i>Statistics</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="javascript:void(0)"><i class="la la-clipboard la-2x align-middle pr-2"></i>Tasks</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="javascript:void(0)"><i class="la la-gears la-2x align-middle pr-2"></i>Settings</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="javascript:void(0)"><i class="la la-question-circle la-2x align-middle pr-2"></i>FAQ</a>
					</li> -->
				</ul>
			</div>
		</div>
		<!-- End Widget -->
	</div>
	<div class="col-xl-9">
		<div class="widget has-shadow">
			<div class="widget-header bordered no-actions d-flex align-items-center">
				<h4>Cập nhật hồ sơ</h4>
			</div>
			<div class="widget-body">

				<!-- THÔNG TIN CÁ NHÂN -->
				<div class="col-10 ml-auto">
					<div class="section-title mt-3 mb-3">
						<h4>01. Thông Tin Cá Nhân</h4>
					</div>
				</div>
				<?php echo form_open(base_url('admin/profile/update/info'), ['class'=>'form-horizontal', 'personal-infomation-form']); ?>
					<input type="hidden" name="user_id" value="<?= $this->session->userdata('id') ?>">
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Họ và tên lót</label>
						<div class="col-lg-6">
							<input type="text" class="form-control" name="lastname" placeholder="Vũ Minh" value="<?= $user->lastname ?>">
						</div>
					</div>
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Tên</label>
						<div class="col-lg-6">
							<input type="text" class="form-control" name="firstname" placeholder="Luân" value="<?= $user->firstname ?>">
						</div>
					</div>
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Email</label>
						<div class="col-lg-6">
							<input type="text" class="form-control" name="email" placeholder="email@gmail.com" value="<?= $user->email ?>">
						</div>
					</div>
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Điện thoại</label>
						<div class="col-lg-6">
							<input type="text" class="form-control" name="phone" placeholder="099 188 6789" value="<?= $user->mobile_no ?>">
						</div>
					</div>
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-lg-2 form-control-label d-flex justify-content-lg-end"></label>
						<div class="col-lg-6 text-right">
							<button class="btn btn-gradient-01" type="submit">Lưu thay đổi</button>
						</div>
					</div>
				<?php echo form_close(); ?>

				<div class="em-separator separator-dashed"></div>

				<!-- ĐỔI MẬT KHẨU -->
				<div class="col-10 ml-auto">
					<div class="section-title mt-3 mb-3">
						<h4>03. Đổi mật khẩu</h4>
					</div>
				</div>
				<?php echo form_open(base_url('admin/profile/update/password'), ['class'=>'form-horizontal', 'personal-infomation-form']); ?>

					<input type="hidden" name="user_id" value="<?= $this->session->userdata('id') ?>">
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Mật khẩu hiện tại</label>
						<div class="col-lg-6">
							<input type="password" class="form-control" name="current_password" placeholder="Mật khẩu hiện tại">
						</div>
					</div>
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Mật khẩu mới</label>
						<div class="col-lg-6">
							<input type="password" class="form-control" name="password" placeholder="Mật khẩu mới">
						</div>
					</div>
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-lg-2 form-control-label d-flex justify-content-lg-end">Nhập lại mật khẩu mới</label>
						<div class="col-lg-6">
							<input type="password" class="form-control" name="password_confirmation" placeholder="Nhập lại mật khẩu mới">
						</div>
					</div>
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-lg-2 form-control-label d-flex justify-content-lg-end"></label>
						<div class="col-lg-6 text-right">
							<button class="btn btn-gradient-01" type="submit">Lưu thay đổi</button>
						</div>
					</div>
				<?php echo form_close(); ?>

				<div class="em-separator separator-dashed"></div>
			</div>
		</div>
	</div>
</div>
<!-- End Row -->