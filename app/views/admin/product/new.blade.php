@section('content')

<div class="”container”">
	<div class="row">
	<div class="col-md-1" ></div>
		<div class="col-md-3 span4" >
			<ul class="nav nav-list">
				<li class="nav-header">What we are?</li>
				<li class="active"><a href="#">Home</a></li>
				<li><a href="#">Our Clients</a></li>
				<li class="nav-header">Our Friend</li>
				<li><a href="#">Google</a></li>
	
			</ul>
		</div>
		<div class="col-md-8 span8">
							<div class="content-box">
					<h1 class="page-title">
						{{ trans('products.creating_new_product') }}
					</h1>
					@if(Session::get('errors'))
					    <div class="alert alert-danger alert-dismissable">
					        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					         <h5>{{ trans('products.errors_while_creating') }}</h5>
					         @foreach($errors->all('<li>:message</li>') as $message)
					            {{$message}}
					         @endforeach
					    </div>
					@endif
					{{ Form::open(array('class'=>'form-vertical','id'=>'save-trick-form','role'=>'form'))}}
					    <div class="form-group">
					    	<label for="name">{{ trans('products.name') }}</label>
					    	{{Form::text('name', null, array('class'=>'form-control','placeholder'=>trans('products.name_placeholder') ));}}
					    </div>
					    <div class="form-group">
					    	<label for="short_description">{{ trans('products.description') }}</label>
					    	{{Form::textarea('short_description',null, array('class'=>'form-control','placeholder'=>trans('products.products_description_placeholder'),'rows'=>'3'));}}
					    </div>
					    <div class="form-group">
					    	<label for="sku">{{ trans('products.sku') }}</label>
					    	{{Form::text('sku',null, array('class'=>'form-control','placeholder'=>trans('products.sku') ));}}
					    </div>
					     <div class="form-group">
					    	<label for="stock">{{ trans('products.stock') }}</label>
					    	{{Form::text('stock',null, array('class'=>'form-control','placeholder'=>trans('products.stock') ));}}
					    </div>
					     <div class="form-group">
					    	<label for="enabled">{{ trans('products.enabled') }} </label>
					    
					    {{ Form::select('enabled', array('1' => 'Enabled', '2' => 'Disabled')); }}
					    </div>
					
					    <div class="form-group">
					        <div class="text-right">
					          <button type="submit"  id="save-section" class="btn btn-primary ladda-button" data-style="expand-right">
					            {{ trans('tricks.save_trick') }}
					          </button>
					        </div>
					    </div>
					{{Form::close()}}
				</div>
			
		</div>

	</div>



	@stop