XIAOMI.namespace("checkOut"),
XIAOMI.checkOut = {
    selfService: !1,
    couponPostFree: !1,
    couponPrice: 0,
    couponResult: {},
    giftPrice: 0,
    disFree: !1,
    init: function() {
        var a = this;
        a.selectAddr(),
        a.newAddr.init(),
        a.checkPayWay(),
        a.chooseInvoice(),
        a.addBuy(),
        a.useCoupon(),
        a.hideMoreAddr(),
        a.baoxian(),
        $("#J_addrListToggle").on("click",
        function() {
            return $(this).hasClass("on") ? (a.hideMoreAddr(), $(this).removeClass("on")) : ($("#checkoutAddrList").find("dl").show(), $(this).addClass("on")),
            !1
        }),
        $("#checkoutToPay").on("click",
        function() {
            var b = $("#checkoutAddrList").find(".selected").length;
            if (0 >= b) return alert("请选择地址"),
            $(window).scrollTop(0),
            !1;
            if ($("input[name='Checkout[invoice]']:checked").val() === checkoutConfig.invoice.company) if ($("input[name='Checkout[invoice_type]']:checked").val() === checkoutConfig.invoice.company) {
                var c = a.checkInvoice();
                if (!c) return ! 1
            } else if ($("input[name='Checkout[invoice_type]']:checked").val() !== checkoutConfig.invoice.personal) return alert("请选择发票抬头"),
            !1;
            if (checkoutConfig.hasGiftcard === !0) {
                var d = $("#checkoutAddrList").find(".selected");
                return $("#lipin-uname").html(d.attr("data-consignee")),
                $("#lipin-uphone").html(d.attr("data-tel")),
                $("#lipin-uaddr").html(d.attr("data-provincename") + " " + d.attr("data-cityname") + " " + d.attr("data-countyname") + d.attr("data-street")),
                $("#lipinTip").modal("show"),
                $("#lipinTip").find("#useGiftCard").on("click",
                function() {
                    checkoutConfig.hasPresales === !0 ? ($("#lipinTip").modal("hide"), $("#yushouTip").modal("show")) : $("#checkoutForm").submit()
                }),
                $("#lipinTip").find("#closeGiftCard").on("click",
                function() {
                    $("#lipinTip").modal("hide")
                }),
                !1
            }
            if (checkoutConfig.hasPresales === !0) {
                var e = $("#checkoutAddrList").find(".selected"),
                f = e.attr("data-provincename") + " " + e.attr("data-cityname") + " " + e.attr("data-countyname") + "<br>" + e.attr("data-street") + "<br>" + e.attr("data-consignee") + e.attr("data-tel");
                return $("#yushouAddr").html(f),
                $("#yushouTip").modal("show"),
                !1
            }
        }),
        $("#yushouOk").on("click",
        function() {
            $(this).toggleClass("selected")
        }),
        $("#yushouCheckout").on("click",
        function() {
            var a = $("#yushouOk").hasClass("selected");
            a ? $("#checkoutForm").submit() : alert("请确认收货地址正确，不再变更")
        }),
        $(document).on("click", ".J_optionList > .item",
        function() {
            $(this).addClass("selected").children("input").prop("checked", !0),
            $(this).siblings().removeClass("selected")
        }),
        a.chooseShipment(),
        a.checkShipment(),
        XIAOMI.app.placeholder($("#J_editAddrBox").find("input,textarea")),
        a.checkShowCounpon()
    },
    checkShowCounpon: function() {
        var a = checkoutConfig.showCouponBox > 0 ? checkoutConfig.showCouponBox - 1 : 0,
        b = $("#useCoupon").prop("checked");
        0 !== checkoutConfig.showCouponBox && b === !1 && ($("#checkoutCouponBox").trigger("click"), $("#couponTabNav").children(".nav-item").eq(a).trigger("click"))
    },
    selectAddr: function() {
        var a = this,
        b = $("#checkoutAddrList"),
        c = b.find("dl");
        c.on("click",
        function() {
            $(this).addClass("selected").siblings().removeClass("selected"),
            $(this).find(".addressId").prop("checked", !0),
            $(this).siblings().find(".addressId").prop("checked", !1),
            a.setAddrState(),
            a.setSubmitAddr(),
            a.getPayment()
        })
    },
    hideMoreAddr: function() {
        var a = $("#checkoutAddrList"),
        b = a.find("dl"),
        c = a.find(".selected"),
        d = Math.floor(a.width() / b.outerWidth()) - 1;
        c.index() >= d && (d -= 1),
        b.each(function() {
            var a = ($(this).attr("isnew"), $(this).index());
            d > a || a === c.index() ? $(this).show() : $(this).hide()
        })
    },
    getPayment: function(a) {
        var b = this,
        c = $("#checkoutAddrList").find(".selected").attr("data-county"),
        d = a || "1",
        e = $(".invoiceType:checked").val(),
        f = $("#CheckoutInvoiceTitle").find("input").val();
        return c ? void $.ajax({
            type: "POST",
            dataType: "json",
            data: "id=" + c + "&defaultPayment=" + d + "&invoice_type=" + e + "&invoice_title=" + f,
            url: "/buy/getRegionPayment/?" + Math.random(),
            success: function(a) {
                $("#checkoutPayment").html(a.checkoutPayment),
                $("#checkoutInvoice").html(a.checkoutInvoice),
                b.checkPayWay(),
                b.checkPayment(),
                b.chooseShipment(),
                b.checkShipment(),
                b.chooseInvoice()
            }
        }) : !1
    },
    checkPayment: function() {
        var a = this,
        b = $("input[name='Checkout[pay_id]']"),
        c = $("input[name='Checkout[pay_id]']:checked").val();
        if (b.length > 0) switch (c) {
        case "1":
            a.selfService = !1;
            break;
        case "6":
            a.selfService = !0
        }
    },

    checkPayWay: function() {
        var a = this;
        $("#checkoutPaymentList").on("click", "li",
        function() {
            var b = $(this).children('input[name="Checkout[pay_id]"]'),
            c = b.attr("data-type");
            return b.length <= 0 ? !1 : (a.selfService = "selfService" === c ? !0 : !1, void a.getPayment(b.val()))
        })
    },
    chooseShipment: function() {
        var a = this;
        $("#checkoutShipmentList").on("click", "li",
        function() {
            a.checkShipment()
        })
    },
    checkShipment: function() {
        var a = parseFloat($("input[name='Checkout[shipment_id]']:checked").attr("data-price"));
        0 === a ? this.disFree = !0 : checkoutConfig.hasBigTv && (checkoutConfig.postage = a),
        this.countTotalPrice()
    },
    chooseInvoice: function() {
        $(".J_optionInvoice").children(".item").on("click",
        function() {
            var a = $(this).children("input").val();
            $("#eInvoiceTip").hide(),
            a === checkoutConfig.invoice.company || a === checkoutConfig.invoice.personal ? ($("#checkoutInvoiceDetail").fadeIn(), $("#checkoutInvoiceElectronic").hide(), $(".invoiceType").prop("checked", !1), $(".J_invoiceType").children("li").eq(1).trigger("click")) : a === checkoutConfig.invoice.electronic ? ($("#checkoutInvoiceDetail").hide(), $("#checkoutInvoiceElectronic").fadeIn(), $(".invoiceType").prop("checked", !1), $("#electronicPersonal").prop("checked", !0)) : ($("#checkoutInvoiceDetail").hide(), $("#checkoutInvoiceElectronic").hide(), $(".invoiceType").prop("checked", !1), $("#noNeedInvoice").prop("checked", !0))
        }),
        $(".J_invoiceType").children("li").on("click",
        function() {
            var a = $(this).children("input").prop("checked", !0).val();
            a === checkoutConfig.invoice.company ? $("#CheckoutInvoiceTitle").fadeIn() : $("#CheckoutInvoiceTitle").hide().children("input").val(""),
            $(this).addClass("selected").siblings().removeClass("selected")
        })
    },
    checkInvoice: function() {
        var a = $("#CheckoutInvoiceTitle").children("input").val();
        return 0 === a.length ? ($("#CheckoutInvoiceTitle").children("input").focus().siblings(".J_tipMsg").html("单位名称不能为空").show(), !1) : a.length > 49 ? ($("#CheckoutInvoiceTitle").children("input").focus().siblings(".J_tipMsg").html("单位名称必须少于50个字").show(), !1) : ($("#CheckoutInvoiceTitle").children(".J_tipMsg").html("").hide(), !0)
    },
    useCoupon: function() {
        var a = this;
        $("#checkoutCouponBox").off().on("click",
        function() {
            var b = $(this).children("input").prop("checked");
            b === !1 ? ($("#couponBox").fadeIn(100), a.chooseCoupon(), a.checkCoupon()) : ($("#couponBox").hide(), $("#couponType").val(""), $("#couponValue").val(""), $("#useCoupon").prop("checked", !1), a.couponResult = {})
        }),
        $(".J_cancelCouponBtn").off().on("click",
        function(a) {
            a.preventDefault(),
            $("#couponBox").hide(),
            $("#couponCode").val(""),
            $("#useCoupon").prop("checked", !1),
            $("#couponType").val(""),
            $("#couponValue").val("")
        })
    },
    chooseCoupon: function() {
        $("#couponTabNav").children(".nav-item").off().on("click",
        function() {
            var a = $(this).index();
            if ($(this).addClass("current").siblings().removeClass("current"), $("#couponTabCon").children(".con-item").eq(a).show().siblings().hide(), $(this).hasClass("couponList")) {
                var b = $("#couponTabCon").find(".item-box").eq(a).find(".list"),
                c = b.find(".item").length,
                d = b.find(".item").outerHeight();
                c > 6 && b.css({
                    height: 8 * d,
                    overflow: "auto"
                })
            }
        }),
        $(".J_couponList").children("li").off().on("click",
        function() {
            $(this).children("input").prop("checked", !0),
            $(this).addClass("selected").siblings().removeClass("selected"),
            $("#selectCouponBtn").trigger("click")
        })
    },
    checkCoupon: function() {
        var a = this;
        $("#checkCouponBtn").off().on("click",
        function() {
            var b = $.trim($("#couponCode").val()),
            c = /^\d{16,}$/;
            return c.test(b) ? (a.getCouponInfo("yes", b), a.setMsg($("#checkCouponTip"))) : a.setMsg($("#checkCouponTip"), "优惠券码不正确"),
            !1
        }),
        $("#selectCouponBtn").off().on("click",
        function() {
            var b = $("input[name='Checkout[coupons][]']:checked").val();
            return a.getCouponInfo("no", b),
            !1
        })
    },
    getCouponInfo: function(a, b) {
        var c = this;
        $.ajax({
            type: "POST",
            url: "/misc/validatefcode",
            data: "cardtype=" + a + "&value=" + b,
            dataType: "json",
            success: function(d) {
                var e = $("yes" === a ? "#checkCouponTip": "#selectCouponTip");
                $("#couponType").val(a),
                $("#couponValue").val(b),
                c.couponResult.t = a,
                c.couponResult.v = b,
                -1 === d.code ? c.setMsg(e, d.message) : 1 === d.code && (c.setMsg(e), c.dealWithCouponInfo(d.message), $("#checkoutCouponBox").addClass("selected").children("input").prop("checked", !0))
            }
        })
    },
    dealWithCouponInfo: function(a) {
        var b = this;
        if (a) {
            $("#couponBox").hide();
            var c = parseFloat(a.postFree),
            d = checkoutConfig.activityDiscountMoney;
            b.couponPrice = parseFloat(a.replaceMoney),
            b.couponResult.p = a.present,
            d += b.couponPrice,
            b.couponPrice > 0 && $("#couponDesc").html(d + "元"),
            1 === c && (b.couponPostFree = !0),
            1 !== c && (b.couponPostFree = !1),
            b.couponResult.n = $(".J_couponList").children(".selected").length > 0 ? $(".J_couponList").children(".selected").children("p").html() : "",
            b.setCouponResult(),
            b.countTotalPrice()
        } else b.restoreCoupon()
    },
    setCouponResult: function() {
        var a = this;
        0 !== a.couponPrice || a.couponPostFree || "" === a.couponResult.p ? $("#couponResult").html("：您已使用" + a.couponResult.n + "<span>-" + a.couponPrice + "元</span><a href='#' id='changCoupon'>[变更]</a>").fadeIn(100) : $("#couponResult").html("：您已获得：" + a.couponResult.p + "<a href='#' id='changCoupon'>[变更]</a>").fadeIn(100);
        var b = a.couponPrice.toFixed(2);
        $("#couponDesc").html(b + "元"),
        $("#useCoupon").prop("checked", !0),
        $("#changCoupon").on("click",
        function() {
            return a.restoreCoupon(),
            !1
        })
    },
    restoreCoupon: function() {
        $("#couponBox").show(),
        $("#useCoupon").prop("checked", !1).parent().removeClass("selected"),
        $("#couponDesc").html(checkoutConfig.activityDiscountMoney + "元"),
        this.couponPrice = 0,
        this.couponPostFree = !1,
        this.couponResult = {},
        $("#couponType").val(""),
        $("#couponValue").val(""),
        this.countTotalPrice(),
        $("#couponResult").html("").hide()
    },
    addBuy: function() {
        var a = this;
        $(".J_addBuy").on("click",
        function() {
            if ($(this).hasClass("disabled")) return ! 1;
            var b = $(this).children("input"),
            c = b.prop("checked"),
            d = b.attr("data-goodsid"),
            e = b.attr("data-itemid"),
            f = (parseFloat(b.attr("data-price")), b.attr("data-isbatch")),
            g = b.attr("data-actid");
            if (c !== !0) {
                if ("true" === f) return a.chooseGoods(g),
                !1;
                a.addCart(d, g)
            } else a.delProduct(e);
            $(this).addClass("disabled")
        })
    },
    chooseGoods: function(a) {
        var b = this,
        c = $("#J_choosePro-" + a),
        d = c.find(".J_carouselList"),
        e = c.find(".J_chooseProBtn"),
        f = d.find("li").length;
        3 > f ? c.addClass("modal-choose-pro-2") : 4 === f && c.addClass("modal-choose-pro-4"),
        b.showChoosePro(c),
        d.find("li").click(function() {
            $(this).addClass("selected").siblings().removeClass("selected"),
            $(this).find("input").prop("checked", !0);
            $(this).find("input").val();
            e.removeClass("btn-disabled").addClass("btn-primary")
        }),
        e.on("click",
        function() {
            if (!$(this).hasClass("btn-disabled")) {
                var e = d.find(".selected").find("input").val();
                price = d.find(".selected").find("input").attr("data-price"),
                b.addCart(e, a),
                $("#Gift" + a).prop("checked", !0),
                c.modal("hide")
            }
            return ! 1
        })
    },
    showChoosePro: function(a) {
        a && a.on("shown.bs.modal",
        function() {
            XIAOMI.app.carousel.init($(this), {
                autoPlay: !1
            })
        }).modal({
            backdrop: "static",
            show: !0
        }).on("hide.bs.modal",
        function() {
            $(this).find(".page-btn-prev").removeClass("page-btn-prev-disabled").siblings(".page-btn-next").removeClass("page-btn-next-disabled")
        })
    },

    addCart: function(a, b) {
        var c = this;
        XIAOMI.app.addShopCart(a,
        function(a) {
            1 === a.code ? c.getProList() : (alert(a.message), $("#Gift" + b).attr("checked", !1).parent().removeClass("selected"))
        })
    },
    delProduct: function(a) {
        var b = this;
        $.ajax({
            type: "POST",
            url: "/cart/delete/" + a + "?_v=" + Math.random(),
            dataType: "json",
            success: function(a) {
                1 === a.code && b.getProList()
            }
        })
    },
    getProList: function() {
        var a = this,
        b = $("input[name='Checkout[pay_id]']:checked").val();
        $.ajax({
            type: "GET",
            url: "/buy/checkoutajax?pay_id=" + b + "&_v=" + Math.random(),
            dataType: "json",
            success: function(b) {
                a.resetProList(b.msg)
            }
        })
    },
    resetProList: function(a) {
        $("#checkoutGoodsList").html(a); {
            var b = this,
            c = $("#couponType").val();
            $("#couponValue").val()
        }
        b.useCoupon(),
        ("yes" === c || "no" === c) && ($("#useCoupon").prop("checked", !0), $("#checkoutCouponBox").addClass("selected"), $("#couponBox").hide(), b.setCouponResult()),
        b.addBuy(),
        b.baoxian(),
        b.chooseCoupon(),
        b.checkCoupon(),
        b.checkPayment(),
        b.countTotalPrice(),
        b.checkShowCounpon()
    },
    countTotalPrice: function() {
        var a = checkoutConfig.totalPrice,
        b = checkoutConfig.postage;
        a = a + this.giftPrice - this.couponPrice,
        checkoutConfig.hasBigTv || (this.disFree = a < checkoutConfig.bcPrice ? !1 : !0),
        (this.couponPostFree || checkoutConfig.postFree || this.disFree || this.selfService) && (b = 0),
        a += b,
        $("#totalPrice").html(a.toFixed(2)),
        $("#postageDesc").html(b + "元")
    },
    setMsg: function(a, b) {
        b ? a.html(b).show() : a.html("").hide()
    },
    setAddrState: function(a) {
        if ("1" === a) $("#addrState").val(a);
        else {
            var b = $("#checkoutAddrList").find(".selected"),
            c = b.attr("data-isnew");
            $("#addrState").val("true" === c ? "1": "0")
        }
    },
    setSubmitAddr: function() {
        var a = $("#checkoutAddrList").find(".selected"),
        b = "<p>" + a.attr("data-provincename") + " " + a.attr("data-cityname") + " " + a.attr("data-countyname") + " " + a.attr("data-street") + " (" + a.attr("data-zipcode") + ")</p><p>" + a.attr("data-consignee") + " " + a.attr("data-tel") + "</p>";
        $("#submitAddress").html(b).css({
            "margin-bottom": "20px"
        })
    },
    baoxian: function() {
        var a, b, c, d, e, f = this;
        $(".J_buyBaoxian").on("click",
        function() {
            return c = $(this).hasClass("selected"),
            a = $(this).find("input").attr("data-goodsid") + "?parent_itemId=" + $(this).find("input").attr("data-parent_itemid"),
            d = $(this).find("input").attr("data-itemid"),
            e = $(this).find("input").attr("data-count"),
            $(".J_toBuyBaoxian").html("确认并购买服务" + e + "份"),
            c ? (f.delProduct(d), $(this).removeClass("selected").find("input").prop("checked", !1), $(".J_baoxian_agree").find(".icon-checkbox").removeClass("icon-checkbox-checked"), !1) : void $("#baoxian").modal({
                backdrop: "static",
                show: !0
            }).on("hide.bs.modal",
            function() {
                b = !1,
                $(".J_baoxian_agree").children(".iconfont").removeClass("icon-checkbox-checked")
            })
        }),
        $(".J_Baoxian_Service_show").off().on("click",
        function() {
            $("#baoxian").find(".con-1").hide().siblings(".con-2").show()
        }),
        $(".J_Baoxian_Service_hide").off().on("click",
        function() {
            $("#baoxian").find(".con-1").show().siblings(".con-2").hide()
        }),
        $(".J_baoxian_agree").off().on("click",
        function() {
            $(this).children(".iconfont").toggleClass("icon-checkbox-checked"),
            b = b === !0 ? !1 : !0
        }),
        $(".J_toBuyBaoxian").off().on("click",
        function() {
            b === !0 ? (XIAOMI.app.addShopCart(a,
            function(a) {
                1 === a.code ? (f.getProList(), $(".J_buyBaoxian").addClass("selected").find("input").prop("checked", !0)) : alert(a.message)
            }), $("#baoxian").modal("hide")) : alert("请先阅读并同意《小米手机意外保障服务》！")
        })
    }
},
XIAOMI.namespace("checkOut.newAddr"),
XIAOMI.checkOut.newAddr = {
    newProvince: null,
    newCity: null,
    newCounty: null,
    newZipcode: null,
    init: function() {
        var a = this;
        XIAOMI.app.getRegions.getData(1, "Provinces"),
        $("#J_useNewAddr").on("click",
        function() {
            var b = $(this).attr("data-state");
            return $(this).attr("data-url") ? (location.href = $(this).attr("data-url"), !1) : ("off" === b ? (XIAOMI.app.placeholder($("#J_editAddrBox").find("input,textarea")), a.Show($(this)), XIAOMI.checkOut.setAddrState("1")) : "on" === b && (a.Close(), a.resetData(), XIAOMI.checkOut.setAddrState()), !1)
        }),
        $("#J_editAddrOk").click(function() {
            return a.validation(),
            !1
        }),
        $("#J_editAddrCancel").click(function() {
            return a.Close(),
            a.resetData(),
            XIAOMI.checkOut.setAddrState(),
            !1
        }),
        $("#Provinces").change(function() {
            var b = $(this).val();
            "0" !== b ? (XIAOMI.app.getRegions.getData(b, "Citys"), a.newProvince = $(this).find("option:selected").html()) : (a.newProvince = null, a.newCity = null, a.newCounty = null),
            $("#Citys").prop("disabled", !0).find("option:gt(0)").remove(),
            $("#Countys").prop("disabled", !0).find("option:gt(0)").remove()
        }),
        $("#Citys").change(function() {
            var b = $(this).val();
            "0" !== b ? (XIAOMI.app.getRegions.getData(b, "Countys"), a.newCity = $(this).find("option:selected").html()) : (a.newCity = null, a.newCounty = null),
            $("#Countys").prop("disabled", !0).find("option:gt(0)").remove()
        }),
        $("#Countys").change(function() {
            var b = $(this).val();
            "0" !== b ? (a.newCounty = $(this).find("option:selected").html(), a.newZipcode = $(this).find("option:selected").attr("zipcode"), $("#zipcodeTip").html("邮编为：" + a.newZipcode)) : (a.newCounty = null, a.newZipcode = null, $("#zipcodeTip").html(""))
        }),
        a.toEdit()
    },
    Show: function(a) {
        if ("object" != typeof a) return ! 1;
        var b = a.offset().left,
        c = a.offset().top,
        d = a.outerWidth() - 2;
        $("#J_editAddrBox").css({
            width: d,
            top: c,
            left: b
        }).show();
        var e = $(document).width(),
        f = $(document).height();
        $("#J_editAddrBackdrop").css({
            width: e,
            height: f
        }).show()
    },
    Close: function() {
        $("#J_editAddrBox").hide(),
        $("#J_editAddrBackdrop").hide(),
        $("html,body").scrollTop($("#checkoutAddrList").find(".selected").length > 0 ? $("#checkoutAddrList").find(".selected").offset().top: 0)
    },
    setMsg: function(a, b) {
        a && b ? a.siblings(".tipMsg").html(b).show() : a.siblings(".tipMsg").html("").hide()
    },
    validation: function() {
        var a = this,
        b = $("#Consignee"),
        c = $("#Provinces"),
        d = $("#Citys"),
        e = $("#Countys"),
        f = $("#Street"),
        g = $("#Zipcode"),
        h = $("#Telephone"),
        i = $("#Tag"),
        j = /^[1-9]+\d*$/,
        k = /^\d{6}$/,
        l = /^1[0-9]{10}$/,
        m = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/,
        n = /^\d+$/,
        o = /^[0-9a-zA-Z]+$/,
        p = /^[a-zA-Z\u4e00-\u9fa5]+$/,
        q = {},
        r = $("#addrState").val(),
        s = $.trim(b.val()),
        t = b.attr("placeholder"),
        u = !1;
        if (s === t && (s = ""), !(a.strLen(s) >= 4)) return b.focus(),
        a.setMsg(b, "收货人姓名 太短 (最小值为 2 个中文字)"),
        !1;
        if (!p.test(s)) return b.focus(),
        a.setMsg(b, "收货人姓名不正确（只能是英文、汉字）"),
        !1;
        a.setMsg(b, ""),
        q.consignee = s,
        u = !0;
        var v = $.trim(h.val()),
        w = !1;
        if (!l.test(v)) return h.focus(),
        a.setMsg(h, "请填写11位手机号"),
        !1;
        a.setMsg(h, ""),
        q.tel = v,
        w = !0;
        var x = c.val(),
        y = d.val(),
        z = e.val(),
        A = !1;
        if (! (j.test(x) && j.test(y) && j.test(z))) return a.setMsg(c, "收货地址不正确"),
        !1;
        a.setMsg(c, ""),
        q.province = x,
        q.city = y,
        q.county = z,
        q.provinceName = a.newProvince,
        q.cityName = a.newCity,
        q.countyName = a.newCounty,
        A = !0;
        var B = $.trim(f.val()).replace(/</g, "").replace(/>/g, "").replace(/\//g, "").replace(/\\/g, ""),
        C = f.attr("placeholder"),
        D = !1;
        if (B === C && (B = ""), !(B.length >= 5 && B.length <= 32)) return f.focus(),
        a.setMsg(f, "详细地址长度不对，最小为 5 个字，最大32个字"),
        !1;
        if (m.test(B) || n.test(B) || o.test(B)) return f.focus(),
        a.setMsg(f, "详细地址不正确"),
        !1;
        a.setMsg(f, ""),
        q.street = B,
        D = !0;
        var E = $.trim(g.val()),
        F = !1;
        if (!k.test(E)) return g.focus(),
        a.setMsg(g, "邮编是6位数字"),
        !1;
        a.setMsg(g, ""),
        q.zipcode = E,
        F = !0;
        var G = $.trim(i.val()),
        H = i.attr("placeholder"),
        I = !1;
        if (G === H && (G = ""), G.length > 5) return i.focus(),
        a.setMsg(i, "地址标签最长5个字"),
        !1;
        if (q.tag = G, I = !0, u && A && D && F && w && I) if ("1" === r) {
            var J = $("#checkoutAddrList").find(".selected").attr("data-isnew");
            "true" === J && $("#checkoutAddrList").find(".selected").remove(),
            a.createAddr(q),
            a.Close(),
            a.resetData()
        } else a.saveAddr(q)
    },
    createAddr: function(a) {
        var b = doT.template($("#newAddrTemplate").html());
        $("#checkoutAddrList").find(".item").removeClass("selected"),
        $("#checkoutAddrList").find(".item").eq(0).before(b(a)),
        $("#J_addrListToggle").hasClass("on") || XIAOMI.checkOut.hideMoreAddr(),
        XIAOMI.checkOut.selectAddr(),
        XIAOMI.checkOut.setSubmitAddr(),
        XIAOMI.checkOut.getPayment(a.county),
        this.toEdit(),
        this.setNew(a)
    },
    toEdit: function() {
        var a = this;
        $(".J_editAddr").on("click",
        function() {
            if ($(this).attr("data-url")) return location.href = XIAOMI.GLOBAL_CONFIG.orderSite + $(this).attr("data-url"),
            !1;
            var b = $(this).parent().parent(),
            c = (b.attr("data-isnew"), b.attr("data-consignee")),
            d = b.attr("data-province"),
            e = b.attr("data-provincename"),
            f = b.attr("data-city"),
            g = b.attr("data-cityname"),
            h = b.attr("data-county"),
            i = b.attr("data-countyname"),
            j = b.attr("data-street"),
            k = b.attr("data-zipcode"),
            l = b.attr("data-tel"),
            m = b.attr("data-tag");
            return $("#Consignee").val(c),
            $("#Street").val(j),
            $("#telModifyTip").show().find("em").html(l),
            $("#Tag").val(m),
            $("#Zipcode").val(k),
            $("#Provinces").find("option[value='" + d + "']").prop("selected", !0),
            XIAOMI.app.getRegions.getData(d, "Citys", f),
            XIAOMI.app.getRegions.getData(f, "Countys", h),
            $("#Citys").prop("disabled", !1),
            $("#County").prop("disabled", !1),
            a.newProvince = e,
            a.newCity = g,
            a.newCounty = i,
            a.Show(b),
            XIAOMI.checkOut.setAddrState(),
            !1
        })
    },
    editAddr: function(a) {
        var b = $("#checkoutAddrList").find(".selected");
        b.attr("data-consignee", a.consignee),
        b.attr("data-province", a.province),
        b.attr("data-provincename", a.provinceName),
        b.attr("data-city", a.city),
        b.attr("data-cityname", a.cityName),
        b.attr("data-county", a.county),
        b.attr("data-countyname", a.countyName),
        b.attr("data-street", a.street),
        b.attr("data-zipcode", a.zipcode),
        b.attr("data-tel", a.tel),
        b.attr("data-tag", a.tag),
        b.attr("data-isedit", "true"),
        b.find(".itemConsignee").html(a.consignee),
        b.find(".itemTel").html(a.tel),
        b.find(".itemTag").length > 0 && a.tag ? b.find(".itemTag").html(a.tag) : a.tag && b.find("dt").append('<span class="itemTag tag">' + a.tag + "</span>"),
        b.find(".itemRegion").html(a.provinceName + " " + a.cityName + " " + a.countyName),
        b.find(".itemStreet").html(a.street + "(" + a.zipcode + ")"),
        XIAOMI.checkOut.setSubmitAddr()
    },
    setNew: function(a) {
        $("#newConsignee").val(a.consignee),
        $("#newProvince").val(a.province),
        $("#newCity").val(a.city),
        $("#newCounty").val(a.county),
        $("#newStreet").val(a.street),
        $("#newZipcode").val(a.zipcode),
        $("#newTel").val(a.tel),
        $("#newTag").val(a.tag)
    },
    saveAddr: function(a) {
        var b = this,
        c = $("#checkoutAddrList").find(".selected").find(".addressId").val(),
        d = "newAddress[address_id]=" + c + "&newAddress[consignee]=" + a.consignee + "&newAddress[province_id]=" + a.province + "&newAddress[city_id]=" + a.city + "&newAddress[district_id]=" + a.county + "&newAddress[address]=" + a.street + "&newAddress[zipcode]=" + a.zipcode + "&newAddress[tel]=" + a.tel + "&newAddress[update_tel]=yes&newAddress[tag_name]=" + a.tag;
        $.ajax({
            type: "POST",
            url: "/buy/saveAddress",
            data: d,
            dataType: "json",
            success: function(c) {
                1 === c.code ? (b.editAddr(a), XIAOMI.checkOut.getPayment(a.county), b.Close(), b.resetData()) : alert(c.msg)
            }
        })
    },
    strLen: function(a) {
        return a.replace(/[^\x00-\xff]/g, "**").length
    },
    resetData: function() {
        $("#Consignee").val(""),
        $("#Street").val(""),
        $("#Telephone").val(""),
        $("#Zipcode").val(""),
        $("#Tag").val(""),
        $("#Provinces").find("option").eq(0).prop("selected", !0),
        $("#Citys").prop("disabled", !0).find("option:gt(0)").remove(),
        $("#Countys").prop("disabled", !0).find("option:gt(0)").remove(),
        this.newProvince = null,
        this.newCity = null,
        this.newCounty = null,
        this.newZipcode = null,
        $("#zipcodeTip").html(""),
        $(".tipMsg").html("").hide(),
        $("#telModifyTip").hide()
    }
},
$(function() {
    XIAOMI.checkOut.init()
});