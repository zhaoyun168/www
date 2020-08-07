<?php

Class SoapCallbackController {
    public function soapFun()
        {
            try {
                $procClass     = 'App\Services\SoapService';
                $classNameFull = explode('\\', $procClass);
                $className     = array_pop($classNameFull);
                $storagePath   = storage_path();
                if (! file_exists($storagePath . '/wsdl/' . $className . '.wsdl')) {
                    if (! file_exists($storagePath . '/wsdl/')) {
                        mkdir($storagePath . '/wsdl/', 0777, true);
                    }
                    require_once app_path() . '/Libs/SoapDiscovery.php';
       
                    $soapDiscovery = new \SoapDiscovery($procClass, 'soap');
                    $file          = fopen($storagePath . '/wsdl/' . $className . '.wsdl', 'w');
                    fwrite($file, $soapDiscovery->getWSDL());
                    fclose($file);
                }
                $server = new \SoapServer($storagePath . '/wsdl/' . $className . '.wsdl', array('soap_version' => SOAP_1_2));
                $server->setClass($procClass);
                $server->handle();
            } catch (\Exception $e) {
                Log::error('wsdl服务创建异常');
            }
        }
    }