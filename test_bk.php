<?php
/**
     * 解析XML
     * @param  string  $xml   XML字符串
     * @param  boolean $assoc 返回数组（true）对象（false）
     * @return [type]         [description]
     */
    function parsingXml($xml, $assoc = false)
    {
        if ($assoc) {
            //将文件转换成对象
            $object_xml = simplexml_load_string($xml);
            //将对象转换个JSON
            $xml_json = json_encode($object_xml);
            //将json转换成数组
            $result = json_decode($xml_json, true);
        } else {
            //将文件转换成对象
            $result = simplexml_load_string($xml);
        }

        return $result;
    }

    $params = [
            'inpute' => '<?xml version="1.0" encoding="utf-8"?><Response><TransCode>12004</TransCode><ResultCode>0</ResultCode><ErrorMsg></ErrorMsg><PatientID>118092307</PatientID><PatientType>自费</PatientType><PatientName>王志复</PatientName><IDCardNo>220121196308145114</IDCardNo><Sex>男</Sex><Birthday>19630814</Birthday><Shouji>17790086869</Shouji><Password>111111</Password><AccBalance>0</AccBalance><CardStatus>0</CardStatus><SickID></SickID><ChargePat>1</ChargePat></Response>'
        ];

       $array = parsingXml($params['inpute'], true);

       //print_r($array);
    
    $xml = '<response>
<result>success</result>
<message>成功</message>
<input>
<aac001>个人编号</aac001>
<ykc173>门诊诊断信息</ykc173> 
<hisfyze>HIS费用总额</hisfyze>
<ykb065>执行的社保政策</ykb065>
<aka130>支付类别</aka130>
<akc190>门诊号</akc190>
<aae013>备注</aae013>
<aae011>经办人编码</aae011>
<aae414>经办人姓名</aae414>
<aaa027>统筹区编码</aaa027>
<aae030>就诊时间</aae030>
<yka026>门诊慢性病编码</yka026>
<ykf111>全自费结算标志</ykf111>
<dataset>
<row>
<aaz213>记账流水号</aaz213 >
<aaz277>医疗机构三大目录ID</aaz277>
<ake006>医院项目名称</ake006>
<aaz231>医保通用项目编码</aaz231>
<akc226>数量_AKC226</akc226>
<akc225>实际价格_AKC225</akc225>
<aae019>明细项目费用总额</aae019>
<yka097>开单科室编码_YKA097</yka097>
<yka098>开单科室名称_YKA098</yka098>
<ykd102>开单医生编码YKD102</ykd102>
<yka099>开单医生姓名YKA099</yka099>
<yka100>受单科室编码_YKA100</yka100>
<yka101>受单科室名称_YKA101</yka101>
<ykd106>受单医生编码YKD106</ykd106>
<yka102>受单医生姓名YKA102</yka102>
<ake007>明细发生时间</ake007>
<aae414>经办人姓名</aae414>
<aae036>经办时间_AAE036</aae036>
<aae013>备注_AAE013</aae013>
<ykz005>其中加价金额</ykz005>
<yke201>中药使用方式</yke201>
<aka074>规格</aka074>
<yae374>剂型名称</yae374>
<yke186>标志</yke186> 
<xsebz>新生儿标志</xsebz> 
<serial_no>1259871</serial_no>
</row>
<row>
<aaz213>记账流水号</aaz213 >
<aaz277>医疗机构三大目录ID</aaz277>
<ake006>医院项目名称</ake006>
<aaz231>医保通用项目编码</aaz231>
<akc226>数量_AKC226</akc226>
<akc225>实际价格_AKC225</akc225>
<aae019>明细项目费用总额</aae019>
<yka097>开单科室编码_YKA097</yka097>
<yka098>开单科室名称_YKA098</yka098>
<ykd102>开单医生编码YKD102</ykd102>
<yka099>开单医生姓名YKA099</yka099>
<yka100>受单科室编码_YKA100</yka100>
<yka101>受单科室名称_YKA101</yka101>
<ykd106>受单医生编码YKD106</ykd106>
<yka102>受单医生姓名YKA102</yka102>
<ake007>明细发生时间</ake007>
<aae414>经办人姓名</aae414>
<aae036>经办时间_AAE036</aae036>
<aae013>备注_AAE013</aae013>
<ykz005>其中加价金额</ykz005>
<yke201>中药使用方式</yke201>
<aka074>规格</aka074>
<yae374>剂型名称</yae374>
<yke186>标志</yke186> 
<xsebz>新生儿标志</xsebz> 
<serial_no>1259871</serial_no>
</row>
</dataset>
</input>
</response>';

$array = parsingXml($xml, true);

print_r($array);