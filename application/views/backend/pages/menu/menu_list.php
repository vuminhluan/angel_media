<div class="row">
	<div class="col-xl-12">
		<div class="widget has-shadow">
			<div class="widget-header bordered no-actions d-flex align-items-center">
				<h4><?= $title ?></h4>
			</div>
			<div class="widget-body">
				<div class="table-responsive">
					<table id="menu_list" class="table mb-0">
						<thead>
							<tr>
								<!-- <th>#</th> -->
								<th>Menu</th>
								<th>Đường dẫn</th>
								<th>Menu cha</th>
								<th>Vị trí</th>
								<th>Trạng thái</th>
								<th class="text-right">Chức năng</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1 ?>
							<?php foreach ($recursive_menu as $menu): ?>
								<?php $status = $menu['status'] ? "<span class='badge badge-success'>Hiện</span>" : "<span class='badge badge-dark'>Ẩn</span>"; ?>
								<tr class="parent-menu" data-lv="1">
									<!-- <td><?= $i++ ?></td> -->
									<td class="menu-name"> <span class="badge badge1">1</span> <?= $menu['name'] ?></td>
									<td><?= $menu['link'] ?></td>
									<td>---</td>
									<td><?= $menu['orders'] ?></td>
									<td><?= $status ?></td>
									<td>
										<div class="action-buttons td-actions text-right">
											<a href="<?= base_url('admin/menu/'.$menu["id"].'/edit') ?>" class="edit-action">
												<i class="la la-edit edit"></i>
											</a>
											<a data-menu-name="<?= $menu['name'] ?>" data-href="<?= base_url('admin/menu/'.$menu["id"].'/delete') ?>" href="#/" class="delete-action">
												<i class="la la-close delete"></i>
											</a>
										</div>
									</td>
								</tr>
								<!-- helpers/myhelper_helper.php  -->
								<?php render_menu_table($menu) ?>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- End Sorting -->
	</div>
</div>
