<?php

$url = '/test?name=1@age=20@sex=1';

$url = str_replace('@', '&', $url); //为了URL参数可以包含URL参数需要把&替换为@，然后再替换回来

echo $url;