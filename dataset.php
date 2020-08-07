<?php

$post = '{"bizid":"1001","cmdid":"orderprepare","nonce":"ms1lohhdg8o5go8hll1l4jpapcgmofdf","req":{"order_no":"I20060944489734781","user_id":"ohNH9stU8ElHWr8b8LjLAgbquNV0","user_card_no":"220104198912037315","user_name":"石鑫","out_org_no":"BC01","out_trade_no":"3859c6628aa438f7230863691e4e1f6f","out_serial_no":"H2020060983744393135266","request_content":"{\"request_source\":\"hospital\",\"is_self\":\"1\",\"name\":\"\\u8ba2\\u5355\\u660e\\u7ec6\",\"order\":[{\"id\":428,\"medical_records_id\":207,\"hospital_id\":1,\"user_id\":1520,\"patient_card\":\"191025502\",\"serial_no\":\"4898740\",\"serial_number\":\"0\",\"drug_detailed_code\":\"02020003ZS0_1\",\"item_name\":\"\\u4e19\\u6cca\\u915a\\u4e73\\u72b6\\u6ce8\\u5c04\\u6db2\",\"item_code\":\"02020003ZS0_1\",\"quantity\":1,\"actual_price\":\"14.30\",\"item_total_amount\":\"14.30\",\"order_dept_id\":7,\"order_dept_code\":\"010502\",\"order_dept_name\":\"\\u6d88\\u5316\\u5185\\u79d1\\u95e8\\u8bca\",\"order_doctor_code\":\"22080001051\",\"order_doctor_name\":\"\",\"acceptance_dept_id\":0,\"acceptance_dept_code\":\"050401\",\"acceptance_dept_name\":\"\\u95e8\\u8bca\\u836f\\u623f\",\"acceptance_doctor_code\":\"22080001051\",\"acceptance_doctor_name\":\"\\u6768\\u6ce2\",\"bill_create_time\":\"2020-06-09 14:22:15\",\"operator_name\":\"\\u8bca\\u95f4\\u652f\\u4ed8\",\"operator_time\":\"2020-06-09 14:22:15\",\"remark\":\"\\u95e8\\u8bca\\u8d39\\u7528\\u4e0a\\u4f20\",\"markup_amount\":\"0.00\",\"medicine_usage_mode\":null,\"specifications\":\"20ml:0.2g\",\"dosage_name\":\"\\u6ce8\\u5c04\\u5242\",\"mark\":\"1\",\"newborn_mark\":\"0\",\"create_time\":1591683744,\"update_time\":1591683744,\"delete_time\":0},{\"id\":429,\"medical_records_id\":207,\"hospital_id\":1,\"user_id\":1520,\"patient_card\":\"191025502\",\"serial_no\":\"4898740\",\"serial_number\":\"1\",\"drug_detailed_code\":\"16020015ZS0_4\",\"item_name\":\"\\u6c2f\\u5316\\u94a0\\u6ce8\\u5c04\\u6db2\",\"item_code\":\"16020015ZS0_4\",\"quantity\":1,\"actual_price\":\"5.70\",\"item_total_amount\":\"5.70\",\"order_dept_id\":7,\"order_dept_code\":\"010502\",\"order_dept_name\":\"\\u6d88\\u5316\\u5185\\u79d1\\u95e8\\u8bca\",\"order_doctor_code\":\"22080001051\",\"order_doctor_name\":\"\",\"acceptance_dept_id\":0,\"acceptance_dept_code\":\"050401\",\"acceptance_dept_name\":\"\\u95e8\\u8bca\\u836f\\u623f\",\"acceptance_doctor_code\":\"22080001051\",\"acceptance_doctor_name\":\"\\u6768\\u6ce2\",\"bill_create_time\":\"2020-06-09 14:22:15\",\"operator_name\":\"\\u8bca\\u95f4\\u652f\\u4ed8\",\"operator_time\":\"2020-06-09 14:22:15\",\"remark\":\"\\u95e8\\u8bca\\u8d39\\u7528\\u4e0a\\u4f20\",\"markup_amount\":\"0.00\",\"medicine_usage_mode\":null,\"specifications\":\"500ml:4.5g\",\"dosage_name\":\"\\u5176\\u4ed6(\\u7701)\",\"mark\":\"1\",\"newborn_mark\":\"0\",\"create_time\":1591683744,\"update_time\":1591683744,\"delete_time\":0}]}","bill_no":"H2020060983744393135266","total_amount":2000,"time_create":"2020-06-09 14:45:06","extend_params":""}}';

$post_obj = json_decode($post);
$data            = $post_obj->req;
$request_content = $data->request_content;
$request_contents = json_decode($request_content, true)['order'];
var_dump($request_contents);
foreach ($request_contents as $value) {

$dataset = "
                                        <row>
                                            <aaz213></aaz213>
                                            <aaz277>" . $value['drug_detailed_code'] . "</aaz277>
                                            <ake006>" . $value['item_name'] . "</ake006>
                                            <aka074>" . $value['specifications'] . "</aka074>
                                            <yae374>" . $value['dosage_name'] . "</yae374>
                                            <ykd129></ykd129>
                                            <yka002>" . $value['item_code'] . "</yka002>
                                            <akc226>" . $value['quantity'] . "</akc226>
                                            <akc225>" . $value['actual_price'] . "</akc225>
                                            <aae019>" . $value['item_total_amount'] . "</aae019>
                                            <yka097>" . $value['order_dept_code'] . "</yka097>
                                            <yka098>" . $value['order_dept_name'] . "</yka098>
                                            <ykd102>" . $value['order_doctor_code'] . "</ykd102>
                                            <yka099>" . $value['order_doctor_name'] . "</yka099>
                                            <yka100>" . $value['acceptance_dept_code'] . "</yka100>
                                            <yka101>" . $value['acceptance_dept_name'] . "</yka101>
                                            <yka102>" . $value['acceptance_doctor_name'] . "</yka102>
                                            <ykd106>" . $value['acceptance_doctor_code'] . "</ykd106>
                                            <ake007>" . $value['bill_create_time'] . "</ake007>
                                            <aae414>" . $value['operator_name'] . "</aae414>
                                            <aae036>" . $value['operator_time'] . "</aae036>
                                            <aka130></aka130>
                                            <aae013>" . $value['remark'] . "</aae013>
                                            <yke201>" . $value['medicine_usage_mode'] . "</yke201>
                                            <yka295></yka295>
                                            <yae374>" . $value['dosage_name'] . "</yae374>
                                            <aae011></aae011>
                                            <yke009>0</yke009>
                                            <yke186>" . $value['mark'] . "</yke186>
                                            <ykz005>" . $value['markup_amount'] . "</ykz005>
                                            <xsebz>" . $value['newborn_mark'] . "</xsebz>
                                        </row>
                            ";
echo $dataset;
                        }

