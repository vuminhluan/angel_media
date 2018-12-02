<div class="row flex-row">
	<div class="col-12">
		<!-- Form -->
		<div class="widget has-shadow">
			<div class="widget-header bordered no-actions d-flex align-items-center">
				<h4><?= $title ?></h4>
			</div>
			<div class="widget-body">
				<?php echo form_open(base_url('admin/landing/update'), ['class'=>'form-horizontal create-landing-form']); ?>

					<input type="hidden" name="id" value="<?= $landing['id'] ?>">
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-2 form-control-label d-flex justify-content-md-end">Tên trang nội dung</label>
						<div class="col-md-10">
							<input type="text" class="form-control unicode name" name="name" value="<?= $landing['name'] ?>" autocomplete="off">
							<small>
								<code>Bắt buộc. Tối thiểu 5 ký tự</code>
							</small>
						</div>
					</div>
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-2 form-control-label d-flex justify-content-md-end">Đường dấn</label>
						<div class="col-md-10">
							<input type="text" class="form-control alias landing-alias" data-alias-prefix="/" name="alias" disabled value="/<?= $landing['alias'] ?>">
							<small>
								<!-- <code>Bắt buộc</code> -->
							</small>
						</div>
					</div>
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-2 form-control-label d-flex justify-content-md-end">Mô tả</label>
						<div class="col-md-10">
							<textarea type="text" class="form-control" name="caption" autocomplete="off"><?= $landing['caption'] ?></textarea>
							<small>
								<code>Nên có</code>
							</small>
						</div>
					</div>
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-lg-2 form-control-label d-flex justify-content-md-end">Hình đại diện</label>
						<div class="col-lg-10">
							<div class="form-group">
								<div>
									<img class="landingimage" src="<?= base_url($landing['thumbnail']) ?>" alt="" style="display: block; max-width: 300px">
								</div>
								<br>
								<div class="input-group">
									<span class="input-group-btn">
										<a href="/filemanager/dialog.php?type=1&field_id=landingimage&relative_url=1" class="btn btn-primary ripple stand-alone-filemanager">
											<i class="la la-image"></i>
										</a>
									</span>
									<input type="text" class="form-control" name="thumbnail" id="landingimage" value="<?= $landing['thumbnail'] ?>" required>
								</div>
							</div>
						</div>
					</div>
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-2 form-control-label d-flex justify-content-md-end">Nội dung</label>
						<div class="col-md-10">
							<textarea type="text" class="form-control tinymce_content" name="content" autocomplete="off"><?= $landing['content'] ?></textarea>
							<small>
								<code>Bắt buộc</code>
							</small>
						</div>
					</div>

					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-2 form-control-label d-flex justify-content-md-end">Trạng thái</label>
						<div class="col-md-10">
							<div class="custom-control custom-radio styled-radio d-inline-block">
								<input class="custom-control-input" type="radio" name="status" id="opt-02" <?= $landing['status'] ? 'checked' : '' ?> value="1">
								<label class="custom-control-descfeedback" for="opt-02">Hiện</label>
							</div>
							&nbsp;
							&nbsp;
							<div class="custom-control custom-radio styled-radio d-inline-block">
								<input class="custom-control-input" type="radio" name="status" id="opt-01" <?= !$landing['status'] ? 'checked' : '' ?> value="0">
								<label class="custom-control-descfeedback" for="opt-01">Ẩn</label>
							</div>
						</div>
					</div>

					<!-- ======================= -->
					<div class="em-separator separator-dashed"></div>
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-2 form-control-label d-flex justify-content-md-end">Tiêu đề</label>
						<div class="col-md-10">
							<input type="text" class="form-control" name="title" value="<?= $landing['title'] ?>">
							<small>
								<code></code>
							</small>
						</div>
					</div>
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-2 form-control-label d-flex justify-content-md-end">Từ khóa</label>
						<div class="col-md-10">
							<input type="text" class="form-control" name="keyword" value="<?= $landing['keyword'] ?>">
							<small>
								<!-- <code>Bắt buộc.</code> -->
							</small>
						</div>
					</div>
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-2 form-control-label d-flex justify-content-md-end">Mô tả</label>
						<div class="col-md-10">
							<input type="text" class="form-control" name="description" value="<?= $landing['description'] ?>">
							<small>
								<!-- <code>Bắt buộc.</code> -->
							</small>
						</div>
					</div>
					<!-- ======================= -->

					<div class="em-separator separator-dashed"></div>
					<div class="col-md-10 offset-md-2 text-right">
						<button class="btn btn-gradient-02" type="submit">Cập nhật trang nội dung</button>
					</div>
					<!-- ======================= -->
				<?php echo form_close(); ?>
			</div>
		</div>
		<!-- End Form -->
	</div>
</div>
<!-- End Row -->
