<div class="sidebar shadow">
	<div class="section-top">
		<div class="logo">
			<img src="{{ url('static/images/logo.png') }}" class="img-fluid">
		</div>

		<div class="user">
			<span class="subtitle">Hola:</span>
 			<div class="name">
 				{{ Auth::user()->name }} {{ Auth::user()->lastname }}
 				<a href="{{ url('/logout') }}" data-toggle="tooltip" data-placement="top" title="Salir">
 					<i class="fas fa-sign-out-alt"></i>
 				</a>
 			</div>
 			<div class="email">
 				{{ Auth::user()->email }} 
 			</div>
		</div>
	</div>

	<div class="main">
		<ul>
			@if(kvfj(Auth::user()->permissions, 'dashboard'))
			<li>
				<a href="{{ url('/admin') }}" class="lk-dashboard">
					<i class="fas fa-home"></i> Dashboard
				</a>
			</li>
			@endif

			@if(kvfj(Auth::user()->permissions, 'categories'))
			<li>
				<a href="{{ url('/admin/categories/0') }}" class="lk-categories lk-category_add lk-category_edit lk-category_delete lk-category_add">
					<i class="far fa-folder-open"></i>Categorias
				</a>
			</li>
			@endif

			@if(kvfj(Auth::user()->permissions, 'products'))
			<li>
				<a href="{{ url('/admin/products/1') }}" class="lk-products lk-products_add lk-product_search lk-product_edit lk-product_gallery_add">
					<i class="fas fa-boxes"></i> Productos
				</a>
			</li>
			@endif
			

			@if(kvfj(Auth::user()->permissions, 'orders_list'))
			<li>
				<a href="{{ url('/admin/orders/all') }}" class="lk-orders_list">
					<i class="fas fa-clipboard-list"></i> Ordenes
				</a>
			</li>
			@endif

			@if(kvfj(Auth::user()->permissions, 'user_list'))
			<li>
				<a href="{{ url('/admin/users/all') }}" class="lk-user_list lk-user_edit lk-user_permissions">
					<i class="fas fa-users"></i> Usuarios
				</a>
			</li>
			@endif

			@if(kvfj(Auth::user()->permissions, 'sliders_list'))
			<li>
				<a href="{{ url('/admin/sliders') }}" class="lk-sliders_list lk-slider-edit ">
					<i class="far fa-images"></i> Sliders
				</a>
			</li>
			@endif


			@if(kvfj(Auth::user()->permissions, 'settings'))
			<li>
				<a href="{{ url('/admin/settings') }}" class="lk-settings">
					<i class="fas fa-cogs"></i> Configuraciones
				</a>
			</li>
			@endif



			
		</ul>
	</div>
</div>
