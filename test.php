<?php

$variable = '';

if (!empty($variable) && is_array($variable)) {
    foreach ($variable as $key => $value) {
        echo $value;
    }
}

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
<resultCode>0</resultCode>
<resultMessage>111</resultMessage>
<result>
<item>
<ysdm>152</ysdm>
<ysmc>徐和平</ysmc>
<ksdm>001</ksdm>
<ksmc>泌尿男科（门诊）</ksmc>
</item>
<item>
<ysdm>152</ysdm>
<ysmc>徐和平</ysmc>
<ksdm>001</ksdm>
<ksmc>泌尿男科（门诊）</ksmc>
</item>
</result>
</response>
';

$array = parsingXml($xml, true);

print_r($array);