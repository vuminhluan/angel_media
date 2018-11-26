<div class="row flex-row">
	<div class="col-12">
		<!-- Form -->
		<div class="widget has-shadow">
			<div class="widget-header bordered no-actions d-flex align-items-center">
				<h4><?= $title ?></h4>
			</div>
			<div class="widget-body">
				<?php echo form_open(base_url('admin/news/category/update'), ['class'=>'form-horizontal edit-news-category-form']); ?>
					
					<input type="hidden" name="id" value="<?= $category['id'] ?>">
					<!-- --------------------- -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Tên danh mục</label>
						<div class="col-md-6">
							<input type="text" class="form-control unicode news_category_name" name="name" value="<?= $category['name'] ?>" autocomplete="off">
							<small>
								<code>Bắt buộc</code>
							</small>
						</div>
					</div>
					<!-- --------------------- -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Đường dấn</label>
						<div class="col-md-6">
							<input type="text" data-alias-prefix="tin-tuc/danh-muc/" class="form-control alias news_category_alias" name="alias" disabled value="tin-tuc/danh-muc/<?= $category['alias'] ?>">
							<small>
								<!-- <code>Bắt buộc</code> -->
							</small>
						</div>
					</div>
					<!-- --------------------- -->
					<!-- <div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Trạng thái</label>
						<div class="col-md-6">
							<div class="custom-control custom-radio styled-radio d-inline-block">
								<input class="custom-control-input" type="radio" name="status" id="opt-01" checked value="1">
								<label class="custom-control-descfeedback" for="opt-01">Hoạt động</label>
							</div>
							&nbsp;
							&nbsp;
							<div class="custom-control custom-radio styled-radio d-inline-block">
								<input class="custom-control-input" type="radio" name="status" id="opt-02" value="0">
								<label class="custom-control-descfeedback" for="opt-02">Khóa</label>
							</div>
						</div>
					</div> -->
					
					<!-- --------------------- -->
					<div class="em-separator separator-dashed"></div>
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Tiêu đề</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="title" value="<?= $category['title'] ?>">
							<small>
								<code></code>
							</small>
						</div>
					</div>
					<!-- --------------------- -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Từ khóa</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="keyword" value="<?= $category['keyword'] ?>">
							<small>
								<!-- <code>Bắt buộc.</code> -->
							</small>
						</div>
					</div>
					<!-- --------------------- -->
					<div class="form-group row d-flex align-items-center mb-5">
						<label class="col-md-3 form-control-label d-flex justify-content-md-end">Mô tả</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="description" value="<?= $category['description'] ?>">
							<small>
								<!-- <code>Bắt buộc.</code> -->
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