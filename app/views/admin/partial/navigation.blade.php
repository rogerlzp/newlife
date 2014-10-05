<div class="navbar navbar-default navbar-static-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".header-collapse">
				<span class="sr-only">{{ trans('partials.toggle_navigation') }}</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<a class="navbar-brand" href="{{ url('/') }}">
				<img width="207" height="50" src="{{ asset('img/logo@2x.png') }}">
			</a>
		</div>

		<div class="collapse navbar-collapse header-collapse">
			<ul class="nav navbar-nav">
			

				 <li class="active"><a href="{{ URL::route('admin.category2.index') }}">category</a></li>
				<li class="dropdown" >
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Product<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
				<li> <a href="{{URL::route('admin.product.create') }}">new product</a></li>
				<li> <a href="{{URL::route('admin.product.index') }}">list product</a></li>
			    </ul>
			    </li>
			  <li class="dropdown" >
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Image<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
				<li> <a href="{{URL::route('admin.image.index') }}">list image</a></li>
			    </ul>
			    </li>
			    
				
				

				@if(Auth::guest())
					<li class="visible-xs"><a href="{{ url('register') }}">{{ trans('partials.register') }}</a></li>
					<li class="visible-xs"><a href="{{ url('login') }}">{{ trans('partials.login') }}</a></li>
				@else
					<li class="visible-xs"><a href="{{ url('user') }}">{{ trans('partials.my_profile') }}</a></li>
					<li class="visible-xs"><a href="{{ url('logout') }}">{{ trans('partials.logout') }}</a></li>
				@endif

			</ul>


		</div>

	</div>
</div>
