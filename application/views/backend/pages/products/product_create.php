<div class="row flex-row">
	<div class="col-12">
		<!-- Form -->
		<div class="widget has-shadow">
			<div class="widget-header bordered no-actions d-flex align-items-center">
				<h4><?= $title ?></h4>
			</div>
			<div class="widget-body">
				<?php echo form_open(base_url('admin/product/create'), ['class'=>'form-horizontal create-product-form']); ?>
				<!-- ======================= -->
				<div class="form-group row d-flex align-items-center mb-5">
					<label class="col-md-2 form-control-label d-flex justify-content-md-end">Danh mục</label>
					<div class="col-md-6">
						<select required class="custom-select form-control" name="select_product_category">
							<?php foreach ($categories as $category): ?>
								<option value="<?= $category['id'] ?>" ><?= $category['name'] ?></option>
							<?php endforeach; ?>
						</select>
							<!-- <small>
								<code>Bắt buộc.</code>
							</small> -->
						</div>
					</div>
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-2 form-control-label d-flex justify-content-md-end">Tên sản phẩm</label>
						<div class="col-md-10">
							<input required type="text" class="form-control unicode name" name="name" value="<?= set_value('product_name') ?>" autocomplete="off">
							<small>
								<code>Bắt buộc. Tối thiểu 10 ký tự</code>
							</small>
						</div>
					</div>
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-2 form-control-label d-flex justify-content-md-end">Đường dấn</label>
						<div class="col-md-10">
							<input type="text" class="form-control alias product_category_alias" data-alias-prefix="san-pham/" name="alias" disabled value="sản-pham/<?= set_value('product_alias') ?>">
							<small>
								<!-- <code>Bắt buộc</code> -->
							</small>
						</div>
					</div>
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-2 form-control-label d-flex justify-content-md-end">Mô tả ngắn</label>
						<div class="col-md-10">
							<textarea type="text" class="form-control" name="caption" value="" autocomplete="off"><?= set_value('product_caption') ?></textarea>
							<small>
								<code>Nên có</code>
							</small>
						</div>
					</div>
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-lg-2 form-control-label d-flex justify-content-md-end">Ảnh</label>
						<div class="col-lg-10">
							<div class="form-group">
								<div>
									<img class="productimage" src="<?= set_value('product_thumbnail') ?>" alt="" style="display: block; max-width: 300px">
								</div>
								<br>
								<div class="input-group">
									<span class="input-group-btn">
										<a href="/filemanager/dialog.php?type=1&field_id=productimage&relative_url=1" class="btn btn-primary ripple upload-product-image-btn stand-alone-filemanager">
											<i class="la la-image"></i>
										</a>
									</span>
									<input type="text" class="form-control" name="thumbnail" id="productimage" value="<?= set_value('product_thumbnail') ?>" required>
								</div>
							</div>
						</div>
					</div>
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-2 form-control-label d-flex justify-content-md-end">Nội dung</label>
						<div class="col-md-10">
							<textarea type="text" class="form-control tinymce_content" name="content" value="" autocomplete="off"><?= set_value('product_content') ?></textarea>
							<small>
								<code>Nên có</code>
							</small>
						</div>
					</div>

					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-2 form-control-label d-flex justify-content-md-end">Trạng thái</label>
						<div class="col-md-10">
							<div class="custom-control custom-radio styled-radio d-inline-block">
								<input class="custom-control-input" type="radio" name="status" id="opt-02" checked value="1">
								<label class="custom-control-descfeedback" for="opt-02">Hiện</label>
							</div>
							&nbsp;
							&nbsp;
							<div class="custom-control custom-radio styled-radio d-inline-block">
								<input class="custom-control-input" type="radio" name="status" id="opt-01" value="0">
								<label class="custom-control-descfeedback" for="opt-01">Ẩn</label>
							</div>
						</div>
					</div>
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-2 form-control-label d-flex justify-content-md-end text-danger">Giá ban đầu</label>
						<div class="col-md-5">
							<input type="text" class="form-control" name="original_price" value="<?= set_value('original_price') ?>" autocomplete="off">
							<!-- <small>
								<code>Bắt buộc</code>
							</small> -->
						</div>
					</div>
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-2 form-control-label d-flex justify-content-md-end text-success">Giá bán hiện tại</label>
						<div class="col-md-5">
							<input required type="text" class="form-control" name="price" value="<?= set_value('price') ?>" autocomplete="off">
							<small>
								<code>Bắt buộc</code>
							</small>
						</div>
					</div>
					<!-- ======================= -->
					<div class="em-separator separator-dashed"></div>
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-2 form-control-label d-flex justify-content-md-end"></label>
						<div class="col-md-10">
							<!-- <textarea type="text" class="form-control" name="caption" value="<?= set_value('caption') ?>" autocomplete="off"></textarea> -->
							<p>
								<a href="#/" data-toggle="modal" data-target="#options_modal">Thêm thuộc tính cho sản phẩm (kích thước, màu sắc)</a>
							</p>
							<div class="versions-table">
								<!-- Sau khi chọn kích thước mà màu sắc, một table sẽ hiển thị ở đây...  -->
							</div>
						</div>
					</div>

					<!-- ======================= -->
					<div class="em-separator separator-dashed"></div>
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-2 form-control-label d-flex justify-content-md-end">Tiêu đề</label>
						<div class="col-md-10">
							<input type="text" class="form-control" name="title" value="<?= set_value('title') ?>">
							<small>
								<code></code>
							</small>
						</div>
					</div>
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-2 form-control-label d-flex justify-content-md-end">Từ khóa</label>
						<div class="col-md-10">
							<input type="text" class="form-control" name="keyword" value="<?= set_value('keyword') ?>">
							<small>
								<!-- <code>Bắt buộc.</code> -->
							</small>
						</div>
					</div>
					<!-- ======================= -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-2 form-control-label d-flex justify-content-md-end">Mô tả</label>
						<div class="col-md-10">
							<input type="text" class="form-control" name="description" value="<?= set_value('description') ?>">
							<small>
								<!-- <code>Bắt buộc.</code> -->
							</small>
						</div>
					</div>
					<!-- ======================= -->

					<div class="em-separator separator-dashed"></div>
					<div class="col-md-10 offset-md-2 text-right">
						<button class="btn btn-gradient-02" type="submit">Thêm mới</button>
					</div>
					<!-- ======================= -->
				<?php echo form_close(); ?>
			</div>
		</div>
		<!-- End Form -->
	</div>
