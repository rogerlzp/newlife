@section('title', trans('user.profile'))



	
@section('scripts')

<script
	src="{{ asset('js/jquery.imgareaselect.pack.js') }}"></script>
	
<script
	src="{{ asset('js/jquery.load.js') }}"></script>

<script type="text/javascript">
function addComment(){
	$.ajax({ 
        url: "{{URL::route('user.comment')}}",
        dataType: 'json', 
        data: {'image_id': "{{$image->id}}", content:$('#comment_text').val(), _token: "{{ csrf_token() }}"}  ,
        type: "POST", 
        success: function(output){ 
        	
            var html="<div id=\"comment-item\"><p>" + output.content + "</p><p>"
            			+ output.updated_at + "</p>";
            $('#comments').append(html);
        } 
    }); 
}

function addTag(){			
	$.ajax({ 
        url: "{{URL::route('admin.image.tag')}}",
        dataType: 'json', 
        data: {'image_id': "{{$image->id}}", 'x1':$("#x1").val(), 'y1':$("#y1").val(),
			'w':$("#w").val(), 'h':$("#h").val(), 'product_id':$("input[type=checkbox]:checked").val(),
            " _token": "{{ csrf_token() }}"}  ,
        type: "POST", 
        success: function(output){ 
        } 
    }); 
}

$(document).ready(function(){
	
	
});

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



	<div class="">
	<div class="" >
	<div class="imagex">
		<img id="imageid" border="0" src="{{ URL::asset('img/temp/'.$image->image_path) }}"  height="600" width="800"  >
		
	
		
		<a style="height:400px;width:300px;top:300px" class="taglink"> hello
<span style="display:inline-block;padding:5px 5px 5px 5px;background:#7ba84e;color:#fff;border:1px solid #fff;border-radius:23px 23px 23px 0;">
￥12</span></a>
   
		</img>
  </div>
		<div><p>描述: {{ $image->description }}</div>
		
		 <div id="title_container" class="hide">
      		<!-- Grab the X/Y/Width/Height we dont need x2 & y2, but will capture them anyway -->
      		<fieldset>
        		<input type="hidden" name="x1" id="x1"  />
        		<input type="hidden" name="y1" id="y1"  />
        		<input type="hidden" name="x2" id="x2"  />
        		<input type="hidden" name="y2" id="y2"  />
        		<input type="hidden" name="w" id="w" />
        		<input type="hidden" name="h" id="h"  />
        		<label for="title">Tag text</label><br />
        		<input type="text" id="comment" name="comment" size="30" value="" maxlength="55" /><br />
        		<input type="hidden" name="tag" value="true" />
        		<input type="submit" value="Submit" class="" onclick="addTag()"/>
          </fieldset>
          </div>
             <div class="on-off">
             
      <div class="start-tagging">Click here to start tagging</div>
      <div class="finish-tagging hide">Click here to cancel tagging</div>
    </div>
      </div>
      </div>
      <div class="col_md-3">
      <p>helloworld</p>
      	@foreach($products as $product)
			    <tr rel="{{ $product->id }}">
			    <input type="checkbox" name="checkbox" id="checkbox_id" value="{{ $product->id }}" />
			        <td><a href="{{url('admin/product/view/'.$product->id)}}">{{ $product->name }}</a></td>
			        <td>{{ $product->short_description}}<br>
			        </td>
			     </tr>
			    @endforeach
			    
      </div>
      
	

	
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
		<input type="button" value="comment" onclick="addTag()">	
	</div>
	
</div>
@stop



