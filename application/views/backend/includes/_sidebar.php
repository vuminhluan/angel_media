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
			<li data-primary-tab="product"><a href="#dropdown-product" aria-expanded="false" data-toggle="collapse"><i class="la la-archive"></i><span>Sản phẩm</span></a>
				<ul id="dropdown-product" class="collapse list-unstyled pt-0">
					<li data-secondary-tab="product_list"><a href="<?= base_url('admin/products') ?>">Danh sách sản phẩm</a></li>
					<li data-secondary-tab="product_create"><a href="<?= base_url('admin/product/new') ?>">Thêm sản phẩm mới</a></li>
					<li data-secondary-tab="product_cate_list"><a href="<?= base_url('admin/product/categories') ?>">Danh mục sản phẩm</a></li>
					<li data-secondary-tab="product_cate_create"><a href="<?= base_url('admin/product/category/new') ?>">Thêm danh mục sản phẩm</a></li>
				</ul>
			</li>
			<li><a href="#dropdown-tables" aria-expanded="false" data-toggle="collapse"><i class="la la-th-large"></i><span>Tables</span></a>
				<ul id="dropdown-tables" class="collapse list-unstyled pt-0">
					<li><a href="tables-basic.html">Basic</a></li>
					<li><a href="tables-datatables.html">Datatables</a></li>
					<li><a href="tables-tabledit.html">Tabledit</a></li>
				</ul>
			</li>
			<li><a href="maps-leaflet.html"><i class="la la-map"></i><span>Maps</span></a></li>
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
			<li><a href="#dropdown-generic" aria-expanded="false" data-toggle="collapse"><i class="la la-file-text"></i><span>Generic</span></a>
				<ul id="dropdown-generic" class="collapse list-unstyled pt-0">
					<li><a href="pages-coming-soon.html">Coming Soon</a></li>
					<li><a href="pages-profile.html">Profile</a></li>
					<li><a href="pages-invoice.html">Invoice</a></li>
					<li><a href="pages-search.html">Search</a></li>
					<li><a href="pages-faq.html">FAQ</a></li>
					<li><a href="pages-blank.html">Blank</a></li>
				</ul>
			</li>
			<li><a href="#dropdown-social" aria-expanded="false" data-toggle="collapse"><i class="la la-comments"></i><span>Social</span></a>
				<ul id="dropdown-social" class="collapse list-unstyled pt-0">
					<li><a href="pages-newsfeed.html">Newsfeed</a></li>
					<li><a href="pages-about.html">About</a></li>
					<li><a href="pages-events.html">Events</a></li>
					<li><a href="pages-friends.html">Friends</a></li>
					<li><a href="pages-groups.html">Groups</a></li>
				</ul>
			</li>
			<li><a href="#dropdown-email" aria-expanded="false" data-toggle="collapse"><i class="la la-at"></i><span>Email</span></a>
				<ul id="dropdown-email" class="collapse list-unstyled pt-0">
					<li><a href="email-welcome.html">Welcome</a></li>
					<li><a href="email-password.html">Reset Password</a></li>
					<li><a href="email-order.html">Order Confirmation</a></li>
				</ul>
			</li>
			<li><a href="#dropdown-pricing" aria-expanded="false" data-toggle="collapse"><i class="la la-usd"></i><span>Pricing</span></a>
				<ul id="dropdown-pricing" class="collapse list-unstyled pt-0">
					<li><a href="pages-pricing-tables-01.html">Style 01</a></li>
					<li><a href="pages-pricing-tables-02.html">Style 02</a></li>
				</ul>
			</li>
			<li><a href="#dropdown-error" aria-expanded="false" data-toggle="collapse"><i class="la la-exclamation-triangle"></i><span>Errors</span></a>
				<ul id="dropdown-error" class="collapse list-unstyled pt-0">
					<li><a href="pages-404-01.html">Style 01</a></li>
					<li><a href="pages-404-02.html">Style 02</a></li>
				</ul>
			</li>
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
