@section('scripts')
<script>
$(document).ready(function(){

	$('#checkoutToPay').on('click',function() {
		alert("check out to pay");	
	});
	
	 $("#J_useNewAddr").on("click",
		        function() {
		 $("#J_editAddrBox").show();
	 });

	 $("#J_editAddrOk").on("click",
		        function() {
	//	 setAddress();
	 });


	  $("#Provinces").change(function() {
         var b = $(this).val();
         getProvinceData(b);
         
         $("#Citys").prop("disabled", !0).find("option:gt(0)").remove(),
         $("#Countys").prop("disabled", !0).find("option:gt(0)").remove()
     });
	  $("#Citys").change(function() {
	         var b = $(this).val();
	         getCityData(b);
	     });

	  $("#checkoutAddrList > div[id^=address]").click(function() {
	         var b = $(this);
	         $("#checkoutAddrList > div[id^=address]").removeClass('selected');
	         b.addClass("selected");
	         $("#selected_address").attr('value', b.attr('id').substr(8));
	         
	     });

	  $("#CheckoutTime > li").click(function() {
	         var b = $(this);
	         $("#CheckoutTime > li").removeClass('selected');
	         b.addClass("selected");
	         $("#delivery_time_hidden").attr('value', b.children('input').val());
	     });
	  $("#checkoutInvoice > div > div > ul > li").click(function() {
	         var b = $(this);
	         $("#checkoutInvoice > div > div > ul > li").removeClass('selected');
	         b.addClass("selected");
	     });

	

});


function getProvinceData(province){
	$.ajax({ 
        url: "{{URL::route('province.data')}}",
        dataType: 'json', 
        data: {'province_id':province, _token:"{{ csrf_token() }}"} ,
        type: "GET", 
        success: function(cities){ 
        	var html = "";
            $.each(cities, function(index, city){
				html += "<option  value="+city.id+">"+city.city_name +"</option>";				
                });
            $("#Citys").append(html);
            $("#Citys").removeAttr('disabled');
        }   
    }); 
	
}


function getCityData(province){
	$.ajax({ 
        url: "{{URL::route('city.data')}}",
        dataType: 'json', 
        data: {'city_id':province, _token:"{{ csrf_token() }}"} ,
        type: "GET", 
        success: function(counties){ 
        	var html = "";
            $.each(counties, function(index, county){
				html += "<option  value="+county.id+">"+county.county_name +"</option>";				
             });
            $("#Countys").append(html);
            $("#Countys").removeAttr('disabled');
        }   
    }); 
}

function setAddress() {
	$.ajax({ 
        url: "{{URL::route('address.save')}}",
        dataType: 'json', 
        data: {'province_id': $("#Provinces").val(), 'city_id':$("#Citys").val(), 'county_id': $("#Countys").val(),
            'consignee': $("#Consignee").val(), 'phone':$("#Telephone").val(),
            'street': $("#Street").val(), 'zipcode':$("#Zipcode").val(), 
              _token:"{{ csrf_token() }}"} ,
        type: "POST", 
        success: function(output){ 
        	alert("success");
   			var html="<dl class=\"item selected\"  >" +
   						"<dt> <strong class=\"itemConsignee\">"+$("#Consignee").val()+"</strong>"
   						+ "<strong class=\"itemTag tag\">"+$('#newTag').val()+"</strong></dt>"
   						+"<dd> <p> "+ $("#Telephone").val() +"</p>" + "<p> "+ $("#Provinces").val() 
   						+" "+ $("#Citys").val() + $("#Countys").val() + "</p>"
   						+ "<p> " +$("#Street").val() + "</p> </dd> </dl>";
			
   			$('#checkoutAddrList').append(html);		
   		//	$('#newConsignee').hidden();	
   			$("#J_editAddrBox").hide();	
   	   					
        } ,
        error: function(error1) {
			alert(error1);
			alert("wrong");
        }  
    }); 

}
</script>

@stop @section('content')
<div class="container">
	<div class="checkout-box">
	{{ Form::open(array('class'=>'form-vertical', 'url'=>route('order.new'), 
	'id'=>'checkoutForm', 'role'=>'form'))}}
			<div class="checkout-box-bd">
				<!-- 地址状态 0：默认选择；1：新增地址；2：修改地址 -->
				<input type="hidden" name="Checkout[addressState]" id="addrState"
					value="0">
				<!-- 收货地址 -->
				<div class="xm-box">
					<div class="box-hd ">
						<h2 class="title">收货地址</h2>
						<!---->
					</div>
					<div class="box-bd">
						<div class="clearfix xm-address-list" id="checkoutAddrList">
							<div class="item use-new-addr" id="J_useNewAddr" data-state="off"
								onclick="">
								<span class="iconfont icon-add">+</span> 使用新地址
							</div>
						<input type="hidden" id="selected_address" name="selected_address" value=""/>
						@if(Auth::check())
						@foreach(Auth::user()->addresses as $address)	
						<div class="item" id="address_{{$address->id}}" data-state="off">
								<span class="iconfont icon-add" >
								<p >{{$address->address}}</p>
								</span> 
							</div>
					
						@endforeach
						@endif
							</div>
						<input type="hidden" name="newAddress[consignee]"
							id="newConsignee"> <input type="hidden"
							name="newAddress[province]" id="newProvince"> <input
							type="hidden" name="newAddress[city]" id="newCity"> <input
							type="hidden" name="newAddress[district]" id="newCounty"> <input
							type="hidden" name="newAddress[address]" id="newStreet"> <input
							type="hidden" name="newAddress[zipcode]" id="newZipcode"> <input
							type="hidden" name="newAddress[tel]" id="newTel"> <input
							type="hidden" name="newAddress[tag_name]" id="newTag">

						<div class="modal fade" id="delete_category" tabindex="-1"
							role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"
											aria-hidden="true">&times;</button>
										<h4 class="modal-title">{{ trans('admin.are_you_sure') }}</h4>
									</div>
									<div class="modal-body">
										<p class="lead text-center">{{
											trans('admin.category_will_be_deleted') }}</p>
									</div>
									<div class="modal-footer">
										<a data-dismiss="modal" href="#delete_category"
											class="btn btn-default">{{ trans('admin.keep') }}</a> <a
											href="" id="delete_link" class="btn btn-danger">{{
											trans('admin.delete') }}</a>
									</div>
								</div>
								<!-- /.modal-content -->
							</div>
							<!-- /.modal-dialog -->
						</div>
						<!-- /.modal -->

						<div class="modal xm-edit-addr-box2" id="J_editAddrBox"
							aria-labelledby="myModalLabel">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="bd1">
										<div class="item2">
											<label>收货人姓名<span>*</span>
											</label> <input type="text" name="userAddress[consignee]"
												id="Consignee" class="input" placeholder="收货人姓名"
												maxlength="15" autocomplete="off">
											<p class="tip-msg tipMsg"></p>
										</div>
										<div class="item2">
											<label>联系电话<span>*</span>
											</label> <input type="text" name="userAddress[tel]"
												class="input" id="Telephone" placeholder="11位手机号"
												autocomplete="off">
											<p class="tel-modify-tip" id="telModifyTip">
												如果不修改手机号，请重新输入原收货手机号 <em></em> 以便确认
											</p>
											<p class="tip-msg tipMsg"></p>
										</div>
										<div class="item2">
											<label>地址<span>*</span>
											</label> <select name="userAddress[province]" id="Provinces"
												class="select-1"><option value="0">省份/自治区</option>
												<option zipcode="0" value="110000">北京</option>
												<option zipcode="0" value="120000">天津</option>
												<option zipcode="0" value="130000">河北</option>
												<option zipcode="0" value="140000">山西</option>
												<option zipcode="0" value="150000">内蒙古</option>
												<option zipcode="0" value="210000">辽宁</option>
												<option zipcode="0" value="220000">吉林</option>
												<option zipcode="0" value="230000">黑龙江</option>
												<option zipcode="0" value="310000">上海</option>
												<option zipcode="0" value="320000">江苏</option>
												<option zipcode="0" value="330000">浙江</option>
												<option zipcode="0" value="340000">安徽</option>
												<option zipcode="0" value="350000">福建</option>
												<option zipcode="0" value="360000">江西</option>
												<option zipcode="0" value="370000">山东</option>
												<option zipcode="0" value="410000">河南</option>
												<option zipcode="0" value="420000">湖北</option>
												<option zipcode="0" value="430000">湖南</option>
												<option zipcode="0" value="440000">广东</option>
												<option zipcode="0" value="450000">广西</option>
												<option zipcode="0" value="460000">海南</option>
												<option zipcode="0" value="500000">重庆</option>
												<option zipcode="0" value="510000">四川</option>
												<option zipcode="0" value="520000">贵州</option>
												<option zipcode="0" value="530000">云南</option>
												<option zipcode="0" value="540000">西藏</option>
												<option zipcode="0" value="610000">陕西</option>
												<option zipcode="0" value="620000">甘肃</option>
												<option zipcode="0" value="630000">青海</option>
												<option zipcode="0" value="640000">宁夏</option>
												<option zipcode="0" value="650000">新疆</option>
											</select> <select name="userAddress[city]" id="Citys"
												class="select-2" disabled="">
												<option>城市/地区/自治州</option>
											</select> <select name="userAddress[county]" id="Countys"
												class="select-3" disabled="">
												<option>区/县</option>
											</select>
											<textarea name="userAddress[street]" class="input-area"
												id="Street" placeholder="路名或街道地址，门牌号"></textarea>
											<p class="tip-msg tipMsg"></p>
										</div>
										<div class="item2">
											<label>邮政编码<span>*</span>
											</label> <input type="text" name="userAddress[zipcode]"
												id="Zipcode" class="input" placeholder="邮政编码"
												autocomplete="off">
											<p class="zipcode-tip" id="zipcodeTip"></p>
											<p class="tip-msg tipMsg"></p>
										</div>
										<div class="item2">
											<label>地址标签<span>*</span>
											</label> <input type="text" name="userAddress[tag]" id="Tag"
												class="input"
												placeholder="地址标签：如&quot;家&quot;、&quot;公司&quot;。限5个字内">
											<p class="tip-msg tipMsg"></p>
										</div>
									</div>
									<div class="ft clearfix">
										<button type="button" class="btn btn-lineDake btn-small "
											id="J_editAddrCancel">重新选择地址</button>
										<button type="button" class="btn btn-primary  btn-small "
											id="J_editAddrOk" onclick="setAddress()">确认收货地址</button>
									</div>
								</div>
								<div class="xm-edit-addr-backdrop" id="J_editAddrBackdrop"></div>
							</div>
						</div>
					</div>

				</div>
				<!-- 收货地址 END-->
				<div id="checkoutPayment">
					<!-- 支付方式 -->
					<div class="xm-box">
						<div class="box-hd ">
							<h2 class="title">支付方式</h2>
						</div>
						<div class="box-bd">
							<ul id="checkoutPaymentList"
								class="checkout-option-list clearfix J_optionList">
								<li class="selected"><input type="radio"
									name="Checkout[pay_id]" checked="checked" value="1">
									<p>
										在线支付 <span></span>
									</p>
								</li>
							</ul>
						</div>
					</div>
					<!-- 支付方式 END-->
					<div class="xm-box">
						<div class="box-hd ">
							<h2 class="title">配送方式</h2>
						</div>
						<div class="box-bd">
							<ul id="checkoutShipmentList"
								class="checkout-option-list clearfix J_optionList">
								<li class="selected">
								<input type="radio" data-price="0"
									name="Checkout[shipment_id]" checked="checked" value="1">
									<p>
										免费配送 <span></span>
									</p>
								</li>
							</ul>
						</div>
					</div>
					<!-- 配送方式 END-->
					<!-- 配送方式 END-->
				</div>
				<!-- 送货时间 -->
				<div class="xm-box">
					<div class="box-hd">
						<h2 class="title">送货时间</h2>
						<input type="hidden" id="delivery_time_hidden" name="" value="">
					</div>
					<div class="box-bd">
						<ul class="checkout-option-list clearfix J_optionList" id="CheckoutTime">
							<li class=" ">

							<input type="radio" checked="checked"
								name="Checkout[best_time]" value="1">
								<p>
									不限送货时间<span>周一至周日</span>
								</p></li>
							<li class="selected "><input type="radio" name="Checkout[best_time]"
								value="2">
								<p>
									工作日送货<span>周一至周五</span>
								</p></li>
							<li class=" "><input type="radio" name="Checkout[best_time]"
								value="3">
								<p>
									双休日、假日送货<span>周六至周日</span>
								</p></li>
						</ul>
					</div>
				</div>
				<!-- 送货时间 END-->
				<!-- 发票信息 --> <!-- TODO: add later  -->
				<div id="checkoutInvoice" style="display:none;" >
				
					<div class="xm-box">
						<div class="box-hd">
							<h2 class="title">发票信息</h2>
						</div>
						<div class="box-bd">
							<div class="invoice-info invoice-info-2"
								id="checkoutInvoiceDetail" style="display: block;">
								<p>发票内容：购买商品明细</p>
								<p>发票抬头：请确认单位名称正确,以免因名称错误耽搁您的报销。注：合约机话费仅能开个人发票</p>
								<ul class="type clearfix J_invoiceType">
									<li>
									<input type="radio" value="0"
										name="Checkout[invoice_type]" id="noNeedInvoice">
									</li>
									<li class="">
									<input class="invoiceType" type="radio"
										id="commonPersonal" name="Checkout[invoice_type]" value="1">
										个人</li>
									<li class="">
									<input class="invoiceType" type="radio"
										name="Checkout[invoice_type]" value="2"> 单位</li>
								</ul>
								<div id="CheckoutInvoiceTitle" class=" invoice-title">
									<label for="Checkout[invoice_title]">单位名称：</label> <input
										name="Checkout[invoice_title]" type="text" maxlength="49"
										value="" class="input"> <span class="tip-msg J_tipMsg"></span>
								</div>

							</div>

						</div>
					</div>
				</div>
				<!-- 发票信息 END-->
			</div>
			<div class="checkout-box-ft">
				<!-- 商品清单 -->
				<div id="checkoutGoodsList" class="checkout-goods-box">
					<div class="xm-box">
						<div class="box-hd">
							<h2 class="title">确认商品及优惠券</h2>
						</div>
						<div class="box-bd">
							<dl class="checkout-goods-list">
								<dt class="clearfix">
									<span class="col col-1">商品名称</span> <span class="col col-2">单品价格</span>
									<span class="col col-3">购买数量</span> <span class="col col-4">小计</span>
								</dt>
								
								@if(Session::has('cart')) 
								@foreach(Session::get('cart')->cartitems as $cartitem)
								<dd class="item clearfix">
									<div class="item-row">
										<div class="col col-1">
											<div class="g-pic">
												<img src="./填写订单信息_files/T1izYvBjAT1RXrhCrK.jpg"
													srcset="http://img08.mifile.cn/v1/MI_18455B3E4DA706226CF7535A58E875F0267/T1izYvBjAT1RXrhCrK.jpg?width=80&amp;height=80 2x"
													width="40" height="40">
											</div>
											<div class="g-info">
												<a href="http://www.mi.com/item/1143300051" target="_blank">
													{{$cartitem->product->name}}</a>
											</div>
										</div>

										<div class="col col-2">{{$cartitem->product->price->price}} </div>
										<div class="col col-3">{{$cartitem->quantity}}</div>
										<div class="col col-4">{{$cartitem->quantity * $cartitem->product->price->price}}</div>
									</div>
								</dd>
								@endforeach
								@endif

							
							</dl>
							<div class="checkout-count clearfix">
								<div class="checkout-count-extend xm-add-buy">
									<div class="item" id="checkoutCouponBox">
										<input type="checkbox" name="Checkout[useCoupon]"
											id="useCoupon"> <i class="iconfont icon-checkbox "></i>
										使用优惠券 <span class="coupon-result" id="couponResult"></span>

									</div>
									<!-- item E -->

									<div class="coupon-box" id="couponBox">
										<span class="arrow-border"></span><span class="arrow-bg"></span>
										<div class="coupon-tab-nav clearfix" id="couponTabNav">
											<span class="nav-item current">填写礼品券码</span><span
												class="nav-item couponList">查看我账户中的优惠券</span>
										</div>
										<div class="coupon-tab-con" id="couponTabCon">
											<div class="con-item current">
												<div class="con-item-bd">
													<input type="text" name="couponCode" id="couponCode"
														class="coupon-code">
												</div>
												<div class="con-item-ft">
													<p class="coupon-tip" id="checkCouponTip"></p>
													<a href="http://order.mi.com/buy/checkout#"
														class="btn btn-lineDakeLight btn-small J_cancelCouponBtn">取消</a><a
														href="http://order.mi.com/buy/checkout#"
														class="btn btn-primary btn-small" id="checkCouponBtn">确认使用</a>
												</div>
											</div>
											<!-- con-item -->
											<div class="con-item">

												<div class="con-item-bd">
													<span>没有优惠券可以选择</span>
												</div>
											</div>
											<!-- con-item -->
										</div>
										<!-- tab-con -->
									</div>
									<!-- coupon-box -->
									<div class="item J_addBuy ">
										<input type="checkbox" data-isbatch="false" id="Gift664"
											name="Checkout[gift][]" data-goodsid="2134900285-0-1-664"
											data-actid="664"
											data-itemid="8888888_0_bargain_664_total_1_sale"
											data-price="1" value="2134900285"> <i
											class="iconfont icon-checkbox "></i>+1元得礼品包装：环保手提礼品袋
										<!--￥1-->
									</div>
									<!--S 保障计划 产品选择弹框 -->
									<!--E 保障计划 产品选择弹框 -->
								</div>
								<!-- checkout-count-extend -->
								<div class="checkout-price">
									<ul>
										<li>商品件数：<span>{{Session::get('cart')->total_quantity}}</span>
										</li>
										<li>金额合计：<span>{{Session::get('cart')->total_price}}元</span>
										
										</li>
										<li>活动优惠：<span>-0元</span>
										</li>
										<li>优惠券抵扣：<span id="couponDesc">-0元</span>
										</li>
										<li>运费：<span id="postageDesc">0元</span>
										</li>
									</ul>
									<p class="checkout-total">
										应付总额：<span><strong id="totalPrice">279.00</strong>元</span>
									</p>
								</div>
								<!--  -->
							</div>
						</div>
					</div>

					<!--S 加价购 产品选择弹框 -->
					<div class="modal hide modal-choose-pro" id="J_choosePro-664">
						<div class="modal-header">
							<span class="close" data-dismiss="modal"><i class="iconfont"></i>
							</span>
							<h3>选择产品</h3>
							<div class="more">
								<div class="xm-recommend-page clearfix">
									<a class="page-btn-prev   J_carouselPrev iconfont"
										href="javascript: void(0);"></a><a
										class="page-btn-next  J_carouselNext iconfont"
										href="javascript: void(0);"></a>
								</div>
							</div>
						</div>
						<div class="modal-body J_chooseProCarousel">
							<div class="J_carouselWrap modal-choose-pro-list-wrap">
								<ul class="clearfix J_carouselList">
								</ul>
							</div>
						</div>
						<div class="modal-footer">
							<a href="http://order.mi.com/buy/checkout#"
								class="btn btn-disabled J_chooseProBtn">加入购物车</a>
						</div>
					</div>
					<!--E 加价购 产品选择弹框 -->

					<!--S 保障计划 产品选择弹框 -->


				</div>
				<!-- 商品清单 END -->
				<input type="hidden" id="couponType" name="Checkout[couponsType]"> <input
					type="hidden" id="couponValue" name="Checkout[couponsValue]">
				<div class="checkout-confirm">
					<div id="submitAddress"></div>
					<a href="http://order.mi.com/cart"
						class="btn btn-lineDakeLight btn-back-cart">返回购物车</a> <input
						type="submit" class="btn btn-primary" value="立即下单"
						id="checkoutToPay">
				</div>
			</div>
		</form>
	</div>



</div>
<!-- 禮品卡提示 S-->
<div class="modal hide lipin-modal" id="lipinTip">
	<div class="modal-header">
		<h2 class="title">温馨提示</h2>
		<p>
			为保障您的利益与安全，下单后礼品卡将会被使用，<br> 且订单信息将不可修改。请确认收货信息：
		</p>
	</div>
	<div class="modal-body">
		<ul>
			<li><strong>收&nbsp;&nbsp;货&nbsp;&nbsp;人：</strong><span
				id="lipin-uname"></span></li>
			<li><strong>联系电话：</strong><span id="lipin-uphone"></span></li>
			<li><strong>收货地址：</strong><span id="lipin-uaddr"></span></li>
		</ul>
	</div>
	<div class="modal-footer">
		<span class="btn btn-primary" id="useGiftCard">确认下单</span><span
			class="btn btn-dakeLight" id="closeGiftCard">返回修改</span>
	</div>
</div>
<!--  禮品卡提示 E-->
<!-- 预售提示 S-->
<div class="modal hide yushou-modal" id="yushouTip">
	<div class="modal-body">
		<h2>请确认收货地址及发货时间</h2>
		<ul class="list">
			<li><strong>请确认配送地址，提交后不可变更：</strong>
				<p id="yushouAddr"></p> <span class="icon-common icon-1"></span>
			</li>
			<li><strong>支付后3至4周发货</strong>
				<p>如您随手机一起购买的商品，将与手机一起3至4周发货</p> <span class="icon-common icon-2"></span>
			</li>
			<li><strong>以支付价格为准</strong>
				<p>如预售产品发生调价，已支付订单价格将不受影响。</p> <span class="icon-common icon-3"></span>
			</li>
		</ul>
	</div>
	<div class="modal-footer">
		<p id="yushouOk" class="yushou-ok">
			<span class="icon-checkbox"><i class="iconfont"></i> </span>
			我已确认收货地址正确，不再变更
		</p>
		<span class="btn btn-lineDakeLight" data-dismiss="modal">返回修改地址</span>
		<span class="btn btn-primary" id="yushouCheckout">继续下单</span>

	</div>
</div>
<!--  预售提示 E-->
@stop