</div>
<!-- End Row -->

<!-- MODAL OPTIONS -->
<div id="options_modal" class="modal fade">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Thuộc tính</h4>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span>
					<span class="sr-only">đóng</span>
				</button>
			</div>
			<div class="modal-body">
				<?php echo form_open('', ['class' => "select-product-options-form"]); ?>
				<!-- =========================== -->
				<div class="form-group row d-flex align-items-center mb-5">
					<label class="col-lg-12 form-control-label">Màu sắc </label>
					<!-- <i data-toggle="modal" data-target="#color_modal" class="la la-plus-circle add-color add-more-option-item"></i> -->
					<div class="col-lg-12">
						<br>
						<div class="input-group">
							<span class="input-group-btn">
								<button type="button" class="btn btn-primary ripple add-more-color add-more-button">
									Thêm
								</button>
							</span>
							<input type="text" class="form-control add-more-color-value add-more-value">
						</div>
						<br>
					</div>
					<div class="col-lg-12 color-box">
						<!-- <div class="mb-3 color1">
							<div class="styled-checkbox">
								<input type="checkbox" name="color[]" id="color1" disabled>
								<label for="color1">Màu 1 <i data-parent="color1" class="la la-times remove-option-item"></i> </label>
							</div>
						</div> -->
					</div>
				</div>
				<!-- ================================ -->
				<div class="form-group row d-flex align-items-center mb-5">
					<label class="col-lg-12 form-control-label">Kích thước</label>
					<div class="col-lg-12">
						<br>
						<div class="input-group">
							<span class="input-group-btn">
								<button type="button" class="btn btn-primary ripple add-more-size add-more-button">
									Thêm
								</button>
							</span>
							<input type="text" class="form-control add-more-size-value add-more-value">
						</div>
						<br>
					</div>
					<div class="col-lg-12 size-box">
						<!-- <div class="mb-3 size1">
							<div class="styled-checkbox">
								<input type="checkbox" name="size[]" id="size1" checked disabled>
								<label for="size1">KT1 <i data-parent="size1" class="la la-times remove-option-item"></i> </label>
							</div>
						</div> -->
					</div>
				</div>
				<!-- ================================ -->


				<?php echo form_close(); ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-shadow" data-dismiss="modal">Đóng</button>
				<button type="button" class="btn btn-primary save-product-options-button">Lưu</button>
			</div>
		</div>
	</div>
</div>
<!-- End  MODAL OPTIONS -->
