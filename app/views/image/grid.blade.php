<link rel="stylesheet" href="{{ URL::asset('css/mysite.css') }}">

<script src="{{ asset('js/masonry.pkgd.min.js') }}"></script>
<script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('js/jquery.infinitescroll.min.js') }}"></script>

   
<script type="text/javascript">
jQuery(document).ready( function($) {
	
	$('#image_container').imagesLoaded( function() {
		  $('#image_container').masonry({
			  itemSelector: '.item',
		        columnWidth : 240 
			  });

	
		});

	  $('#image_container').infinitescroll({
          navSelector     : ".pagination",
          nextSelector    : ".pagination a:last",
          itemSelector    : ".item",
          debug           : false,
          dataType        : 'html',
          path: function(index) {
              return "?page=" + index;
          },
          loading: {
              finishedMsg: ""
          }
      }, function(newElements, data, url){
          var $newElems = $( newElements );
          $newElems.imagesLoaded(function(){
          $('#image_container').masonry( 'appended', $newElems, false);
          });

      });

	  $('.pagination').hide();
      

});
</script>

 
<div class="row js-trick-container">
<p> 
	@if($images->count())
		<div id="image_container">		
		    <div id="list">
		    @foreach($images as $image)
			    <div>
			    <img class="item" src="{{ URL::asset('img/temp/'.$image->image_path) }}">
			    </div>
		    @endforeach
		    </div>
		
		<div>
		{{$images->links()}}
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






@section('scripts')
	@if(count($images))
		<script src="{{ asset('js/vendor/masonry.pkgd.min.js') }}"></script>
		<script>
$(function(){$container=$(".js-trick-container");$container.masonry({gutter:0,itemSelector:".trick-card",columnWidth:".trick-card"});$(".js-goto-trick a").click(function(e){e.stopPropagation()});$(".js-goto-trick").click(function(e){e.preventDefault();var t="{{ route('tricks.show') }}";var n=$(this).data("slug");window.location=t+"/"+n})})
		</script>
	@endif
@stop
