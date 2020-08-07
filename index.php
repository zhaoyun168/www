<?php
function checkXML($str)
{ 
    $xml_parser = xml_parser_create();

    if(!xml_parse($xml_parser, $str, true)){ 
        xml_parser_free($xml_parser); 
        return false; 
    }

    return true; 
}

$xml = '<Request><TranCode>81020</TranCode><TranFlowNo></TranFlowNo><IPID>101003166</IPID><UserID></UserID><DeviceID></DeviceID></Request>';

var_dump(checkXML($xml));