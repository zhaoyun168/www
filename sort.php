<?php

$str = '[
        {
            "total":"333.46",
            "aae003":"202004",
            "bkc095":"2020-03-31 09:21:26",
            "jdw":"0",
            "jbgr":"266.77",
            "eydw":"0",
            "jbtc":"0",
            "lxdw":"0",
            "jbdw":"66.69"
        },
        {
            "total":"40.02",
            "aae003":"202004",
            "bkc095":"2020-03-31 09:21:28",
            "jdw":"0",
            "jbgr":"0",
            "eydw":"0",
            "jbtc":"0",
            "lxdw":"0",
            "jbdw":"40.02"
        },
        {
            "total":"1.78",
            "aae003":"202003",
            "bkc095":"2020-03-31 09:21:26",
            "jdw":"0",
            "jbgr":"1.42",
            "eydw":"0",
            "jbtc":"0",
            "lxdw":"0",
            "jbdw":"0.36"
        },
        {
            "total":"0.22",
            "aae003":"202003",
            "bkc095":"2020-03-31 09:21:28",
            "jdw":"0",
            "jbgr":"0",
            "eydw":"0",
            "jbtc":"0",
            "lxdw":"0",
            "jbdw":"0.22"
        },
        {
            "total":"0.22",
            "aae003":"202002",
            "bkc095":"2020-03-31 09:21:27",
            "jdw":"0",
            "jbgr":"0",
            "eydw":"0",
            "jbtc":"0",
            "lxdw":"0",
            "jbdw":"0.22"
        },
        {
            "total":"1.78",
            "aae003":"202002",
            "bkc095":"2020-03-31 09:21:28",
            "jdw":"0",
            "jbgr":"1.42",
            "eydw":"0",
            "jbtc":"0",
            "lxdw":"0",
            "jbdw":"0.36"
        },
        {
            "total":"2.00",
            "aae003":"202001",
            "bkc095":"2020-03-31 09:21:27",
            "jdw":"0",
            "jbgr":"1.42",
            "eydw":"0",
            "jbtc":"0",
            "lxdw":"0",
            "jbdw":"0.58"
        }
    ]';

    $array = json_decode($str, true);

    array_multisort(array_column($array, 'bkc095'), SORT_DESC, $array);


    print_r($array);