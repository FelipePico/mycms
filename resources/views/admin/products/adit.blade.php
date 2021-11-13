@extends('admin.master')

@section('title', 'Editar Productos')

@section('breadcrumb')

<li class="breadcrumb-item">
	<a href="{{ url('/admin/products') }}"> <i class="fas fa-boxes"></i> Productos</a>
</li>
@endsection

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-9">
			<div class="panel shadow">
					<div class="header">
						<h2 class="title">
							<i class="far fa-edit"></i> Editar Producto
						</h2>
					</div>
					<div class="inside">
						{!! Form::open(['url' => '/admin/product/'.$p->id.'/edit', 'files' => true]) !!}
						<div class="row">
							<div class="col-md-6">
								<label for="name">Nombre del producto:</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1">
											<i class="far fa-keyboard"></i>
										</span>
									</div>
									{!! Form::text('name', $p->name, ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="col-md-3">
								<label for="category">Categoría:</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1">
											<i class="far fa-hand-pointer"></i>
										</span>
									</div>
									{!! Form::select('category', $cats, $p->category_id, ['class' => 'form-select']) !!}
								</div>
							</div>

							<div class="col-md-3">
								<label for="name">Imagen Destacada:</label>
								<div class="custom-file">
									{!! Form::file('img', ['class' => 'form-control', 'id' => 'formFile', 'accept'=> 'image/*']) !!}
									
								</div>
							</div>
						</div>

						<div class="row mtop16">
							<div class="col-md-3">
								<label for="price">Precio:</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1">
											<i class="fas fa-dollar-sign"></i>
										</span>
									</div>
									{!! Form::number('price', $p->price, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any' ]) !!}
								</div>	
							</div>

							<div class="col-md-3">
								<label for="indiscount">¿En descuento?:</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1">
											<i class="fas fa-percent"></i>
										</span>
									</div>
									{!! Form::select('indiscount', ['0' => 'No', '1' => 'Si'], $p->in_discount, ['class' => 'form-select']) !!}
								</div>
							</div>

							<div class="col-md-3">
								<label for="discount">Descuento:</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1">
											<i class="fas fa-percent"></i>
										</span>
									</div>
									{!! Form::number('discount', $p->discount, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any' ]) !!}
								</div>
							</div>

							<div class="col-md-3">
								<label for="indiscount">Estado:</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1">
											<i class="fas fa-percent"></i>
										</span>
									</div>
									{!! Form::select('status', ['0' => 'Borrador', '1' => 'Public'], $p->status, ['class' => 'form-select']) !!}
								</div>
							</div>

						</div>


						<div class="row mtop16">
							<div class="col-md-12">
								<label for="content">Descripción</label>
								{!! Form::textarea('content', $p->content, ['class' => 'form-control', 'id' => 'editor' ]) !!}

							</div>
						</div>

						<div class="row mtop16">

							<div class="col-md-12">
								{!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}

							</div>

						</div>

						{!! Form::close() !!}

						
						
					</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel shadow">
				<div class="header">
					<h2 class="title">
						<i class="far fa-image"></i> Imagen Destacada
					</h2>
					<div class="inside">
						<img src="{{ url('/uploads/'.$p->file_path.'/'.$p->image) }}" class="img-fluid">
					</div>
				</div>
				
			</div>

			<div class="panel shadow mtop16">
				<div class="header">
					<h2 class="title">
						<i class="far fa-images"></i> Galería
					</h2>
				</div>
				<div class="inside">
					{!! Form::open(['url' => '/admin/product/'.$p->id.'/gallery/add', 'files' => true ]) !!}
					{!! Form::file('file_image', ['id' => 'product_file_image', 'accept' => 'image/*']) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection 