@section('content') 
@foreach($cartitems as $cartitem)
<p>{{$cartitem->id}} {{$cartitem->price}}</p>

@endforeach


<div class="container">
	<!--S cart-->
	<div id="shopCartBox">
		<div class="shop-cart-box">
			<div class="shop-cart-box-hd">
				<h2 class="title">我的购物车</h2>
				<p class="tip">在线支付全场满¥150免运费</p>
				<!-- <a href="/cart/empty" data-msg="确定清空购物车吗?"  class="clear-shop-cart" id="clearShopCart"><i class="icon-common icon-common-del"></i>清空购物车</a> -->
			</div>
			<div class="shop-cart-box-bd">
				<!--  购物车商品列表 -->
				<dl class="shop-cart-goods">
					<dt class="clearfix">
						<span class="col col-1">商品</span> <span class="col col-2">单价</span>
						<span class="col col-3">数量</span> <span class="col col-4">小计</span>
						<span class="col col-5">操作</span>
					</dt>
					@foreach($cartitems as $cartitem)
					<dd class="item  clearfix " data-cos="0"
						data-commodityid="{{$cartitem->product->id}}">
						<div class="item-row">
							<div class="col col-1">
								<div class="g-pic">
									<a href="product/{{$cartitem->product->id}}" target="_blank"> <img
										src="{{ URL::asset('img/temp/'.$cartitem->product->image->image_path)}}"
										width="120" height="120">
									</a>
								</div>
								<div class="g-info">
									<div class="g-name">

										<a href="product/{{$cartitem->product->id}}" target="_blank">
											{{$cartitem->product->name}} </a>
									</div>
								</div>

								<div class="g-detail clearfix">
									{{$cartitem->product->short_description}}</div>

							</div>

							<div class="col col-2">{{$cartitem->price}}</div>
						</div>

						<div class="col col-3">
							<div class="change-goods-num clearfix J_changeGoodsNum">
								<a href="javascript:void(0)" class="J_minus"> <i
									class="iconfont">-</i>
								</a> <input tyep="text" name="Cart[2135000520_0_buy]" value="1"
									data-num="1" data-buylimit="3" autocomplete="off"
									class="goods-num J_goodsNum"> <a href="javascript:void(0)"
									class="J_plus"> <i class="iconfont">+</i>
								</a>
							</div>

						</div>
						<div class="col col-4">
							<em>{{$cartitem->price * $cartitem->quality }}</em>
							<p></p>
						</div>

						<div class="col col-5">
							<a id="2135000520_0_buy" data-msg="确定删除吗？"
								href="/cart/delete/id/2135000520_0_buy" title="删除"
								class="del J_delGoods"><i class="iconfont">x</i> </a>
						</div>
					</dd>


					@endforeach



				</dl>
			</div>
		</div>
	</div>
	       <div class="shop-cart-total">
                        <p class="total-price">商品总计：<span><strong>1,778.00</strong>元</span></p>
        </div>
        <div class="shop-cart-action clearfix">
            <a href="{{URL::route('checkout.index')}}" class="btn btn-primary btn-next" data-needlogin="true" data-rel="/buy/checkout" id="toCheckBtn">去结账</a>
            <a href="http://www.mi.com/accessories" class="btn btn-lineDakeLight btn-back">继续购物</a>
            <div class="tips">
                                            </div>
        </div>
        
       
</div>



@stop



