<div class="row flex-row">
	<div class="col-12">
		<!-- Form -->
		<div class="widget has-shadow">
			<div class="widget-header bordered no-actions d-flex align-items-center">
				<h4><?= $title ?></h4>
			</div>
			<div class="widget-body">
				<?php echo form_open(base_url('admin/menu/create'), ['class'=>'form-horizontal create-menu-form']); ?>

					<!-- ===================== -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Menu cha</label>
						<div class="col-md-6">
							<select required class="custom-select form-control select-menu-parent" name="select_menu_parent">
								<option value="0">Không</option>
								<!-- myhelper_helper.php  -->
								<?php render_selection_menu($recursive_menu); ?>
							</select>
						</div>
					</div>

					<!-- ===================== -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Tên Menu</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="name" value="<?= set_value('menu_name') ?>" autocomplete="off" required>
							<small>
								<code>Bắt buộc</code>
							</small>
						</div>
					</div>

					<!-- ===================== -->
					<!-- <div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Đường dẫn</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="link" value="">
							<small>
								<code>Bắt buộc</code>
							</small>
						</div>
					</div> -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Đường dẫn</label>
						<div class="col-lg-6">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-btn">
										<a href="#/" class="btn btn-primary ripple upload-news-image-btn">
											<i class="la la-link"></i>
										</a>
									</span>
									<input type="text" class="form-control" autocomplete="off" name="link" value="">
									<!-- <small>
										<code>Bắt buộc</code>
									</small> -->
								</div>
							</div>
						</div>
					</div>
					<!-- ===================== -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Vị trí</label>
						<div class="col-md-6">
							<select required class="custom-select form-control" name="select_orders">
								<option value="0">Không</option>
							</select>
						</div>
					</div>
					<!-- ===================== -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Trạng thái</label>
						<div class="col-md-6">
							<div class="custom-control custom-radio styled-radio d-inline-block">
								<input class="custom-control-input" type="radio" name="status" id="opt-01" checked value="1">
								<label class="custom-control-descfeedback" for="opt-01">Hiện</label>
							</div>
							&nbsp;
							&nbsp;
							<div class="custom-control custom-radio styled-radio d-inline-block">
								<input class="custom-control-input" type="radio" name="status" id="opt-02" value="0">
								<label class="custom-control-descfeedback" for="opt-02">Ẩn</label>
							</div>
						</div>
					</div>

					<!-- ===================== -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Mở</label>
						<div class="col-md-6">
							<div class="custom-control custom-radio styled-radio d-inline-block">
								<input class="custom-control-input" type="radio" name="target" id="target1" checked value="0">
								<label class="custom-control-descfeedback" for="target1">Trên tab hiện tại</label>
							</div>
							&nbsp;
							&nbsp;
							<div class="custom-control custom-radio styled-radio d-inline-block">
								<input class="custom-control-input" type="radio" name="target" id="target2" value="1">
								<label class="custom-control-descfeedback" for="target2">Tab mới</label>
							</div>
						</div>
					</div>
					<!-- ===================== -->

					<div class="em-separator separator-dashed"></div>
					<div class="col-md-6 offset-md-3 text-right">
						<button class="btn btn-gradient-02" type="submit">Thêm mới</button>
					</div>
					<!-- ===================== -->
				<?php echo form_close(); ?>
			</div>
		</div>
		<!-- End Form -->
	</div>
</div>
<!-- End Row -->
