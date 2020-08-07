<?php
$array = [
	'order_no' => '1571911806820show', //订单号
	'order_source' => '1', //订单来源(1alipay 2wechat)
	'order_type' => '1', //订单类型(1挂号,2诊间,3药品支付)
	'type' => '1', //订单支付类型(1支付 2支付失败 3退款)
	'amount' => '1000', //订单总金额(单位分)
	'gov_amount' => '300', //医保统筹金额(单位分)
	'account_amount' => '100', //医保个账支付金额(单位分)
	'self_amount' => '600', //自费金额(单位分)
	'other_amout' => '0', //医保其它支出(单位分)
	'org_code' => '01002', //医疗机构编码
	'org_name' => '淄博第一药店', //医疗机构名称
	'org_type' => '3', //医疗机构类型(1医院 2社区康复中心 3药店)
	'client_id' => '001', //终端编号(pos 机或其它终端编号 )
	'scene' => '2', //扫码场景(1条码 2二维码)
	'auth_code' => '9991234567899876543201350000', //授权码(医保局二维码值)
	'gmt_source' => '2019-10-21 16:49:00', //业务发生时间(支付的是支付时间 退款的是退款时间)
	'status_reason' => '1', //支付失败原因(1卡信息不存在 2账户余额不足 3卡状态异常 4未参保或参保状态异常 5账户状态异常 6医保结算异常 7其他异常)
	'bz' => '', //自预留字段
	'remark' => '', //自预留字段
];

echo json_encode($array, 320);


/*{"id":1,"order_pay_type":1,"out_biz_no":"1571911806820show","out_biz_type":"1","amount":1000,"real_amount":"400","status":"SUCCESS_FINISHED","gmt_source":"2019-10-21 16:49:00","gmt_refund":"","scene":"qr_code","auth_code":"9991234567899876543201350000","gov_amount":300,"account_amountount":100,"self_amount":600,"other_amout":0,"seller_org_no":"01002","seller_org_name":"淄博第一药店","place":"DRUGSTORE","status_reason_code":"1","create_time":1571967229,"update_time":0,"delete_time":0,"send_status":2}*/