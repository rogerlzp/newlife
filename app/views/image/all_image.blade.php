
<link
	rel="stylesheet" href="{{ URL::asset('css/mysite.css') }}">


<script
	src="{{ asset('js/masonry.pkgd.min.js') }}"></script>
<script
	src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
<script
	src="{{ asset('js/jquery.jscroll.min.js') }}"></script>
<script
	src="{{ asset('js/jquery.infinitescroll.min.js') }}"></script>


<script type="text/javascript">
jQuery(document).ready( function($) {
	$('#image_container').imagesLoaded( function() {
		  $('#image_container').masonry({
			  itemSelector: '.item',
		        columnWidth : 240 
			  });

		  
		});

	  // Show edit-buttons only on mouse over
    $('.item').each(function(){
        var thisPin = $(this);
        thisPin.find('.editable').hide();
        thisPin.off('hover');
        thisPin.hover(function() {
            thisPin.find('.editable').stop(true, true).fadeIn(300);
        }, function() {
            thisPin.find('.editable').stop(true, false).fadeOut(300);
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
	<div id="image_container">
		<div id="list">
				@foreach($images as $image)
				<div>
					<li><a href="{{$image->id}}"> 
					<img class="item"
							src="{{ URL::asset('img/temp/'.$image->image_path) }}">
					</li> </a>
				</div>
				@endforeach
		</div>





		<div class="col-span-12">
			<div class="paginate text-center"></div>
		</div>
	</div>




	<div class="col-lg-12">
		<div class="alert alert-danger">{{ trans('tricks.no_tricks_found') }}
		</div>
	</div>

</div>


@section('scripts') 
@if(count($images))
<script
	src="{{ asset('js/vendor/masonry.pkgd.min.js') }}"></script>
<script>
$(function(){$container=$(".js-trick-container");$container.masonry({gutter:0,itemSelector:".trick-card",columnWidth:".trick-card"});$(".js-goto-trick a").click(function(e){e.stopPropagation()});$(".js-goto-trick").click(function(e){e.preventDefault();var t="{{ route('tricks.show') }}";var n=$(this).data("slug");window.location=t+"/"+n})})
		</script>
@endif 
@stop
