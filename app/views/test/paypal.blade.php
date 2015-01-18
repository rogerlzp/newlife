
@section('content')
<p>Test Payapl</p>

{{ Form::open(array('class'=>'form-vertical', 'url'=>route('payment.test1'),
'id'=>'checkoutForm', 'role'=>'form'))}}

<input
type="submit" class="btn btn-primary" value="立即下单"
		id="checkoutToPay">

		{{Form::close()}}
		
	
@stop