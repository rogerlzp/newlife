@section('content')
<div class="container">
	<div class="checkout-box">
		<form id="checkoutForm"
			action="http://order.mi.com/buy/submit?r=165155486_t1412485408"
			method="post">
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
							<div class="item use-new-addr" id="J_useNewAddr" data-state="off">
								<span class="iconfont icon-add">+</span> 使用新地址
							</div>
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
						<div class="xm-edit-addr-box" id="J_editAddrBox">
							<div class="bd">
								<div class="item">
									<label>收货人姓名<span>*</span>
									</label> <input type="text" name="userAddress[consignee]"
										id="Consignee" class="input" placeholder="收货人姓名"
										maxlength="15" autocomplete="off">
									<p class="tip-msg tipMsg"></p>
								</div>
								<div class="item">
									<label>联系电话<span>*</span>
									</label> <input type="text" name="userAddress[tel]"
										class="input" id="Telephone" placeholder="11位手机号"
										autocomplete="off">
									<p class="tel-modify-tip" id="telModifyTip">
										如果不修改手机号，请重新输入原收货手机号 <em></em> 以便确认
									</p>
									<p class="tip-msg tipMsg"></p>
								</div>
								<div class="item">
									<label>地址<span>*</span>
									</label> <select name="userAddress[province]" id="Provinces"
										class="select-1"><option value="0">省份/自治区</option>
										<option zipcode="0" value="2">北京</option>
										<option zipcode="0" value="3">天津</option>
										<option zipcode="0" value="4">河北</option>
										<option zipcode="0" value="5">山西</option>
										<option zipcode="0" value="6">内蒙古</option>
										<option zipcode="0" value="7">辽宁</option>
										<option zipcode="0" value="8">吉林</option>
										<option zipcode="0" value="9">黑龙江</option>
										<option zipcode="0" value="10">上海</option>
										<option zipcode="0" value="11">江苏</option>
										<option zipcode="0" value="12">浙江</option>
										<option zipcode="0" value="13">安徽</option>
										<option zipcode="0" value="14">福建</option>
										<option zipcode="0" value="15">江西</option>
										<option zipcode="0" value="16">山东</option>
										<option zipcode="0" value="17">河南</option>
										<option zipcode="0" value="18">湖北</option>
										<option zipcode="0" value="19">湖南</option>
										<option zipcode="0" value="20">广东</option>
										<option zipcode="0" value="21">广西</option>
										<option zipcode="0" value="22">海南</option>
										<option zipcode="0" value="23">重庆</option>
										<option zipcode="0" value="24">四川</option>
										<option zipcode="0" value="25">贵州</option>
										<option zipcode="0" value="26">云南</option>
										<option zipcode="0" value="27">西藏</option>
										<option zipcode="0" value="28">陕西</option>
										<option zipcode="0" value="29">甘肃</option>
										<option zipcode="0" value="30">青海</option>
										<option zipcode="0" value="31">宁夏</option>
										<option zipcode="0" value="32">新疆</option>
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
								<div class="item">
									<label>邮政编码<span>*</span>
									</label> <input type="text" name="userAddress[zipcode]"
										id="Zipcode" class="input" placeholder="邮政编码"
										autocomplete="off">
									<p class="zipcode-tip" id="zipcodeTip"></p>
									<p class="tip-msg tipMsg"></p>
								</div>
								<div class="item">
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
									id="J_editAddrOk">确认收货地址</button>
							</div>
						</div>
						<div class="xm-edit-addr-backdrop" id="J_editAddrBackdrop"></div>
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
								<li class="item selected"><input type="radio"
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
								<li class="item selected"><input type="radio" data-price="0"
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
					</div>
					<div class="box-bd">
						<ul class="checkout-option-list clearfix J_optionList">
							<li class="item selected"><input type="radio" checked="checked"
								name="Checkout[best_time]" value="1">
								<p>
									不限送货时间<span>周一至周日</span>
								</p></li>
							<li class="item "><input type="radio" name="Checkout[best_time]"
								value="2">
								<p>
									工作日送货<span>周一至周五</span>
								</p></li>
							<li class="item "><input type="radio" name="Checkout[best_time]"
								value="3">
								<p>
									双休日、假日送货<span>周六至周日</span>
								</p></li>
						</ul>
					</div>
				</div>
				<!-- 送货时间 END-->
				<!-- 发票信息 -->
				<div id="checkoutInvoice">
					<div class="xm-box">
						<div class="box-hd">
							<h2 class="title">发票信息</h2>
						</div>
						<div class="box-bd">
							<ul
								class="checkout-option-list checkout-option-invoice clearfix J_optionList J_optionInvoice">
								<li class="hide">电子个人发票4</li>
								<li class="item selected">
									<!--<label><input type="radio"  class="needInvoice" value="0" name="Checkout[invoice]">不开发票</label>-->
									<input type="radio" checked="checked" value="4"
									name="Checkout[invoice]">
									<p>电子发票</p>
								</li>
								<li class="item "><input type="radio" value="1"
									name="Checkout[invoice]">
									<p>普通发票</p>
								</li>
							</ul>
							<p id="eInvoiceTip" class="e-invoice-tip ">
								电子发票是税务局认可的有效凭证，可作为售后维权凭据。开票后不可更换纸质发票，如需报销请选择普通发票。<a
									href="http://bbs.xiaomi.cn/thread-9285999-1-1.html"
									target="_blank">什么是电子发票？</a>
							</p>
							<div class="invoice-info nvoice-info-1"
								id="checkoutInvoiceElectronic" style="display: none;">

								<p class="tip">电子发票目前仅对个人用户开具，不可用于单位报销</p>
								<p>发票内容：购买商品明细</p>
								<p>发票抬头：个人</p>
								<p>
									<span class="hide"><input type="radio" value="4"
										name="Checkout[invoice_type]" checked="checked"
										id="electronicPersonal" class="invoiceType"> </span>
								</p>
								<dl>
									<dt>什么是电子发票?</dt>
									<dd>· 电子发票是纸质发票的映像，是税务局认可的有效凭证，与传统纸质发票具有同等法律效力，可作为售后维权凭据。</dd>
									<dd>· 开具电子服务于个人，开票后不可更换纸质发票，不可用于单位报销。</dd>
									<dd>
										· 您在订单详情的"发票信息"栏可查看、下载您的电子发票。<a
											href="http://bbs.xiaomi.cn/thread-9285999-1-1.html"
											target="_blank">什么是电子发票？</a>
									</dd>
								</dl>
								<p></p>
							</div>
							<div class="invoice-info invoice-info-2"
								id="checkoutInvoiceDetail" style="display: none;">
								<p>发票内容：购买商品明细</p>
								<p>发票抬头：请确认单位名称正确,以免因名称错误耽搁您的报销。注：合约机话费仅能开个人发票</p>
								<ul class="type clearfix J_invoiceType">
									<li class="hide"><input type="radio" value="0"
										name="Checkout[invoice_type]" id="noNeedInvoice">
									</li>
									<li class=""><input class="invoiceType" type="radio"
										id="commonPersonal" name="Checkout[invoice_type]" value="1">
										个人</li>
									<li class=""><input class="invoiceType" type="radio"
										name="Checkout[invoice_type]" value="2"> 单位</li>
								</ul>
								<div id="CheckoutInvoiceTitle" class=" hide  invoice-title">
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
													MI3配件优惠组合 实用套装 </a>
											</div>
										</div>

										<div class="col col-2">190元</div>
										<div class="col col-3">1</div>
										<div class="col col-4">190元</div>
									</div>
								</dd>
								<dd class="item clearfix">
									<div class="item-row">
										<div class="col col-1">
											<div class="g-pic">
												<img src="./填写订单信息_files/T13JCTByCv1RXrhCrK.jpg"
													srcset="http://img08.mifile.cn/v1/MI_18455B3E4DA706226CF7535A58E875F0267/T13JCTByCv1RXrhCrK.jpg?width=80&amp;height=80 2x"
													width="40" height="40">
											</div>
											<div class="g-info">
												<a href="http://www.mi.com/item/1134900392" target="_blank">
													IVS吸盘音箱 橙色 </a>
											</div>
										</div>

										<div class="col col-2">89元</div>
										<div class="col col-3">1</div>
										<div class="col col-4">89元</div>
									</div>
								</dd>
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
										<li>商品件数：<span>2件</span>
										</li>
										<li>金额合计：<span>279元</span>
										</li>
										<li>活动优惠：<span>-0元</span> <script type="text/javascript">
                                            checkoutConfig.activityDiscountMoney=0;
                                            checkoutConfig.totalPrice=279.00;
                                        </script>
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
