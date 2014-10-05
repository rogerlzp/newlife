@section('title', trans('user.profile'))

@section('scripts')
<script type="text/javascript">
function addComment(){
	$.ajax({ 
        url: "{{URL::route('user.comment')}}",
        dataType: 'json', 
        data: {'product_id': "{{$product->id}}", content:$('#comment_text').val(), _token: "{{ csrf_token() }}"}  ,
        type: "POST", 
        success: function(output){ 
        	
            var html="<div id=\"comment-item\"><p>" + output.content + "</p><p>"
            			+ output.updated_at + "</p>";
            $('#comments').append(html);
        } 
    }); 
}

function addToCart() {
	$.ajax({ 
        url: "{{URL::route('cart.add')}}",
        dataType: 'json', 
        data: {'product_id': "{{$product->id}}",
             _token: "{{ csrf_token() }}"}  ,
        type: "POST", 
        success: function(output){ 
			alert(output);
        } 
    }); 
	
}

</script>
@stop


@section('content')
<div class="container">
	@if(Session::has('first_use'))
	  <div class="alert alert-success alert-dismissable text-center">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4>{{ trans('user.welcome') }}</h4>
		<p>{{ trans('user.welcome_subtitle') }}</p>
	  </div>
	@endif

	@if(Session::has('success'))
	    <div class="alert alert-success alert-dismissable">
	        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	         <h5>{{ Session::get('success') }}</h5>
	    </div>
	@endif



	<div class="row">

	<div class="col-md-4 img_show">

		<img src="{{ URL::asset('img/temp/'.$product->image->image_path)}}" width="350" height="350" >
    </div>
    
		<div class="col-md-8">
		<div><p>价格: {{ $product->price->price }}</div>
		<div><p>描述: {{ $product->short_description }}</div>
		<div class="btn btn-primary" onclick="addToCart()"><p>购买</div>
		<div ><p>添加到购物车</div>
		</div>
	</div>

	
	<div>
	<div class="comment-load-image"  id="comments">
		@foreach ($comments as $comment)
		<div id="comment-item">
		<p> {{$comment->content}}</p>
		<p> {{$comment->auther_id}}</p>
		<p> {{$comment->updated_at}} </p>
		</div>
		@endforeach
		
	</div>
	
	<div class="comment-form-image">
		<input type="text" id="comment_text" placeholder="add some comment...">
		<input type="button" value="comment" onclick="addComment()">	
		
	</div>
	
</div>
@stop



