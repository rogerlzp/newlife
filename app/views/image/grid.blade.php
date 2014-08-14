<link rel="stylesheet" href="{{ URL::asset('css/mysite.css') }}">

<script src="{{ asset('js/masonry.pkgd.min.js') }}"></script>
<script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('js/jquery.jscroll.min.js') }}"></script>
<script src="{{ asset('js/jquery.infinitescroll.min.js') }}"></script>
   
<script type="text/javascript">
jQuery(document).ready( function($) {
	$('#image_container').imagesLoaded( function() {
		  $('#image_container').masonry({
			  itemSelector: '.item',
		        columnWidth : 240 
			  });
		});

	$(function() {
	    $('#image_container').jscroll({
	        autoTrigger: true,
	        nextSelector: '.pagination li.active + li a', 
	        contentSelector: 'div#image_container',
	        callback: function() {
	            $('ol.pagination:visible:first').hide();
	        }
	    });
	});  
});
</script>

 
<div class="row js-trick-container">
<p> 
	@if($images->count())
		<div id="image_container">		
		    <div id="list">
		    <ol>
		    @foreach($images as $image)
			    <div >
			    <li><img class="item" src="{{ URL::asset('img/temp/'.$image->image_path) }}"></li>
			    </div>
		    @endforeach
		    </ol>
		    </div>
		
			<div class="col-span-12">
    			<div class="paginate text-center">
                 {{$images->links()}}
               </div> 
            </div>
	    </div>		
	@else
		<div class="col-lg-12">
			<div class="alert alert-danger">
				{{ trans('tricks.no_tricks_found') }}				
			</div>
		</div>
	@endif
</div>


@if($images->count())
	<div class="row">
	    <div class="col-md-12 text-center">
	    	@if(isset($appends))
	        	{{ $images->appends($appends)->links(); }}
	        @else
				
	        @endif
	    </div>
	</div>
@endif

@section('scripts')
	@if(count($images))
		<script src="{{ asset('js/vendor/masonry.pkgd.min.js') }}"></script>
		<script>
$(function(){$container=$(".js-trick-container");$container.masonry({gutter:0,itemSelector:".trick-card",columnWidth:".trick-card"});$(".js-goto-trick a").click(function(e){e.stopPropagation()});$(".js-goto-trick").click(function(e){e.preventDefault();var t="{{ route('tricks.show') }}";var n=$(this).data("slug");window.location=t+"/"+n})})
		</script>
	@endif
@stop
