<div class="row">
	<div class="col-xl-12">
		<!-- Sorting -->
		<div class="widget has-shadow">
			<div class="widget-header bordered no-actions d-flex align-items-center">
				<h4><?= $product['name'] ?></h4>
			</div>
			<!-- <div class="widget-body">
				<div class="">

				</div>
			</div> -->
		</div>
		<!-- End Sorting -->
	</div>

	<!-- Begin version list -->
	<div class="col-xl-4 col-md-5">
		<div class="widget widget-12 has-shadow">
			<div class="widget-body">
				<h3>Phiên bản (<?= count($versions) ?>)</h3>
				<!-- <hr> -->
				<div class="">
					<ul class="version-list">
						<?php foreach ($versions as $key => $version): ?>
							<li class="version<?=$version['id']?>"><a href="<?= base_url("admin/product/".$product["id"]."/versions/".$key) ?>"><?= $version['size']." - ". $version['color'] ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- End version list -->

	<!-- Begin version detail -->
	<div class="col-xl-8 col-md-7">
		<?php echo form_open(base_url('admin/product/version/update'), ['class'=>'update-product-version-form']); ?>
		<div class="widget widget-12 has-shadow">
			<div class="widget-body">
				<h4>Thuộc tính</h4>
				<br>

				<input type="hidden" name="version_id" value="<?= $versions[$index]["id"] ?>">
				<input type="hidden" name="product_id" value="<?= $product["id"] ?>">
				<input type="hidden" name="version_index" value="<?= $index ?>">
				<!-- ======================== -->
				<div class="form-group row d-flex align-items-center mb-5">
					<label class="col-md-12 form-control-label">Kích thước</label>
					<div class="col-md-12">
						<input type="text" class="form-control unicode product_category_name" name="size" value="<?= $versions[$index]["size"] ?>" autocomplete="off">
					</div>
				</div>
				<!-- ======================== -->
				<div class="form-group row d-flex align-items-center mb-5">
					<label class="col-md-12 form-control-label">Màu sắc</label>
					<div class="col-md-12">
						<input type="text" class="form-control unicode product_category_name" name="color" value="<?= $versions[$index]["color"] ?>" autocomplete="off">
					</div>
				</div>
				<!-- ========================  -->
			</div>
		</div>

		<div class="widget widget-12 has-shadow">
			<div class="widget-body">
				<h3>Giá phiên bản</h3>
				<br>
				<!-- ======================== -->
				<div class="form-group row d-flex align-items-center mb-5">
					<label class="col-md-12 form-control-label">Giá ban đầu</label>
					<div class="col-md-12">
						<input type="text" class="form-control unicode product_category_name" name="original_price" value="<?= $versions[$index]["original_price"] ?>" autocomplete="off">
					</div>
				</div>
				<!-- ======================== -->
				<div class="form-group row d-flex align-items-center mb-5">
					<label class="col-md-12 form-control-label">Giá bán hiện tại</label>
					<div class="col-md-12">
						<input type="text" class="form-control unicode product_category_name" name="price" value="<?= $versions[$index]["price"] ?>" autocomplete="off">
					</div>
				</div>
				<!-- ========================  -->
			</div>
		</div>

		<div class="widget widget-12 has-shadow">
			<div class="widget-body text-right">
				<button class="btn ripple btn-dark">Cập nhật phiên bản</button>
				<a href="#/" data-href="<?= base_url('admin/product/'.$product['id'].'/version/'.$versions[$index]["id"].'/delete') ?>" class="btn ripple btn-danger delete-version-button" data-version-name="<?=$versions[$index]["size"]."-".$versions[$index]["color"]?>">Xóa phiên bản</a>
			</div>
		</div>
		<?php form_close(); ?>
	</div>
	<!-- End version list -->
</div>
