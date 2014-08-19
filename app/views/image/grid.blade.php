<link rel="stylesheet" href="{{ URL::asset('css/mysite.css') }}">

<script src="{{ asset('js/masonry.pkgd.min.js') }}"></script>
<script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('js/jquery.infinitescroll.min.js') }}"></script>

   
<script type="text/javascript">
jQuery(document).ready( function($) {
	
	$('#image_container').imagesLoaded( function() {
		  $('#image_container').masonry({
			  itemSelector: '#image_wrapper',
		        columnWidth : 240 
			  });

	
		});

	  $('#image_container').infinitescroll({
          navSelector     : ".pagination",
          nextSelector    : ".pagination a:last",
          itemSelector    : "#image_wrapper",
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


function addPin($id, $image_id, $image_path){


	if($id == 'login') {
		window.location.href = "http://stackoverflow.com";
	}

		
$("#dialog-message").dialog({
    modal: true,
    draggable: true,
    resizable: true,

    width: 400,
    dialogClass: 'ui-dialog-osx',
    buttons: {
        "I've read and understand this": function() {
            $(this).dialog("close");
        }
    }
});

}

</script>

 
<div class=" content-box">
<p> 
	@if($images->count())
		<div id="image_container">		
		    <div id="list">
		    @if (Auth::check())
		    @foreach($images as $image)
			    <div id="image_wrapper">
			    <img class="item" src="{{ URL::asset('img/temp/'.$image->image_path) }}">

			<input type="button" class="editable" value="pin" hidden="true" onclick="addPin({{Auth::user()->id}}, {{$image->id}}, {{$image->image_path}})"/>
			    </div>
		    @endforeach
		    @else
		        @foreach($images as $image)
			    <div id="image_wrapper">
			    <img class="item" src="{{ URL::asset('img/temp/'.$image->image_path) }}">

			<input type="button" class="editable" value="pin" hidden="true" onclick="addPin('login', {{$image->id}}, {{$image->image_path}}))"/>
			    </div>
		    @endforeach
		    @endif
		    
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
