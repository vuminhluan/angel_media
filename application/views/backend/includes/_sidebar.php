<div class="default-sidebar">
	<!-- Begin Side Navbar -->
	<nav class="side-navbar box-scroll sidebar-scroll">
		<!-- Begin Main Navigation -->
		<ul class="list-unstyled">
			<li data-primary-tab="dashboard"><a href="<?= base_url('admin/dashboard') ?>"><i class="la la-dashboard"></i><span>Bảng điều khiển</span></a></li>
			<!-- <li class="active">
				<a href="#dropdown-db" aria-expanded="true" data-toggle="collapse"><i class="la la-columns"></i><span>Dashboard</span></a>
				<ul id="dropdown-db" class="collapse list-unstyled show pt-0">
					<li><a class="active" href="db-default.html">Default</a></li>
					<li><a href="db-clean.html">Clean</a></li>
					<li><a href="db-compact.html">Compact</a></li>
					<li><a href="db-modern.html">Modern</a></li>
					<li><a href="db-social.html">Social</a></li>
					<li><a href="db-smarthome.html">Smarthome</a></li>
					<li><a href="db-all.html">All</a></li>
				</ul>
			</li> -->
			<li data-primary-tab="profile"><a href="<?= base_url('admin/profile') ?>"><i class="la la-user"></i><span>Hồ sơ cá nhân</span></a></li>
		</ul>
		<span class="heading">Quản lý</span>
		<ul class="list-unstyled">
			<li data-primary-tab="users"><a href="#dropdown-ui" aria-expanded="false" data-toggle="collapse"><i class="la la-users"></i><span>Thành viên</span></a>
				<ul id="dropdown-ui" class="collapse list-unstyled pt-0">
					<li data-secondary-tab="user_list"><a href="<?= base_url('admin/users') ?>">Danh sách thành viên</a></li>
					<li data-secondary-tab="user_create"><a href="<?= base_url('admin/users/new') ?>">Thêm thành viên mới</a></li>
					<li data-secondary-tab="user_group_list"><a href="<?= base_url('admin/user-groups') ?>">Danh sách nhóm</a></li>
					<li data-secondary-tab="user_group_create"><a href="<?= base_url('admin/user-groups/new') ?>">Thêm nhóm mới</a></li>
				</ul>
			</li>
			<li data-primary-tab="news" ><a href="#dropdown-icons" aria-expanded="false" data-toggle="collapse"><i class="la la-newspaper-o"></i><span>Tin tức</span></a>
				<ul id="dropdown-icons" class="collapse list-unstyled pt-0">
					<li data-secondary-tab="news_list"><a href="<?= base_url('admin/news') ?>">Danh sách tin tức</a></li>
					<li><a href="<?= base_url('admin/news/new') ?>">Thêm tin tức mới</a></li>
					<li data-secondary-tab="category_list"><a href="<?= base_url('admin/news/categories') ?>">Danh mục tin tức</a></li>
					<li data-secondary-tab="category_create"><a href="<?= base_url('admin/news/category/new') ?>">Thêm danh mục tin tức</a></li>
				</ul>
			</li>
			<li data-primary-tab="landing"><a href="#dropdown-landing" aria-expanded="false" data-toggle="collapse"><i class="la la-header"></i><span>Trang nội dung</span></a>
				<ul id="dropdown-landing" class="collapse list-unstyled pt-0">
					<li data-secondary-tab="landing_list"><a href="<?= base_url('admin/landing') ?>">Danh sách Trang nội dung</a></li>
					<li data-secondary-tab="landing_create"><a href="<?= base_url('admin/landing/new') ?>">Thêm Trang nội dung mới</a></li>
				</ul>
			</li>
			<li data-primary-tab="order"><a href="#dropdown-order" aria-expanded="false" data-toggle="collapse"><i class="la la-book"></i><span>Đơn hàng</span></a>
				<ul id="dropdown-order" class="collapse list-unstyled pt-0">
					<li data-secondary-tab="order_list"><a href="#/">Danh sách đơn hàng</a></li>
				</ul>
			</li>
			<li data-primary-tab="product"><a href="#dropdown-product" aria-expanded="false" data-toggle="collapse"><i class="la la-archive"></i><span>Sản phẩm</span></a>
				<ul id="dropdown-product" class="collapse list-unstyled pt-0">
					<li data-secondary-tab="product_list"><a href="<?= base_url('admin/products') ?>">Danh sách sản phẩm</a></li>
					<li data-secondary-tab="product_create"><a href="<?= base_url('admin/product/new') ?>">Thêm sản phẩm mới</a></li>
					<li data-secondary-tab="product_cate_list"><a href="<?= base_url('admin/product/categories') ?>">Danh mục sản phẩm</a></li>
					<li data-secondary-tab="product_cate_create"><a href="<?= base_url('admin/product/category/new') ?>">Thêm danh mục sản phẩm</a></li>
				</ul>
			</li>
		</ul>
		<span class="heading">Cài đặt</span>
		<ul class="list-unstyled">
			<li data-primary-tab="menu"><a href="#dropdown-menu" aria-expanded="false" data-toggle="collapse"><i class="la la-bars"></i><span>Menu</span></a>
				<ul id="dropdown-menu" class="collapse list-unstyled pt-0">
					<li data-secondary-tab="menu_list"><a href="<?= base_url('admin/menu') ?>">Danh sách menu</a></li>
					<li data-secondary-tab="menu_create"><a href="<?= base_url('admin/menu/new') ?>">Thêm menu mới</a></li>
				</ul>
			</li>
			<li data-primary-tab="slideshow"><a href="#dropdown-slideshow" aria-expanded="false" data-toggle="collapse"><i class="la la-clone"></i><span>Slideshow</span></a>
				<ul id="dropdown-slideshow" class="collapse list-unstyled pt-0">
					<li data-secondary-tab="slideshow_list"><a href="<?= base_url('admin/slideshow') ?>">Danh sách slideshow</a></li>
					<li data-secondary-tab="slideshow_create"><a href="<?= base_url('admin/slideshow/new') ?>">Thêm slide mới</a></li>
				</ul>
			</li>

			<li data-primary-tab="filemanager"><a href="<?= base_url('filemanager/dialog.php?type=0') ?>"><i class="la la-folder-open-o"></i><span>File managers</span></a></li>

			<!-- Website -->
			<li data-primary-tab="config"><a href="#dropdown-website" aria-expanded="false" data-toggle="collapse"><i class="la la-at"></i><span>Website</span></a>
				<ul id="dropdown-website" class="collapse list-unstyled pt-0">
					<li data-secondary-tab="config_contact"><a href="<?= base_url('admin/config/contact') ?>">Thông tin liên lạc</a></li>
					<li data-secondary-tab="config_logo"><a href="<?= base_url('admin/config/logo') ?>">Logo</a></li>
					<li data-secondary-tab="config_seo"><a href="<?= base_url('admin/config/seo') ?>">SEO</a></li>
				</ul>
			</li>
			<!-- Website -->
		</ul>

		<!-- HƯỚNG DẪN -->
		<span class="heading">Hướng Dẫn Sử Dụng</span>
		<ul class="list-unstyled">
			<li class=""><a href="components-widgets.html"><i class="la la-dashboard"></i><span>Hướng dẫn 1</span></a></li>
			<li><a href="<?= base_url('admin/profile') ?>"><i class="la la-user"></i><span>Hướng dẫn 2</span></a></li>
		</ul>
		<!-- KẾT THÚC HƯỚNG DẪN -->
		<!-- End Main Navigation -->
	</nav>
	<!-- End Side Navbar -->
</div>
				<!-- End Left Sidebar -->
