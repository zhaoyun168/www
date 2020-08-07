<?php
namespace app\test\controller;

use base\controller\HomeBaseController;
use platform\szyy\func\Register;
use platform\szyy\func\Outpatient;
use platform\szyy\func\OutpatientPay;
use platform\szyy\func\User;
use platform\szyy\func\RegisterPay;
use platform\szyy\func\Settlement;

class SzyyController extends HomeBaseController
{

	/**
	 * 预约出诊科室查询（CYYGH001）已测试
	 */
    public function getPreDeptInfo()
    {
    	$params = [
            'hospital_code' => '01', //医院代码
            'start_date'    => date("Ymd"), //开始日期（格式：yyyyMMdd 需大于当前日期）（必填）
            'end_date'      => date("Ymd", strtotime('6 days')), //结束日期（格式：yyyyMMdd）（必填）
    	];

    	$resultInfo = Register::getPreDeptInfo($params);
    	print_r($resultInfo);
    }

    /**
     * 预约科室号源信息查询（CYYGH003）
     */
    public function getPreDeptSourceNumber()
    {
        $params = [
            'dept_code'  => '11010111', //科室代码
            'start_date' => date("Ymd"), //开始日期（格式：yyyyMMdd）（必填）
            'end_date'   => date("Ymd", strtotime('6 days')), //结束日期（格式：yyyyMMdd 时间跨度最长3个月）（必填）
            'visit_type' => '', //坐诊类型
            'visit_id'   => '', //坐诊类型id
        ];

        $resultInfo = Register::getPreDeptSourceNumber($params);
        print_r($resultInfo);
    }

    /**
     * 预约科室号源号序信息查询（CYYGH004）
     */
    public function getPreDeptSourceNumberOrder()
    {
        $params = [
            'schedule_id' => '0', //排版序号（排版唯一号）
            'visit_id'    => '10', //坐诊类型id
        ];

        $resultInfo = Register::getPreDeptSourceNumberOrder($params);
        print_r($resultInfo);
    }

    /**
     * 预约出诊医生查询（CYYGH005）已测试
     */
    public function getPreDoctors()
    {
        $params = [
            'dept_code'  => '91060111', //科室代码（必填）
            'start_date' => date("Ymd"), //开始日期（格式：yyyyMMdd）（必填）
            'end_date'   => date("Ymd", strtotime('6 days')), //结束日期（格式：yyyyMMdd）（必填）
        ];

        $resultInfo = Register::getPreDoctors($params);
        print_r($resultInfo);
    }

    /**
     * 预约医生信息查询（CYYGH006）
     */
    public function getPreDoctorsInfo()
    {
        $params = [
            'dept_code'    => '0', //科室代码
            'start_date'   => '20191022', //开始日期（格式：yyyyMMdd）（必填）
            'end_date'     => '20191028', //结束日期（格式：yyyyMMdd）（必填）
            'visit_type'   => '', //出诊类型（0普通科室 1专家 2特需 3远程门诊 4专病专家 5专病6整合门诊 7膏方8普通医生，不填则为全部）
            'doctors_code' => '', //医生代码
        ];

        $resultInfo = Register::getPreDoctorsInfo($params);
        print_r($resultInfo);
    }

    /**
     * 预约医生号源信息查询（CYYGH007）已测试
     */
    public function getPreDoctorsSourceNumber()
    {
        $params = [
            'doctors_code'    => '266', //医生代码（必填）
            'start_date'      => date("Ymd"), //开始日期（格式：yyyyMMdd）（必填）
            'end_date'        => date("Ymd", strtotime('6 days')), //结束日期（格式：yyyyMMdd）（必填）
            'outpatient_type' => '', //坐诊类型
            'outpatient_id'   => '', //坐诊类型id
            'hospital_code'   => '', //医院代码
        ];

        $resultInfo = Register::getPreDoctorsSourceNumber($params);
        print_r($resultInfo);
    }

    /**
     * 预约医生号源号序信息查询（CYYGH008）已测试
     */
    public function getPreDoctorsSourceNumberOrder()
    {
        $params = [
            'schedule_id'   => '57068', //排版序号（排版唯一号）（必填）
            'outpatient_id' => '', //坐诊类型id
        ];

        $resultInfo = Register::getPreDoctorsSourceNumberOrder($params);
        print_r($resultInfo);
    }

     /**
     * 患者信息查询（CMZXX001）已测试
     */
    public function getPatientInfo()
    {
        $params = [
            'card_no'       => '', //卡号
            'patient_no'    => '', //病历号
            'id_card_no'    => '542521198003070216', //身份证号
            'patient_name'  => '在职工伤非公务员', //患者姓名ssss
			//'phone'         => '18088686868', //手机号
            'phone'         => '', //手机号
            'contact_phone' => '', //联系人电话
            'contact_id_no' => '', //联系人证件号
        ];

        $resultInfo = User::getPatientInfo($params);
        print_r($resultInfo);
    }

    /**
     * 患者基本信息查询（CMZXX005）已测试
     */
    public function getPatientBasicInfo()
    {
        $params = [
            'patient_id'   => '1722836', //病人唯一码
            'patient_name' => '张三', //患者姓名
        ];

        $resultInfo = User::getPatientBasicInfo($params);
        print_r($resultInfo);
    }

    /**
     * 患者信息查询（CMZXX001）已测试
     */
    public function addPatient()
    {
        $params = [
            'patient_name'                    => '李四', //患者姓名
            'sex'                             => '男', //性别
            'certificate_number'              => '411326198001010010', //证件号
            'certificate_type'                => '0', //证件类型（0身份证、1护照、2军官证）
            'birth'                           => '19900101', //出生年月
            'address'                         => '', //联系地址
            'phone'                           => '18088686868', //联系电话
            'account_amount'                  => '0', //账户金额
            'remark'                          => '测试账户', //备注
            'contact_name'                    => '', //联系人姓名
            'contact_phone'                   => '', //联系人电话
            'contact_certificate_number'      => '', //联系人证件号
            'national_code'                   => '', //民族代码
            'occupational_code'               => '', //职业代码
            'medical_insurance_input_parameter' => '', //医保入参
            'electronic_card_number'          => '', //电子卡号
        ];

        $resultInfo = User::addPatient($params);
        print_r($resultInfo);
    }

    /**
     * 患者基本信息更新（BMZXX008）已测试
     */
    public function updatePatient()
    {
        $params = [
            'patient_id'                      => '1722836', //病人唯一码 （必填）
            'patient_name'                    => '张三', //患者姓名 （必填）
            'card_no'                         => '', //患者卡号
            'address'                         => '长春朝阳区', //联系地址
            'phone'                           => '18088686868', //联系电话
            'remark'                          => '测试账户', //备注
            'contact_name'                    => '张三', //联系人姓名
            'contact_phone'                   => '18088686868', //联系人电话
            'national_code'                   => '01', //民族代码
            'occupational_code'               => '02', //职业代码
            'medical_insurance_input_parameter' => '', //医保入参
            'electronic_card_number'          => '', //电子卡号
            'certificate_number'              => '411326198001010010', //证件号
            'certificate_type'                => '0', //证件类型（0身份证、1护照、2军官证）
        ];

        $resultInfo = User::updatePatient($params);
        print_r($resultInfo);
    }

    /**
     * 门诊预约登记（BYYGH001）已测试
     */
    public function preRegister()
    {
        $params = [
            'patient_id'       => '1722853', //病人唯一码
            'schedule_id'      => '95284', //排班明细序号
            'pre_order_number' => '25', //预约号序
            'platform_order_no'     => '2020011377995895212819', //平台流水号 （系统生成，类似订单号）
            'outpatient_id'    => '', //坐诊类型id
        ];

        $resultInfo = Register::preRegister($params);
        print_r($resultInfo);
    }

    /**
     * 门诊预约取消（BYYGH002）已测试
     */
    public function preCancel()
    {
        $params = [
            'patient_id' => '1722836', //病人唯一码
            'pre_number' => '97011', //预约序号
        ];

        $resultInfo = Register::preCancel($params);
        print_r($resultInfo);
    }

     /**
     * 预约挂号预算（BYYGH003/B204）
     */
    public function preRegisterPreSettlement()
    {
        $params = [
            'patient_id'                      => '1722853', //病人唯一码
            'dept_code'                       => '', //科室代码（传pbmxxh时可以不传）
            'dept_name'                       => '', //科室名称（传pbmxxh时可以不传）
            'doctors_code'                    => '', //医生代码（传pbmxxh时可以不传）
            'doctors_name'                    => '', //医生姓名（传pbmxxh时可以不传）
            'schedule_id'                     => '95284', //排班明细序号（未使用门诊排班时传-1）
            'is_hospital_account'             => '0', //是否扣院内账户（0不使用院内账户走1使用院内账户（默认不使用院内庄户））
            'is_self_pay_settlement'          => '0', //是否自费结算（0根据病人医保代码结算1自费结算（默认自费结算）
            'pre_number'                      => '97038', //预约序号（预约取号时必传）
            'medical_insurance_input_parameter' => '', //医保入参（Xml节点）
        ];

        $resultInfo = RegisterPay::preRegisterPreSettlement($params);
        print_r($resultInfo);
    }

     /**
     * 预约挂号结算（BYYGH004/B202）
     */
    public function preRegisterSettlement()
    {
        $params = [
            'patient_id'                        => '1722853', //病人唯一码（必填）
            'register_no'                       => '1062521', //挂号序号（本次挂号的HIS唯一码）（必填）
            'receipt_number'                    => '20200113A80200001', //收据号（预算时返回）（必填）
            'total_amount'                      => '61', //总金额（预算时返回）（必填）
            'payable_amount'                    => '61', //应付金额（预算时返回）（必填）
            'pay_type'                          => '5', //支付方式（支付方式：0无第三方支付（即应收金额为0，支付金额=0，支付流水号=’’）；参考卫宁支付平台代码表，2微信需要特殊处理）（必填）
            'pay_money'                         => '61', //支付金额（必填）
            'pay_order_no'                      => '2020011377995895212819', //支付流水号
            'pay_time'                          => date('Y-m-d H:i:s'), //支付时间（格式yyyyMMddHH:mm:ss）（必填）
            'is_hospital_account'               => '0', //是否扣院内账户（0不使用院内账户走1使用院内账户（默认不使用院内庄户））（必填）
            'is_self_pay_settlement'            => '0', //是否自费结算（0根据病人医保代码结算1自费结算（默认自费结算）
            'platform_order_no'                      => '2020011377995895212819', //平台流水号（必填）
            'manufacturer_code'                 => '', //厂商代码（卫宁 1,墨联 2,联空 3,齐脉 4,海鹚 5,纳里健康 6,金蝶 7,飞凡 8,就医160 9,恒生 10,银医通 11）
            'medical_insurance_input_parameter' => '', //医保入参
        ];

        $resultInfo = RegisterPay::preRegisterSettlement($params);
        print_r($resultInfo);
    }

    /**
     * 预约挂号结算取消（BYYGH005/B203）
     */
    public function preRegisterSettlementCancel()
    {
        $params = [
            'patient_id'      => '1722853', //病人唯一码（必填）
            'register_no'     => '1062017', //挂号序号（本次挂号的HIS唯一码）（必填）
            'receipt_number'  => '20191115A80200003', //收据号（预算时返回）（必填）
            'pay_type'        => '2', //退支付方式（支付方式：支付宝1，微信支付2,银联卡支付3）（必填）
            'pay_money'       => '37', //退支付金额（必填）
            'pay_order_no'    => 'P2019111580953597078746', //原支付流水号（必填）
            'refund_order_no' => '', //退流水号
        ];

        $resultInfo = Pay::preRegisterSettlementCancel($params);
        print_r($resultInfo);
    }

    /**
     * 退费结果通知（BDRGH004）
     */
    public function refundResultNotice()
    {
        $params = [
            'refund_receipt_number' => '20191115A80200004', //退收据号（挂号结算取消交易返回的tsjh）（必填）
            'patient_name'          => '李四', //患者姓名（必填）
            'pay_type'              => '2', //退支付方式（支付方式：支付宝1，微信支付2,银联卡支付3）（必填）
            'pay_money'             => '37', //退支付金额（必填）
            'refund_order_no'       => '', //退流水号
        ];

        $resultInfo = Pay::refundResultNotice($params);
        print_r($resultInfo);
    }

    /**
     * 预约信息查询（CYYGH009）
     */
    public function getPreInfo()
    {
        $params = [
            'patient_id'   => '1722836', //病人唯一码（默认传0）（必填）
            'pre_number'   => '0', //预约序号（默认传0）（必填）
            'date_type'    => '', //日期类型
            'start_date'   => date("Ymd"), //开始日期（格式：yyyyMMdd）（必填）
            'end_date'     => date("Ymd", strtotime('6 days')), //结束日期（格式：yyyyMMdd）（必填）
            'patient_name' => '', //患者姓名
            'action_flag'  => '', //当前操作员标志
        ];

        $resultInfo = Register::getPreInfo($params);
        print_r($resultInfo);
    }

    /**
     * 爽约信息查询（CYYGH010）
     */
    public function failPreInfo()
    {
        $params = [
            'patient_id'   => '1722836', //病人唯一码（默认传0）（必填）
            'start_date'   => date("Ymd"), //开始日期（格式：yyyyMMdd）（必填）
            'end_date'     => date("Ymd", strtotime('6 days')), //结束日期（格式：yyyyMMdd）（必填）
            'patient_name' => '张三', //患者姓名（必填）
            'action_flag'  => '', //当前操作员标志
        ];

        $resultInfo = Register::failPreInfo($params);
        print_r($resultInfo);
    }

    /**
     * 停诊信息查询（CYYGH011）
     */
    public function stopDiagnosisInfo()
    {
        $params = [
            'start_date'   => date("Ymd"), //开始日期（格式：yyyyMMdd）（必填）
            'end_date'     => date("Ymd", strtotime('6 days')), //结束日期（格式：yyyyMMdd）（必填）
        ];

        $resultInfo = Register::stopDiagnosisInfo($params);
        print_r($resultInfo);
    }

    /**
     * 替诊信息查询（CYYGH015）（不涉及）
     */
    public function getReplaceDiagnosisInfo()
    {
        $params = [
            'hospital_code'   => '', //医院代码
            'start_date'   => date("Ymd"), //开始日期（格式：yyyyMMdd）（必填）
            'end_date'     => date("Ymd", strtotime('6 days')), //结束日期（格式：yyyyMMdd）（必填）
        ];

        $resultInfo = Register::getReplaceDiagnosisInfo($params);
        print_r($resultInfo);
    }

    /**
     * 待缴费处方查询（CMZJF001）
     */
    public function getPendingPayment()
    {
        $params = [
            //'patient_id'   => '1722853', //病人唯一码
			'patient_id'   => '1723024', //病人唯一码
            //'register_no'  => '', //挂号序号（本次挂号的HIS唯一码）
            'start_date'   => date("Ymd", strtotime('-30 days')), //开始日期（格式：yyyyMMdd）（必填）
            'end_date'     => date("Ymd"), //结束日期（格式：yyyyMMdd）（必填）
            'patient_name' => '在职工伤非公务员', //患者姓名（必填）
        ];

        $resultInfo = Outpatient::getPendingPayment($params);
        print_r($resultInfo);
    }

    /**
     * 待缴费处方明细查询（CMZJF002）
     */
    public function getPendingPaymentDetailed()
    {
        $params = [
            'prescription_number'   => '2179068', //划价序号（即处方序号 cfxh）（必填）
            'patient_id'  => '', //病人唯一码
            'register_no'  => '', //挂号序号（本次挂号的HIS唯一码）
            'start_date'   => '', //开始日期（格式：yyyyMMdd）
            'end_date'     => '', //结束日期（格式：yyyyMMdd）
            'patient_name' => '在职工伤非公务员', //患者姓名（必填）
            'settlement_mark' => '1', //结算标志（0全部1未支付2已支付）（必填）
        ];

        $resultInfo = Outpatient::getPendingPaymentDetailed($params);
        print_r($resultInfo);
    }

    /**
     * 缴费记录查询（CMZJF003）
     */
    public function getPaymentRecord()
    {
        $params = [
            'patient_id'   => '1722836', //病人唯一码（必填）
            'register_no'  => '', //挂号序号（本次挂号的HIS唯一码）
            'start_date'   => date("Ymd"), //开始日期（格式：yyyyMMdd）（必填）
            'end_date'     => date("Ymd", strtotime('6 days')), //结束日期（格式：yyyyMMdd）（必填）
            'patient_name' => '张三', //患者姓名（必填）
        ];

        $resultInfo = Pay::getPaymentRecord($params);
        print_r($resultInfo);
    }

    /**
     * 缴费处方查询（CMZJF004）
     */
    public function getPaymentPrescription()
    {
        $params = [
            'patient_id'   => '1722836', //病人唯一码（必填）
            'settlement_receipt_no'  => '20191118A80200001', //结算收据号（必填）
            'patient_name' => '张三', //患者姓名（必填）
        ];

        $resultInfo = Pay::getPaymentPrescription($params);
        print_r($resultInfo);
    }

    /**
     * 缴费明细查询_按单号或处方号查（CMZJF005）
     */
    public function getPaymentDetailedNumber()
    {
        $params = [
            'patient_id'   => '1722836', //病人唯一码
            'settlement_receipt_no'  => '20191118A80200001', //结算收据号（必填）
            'prescription_no'  => '', //处方序号
            'patient_name' => '张三', //患者姓名（必填）
        ];

        $resultInfo = Pay::getPaymentDetailedNumber($params);
        print_r($resultInfo);
    }

    /**
     * 缴费明细查询_按日期查（CMZJF006）
     */
    public function getPaymentDetailedDate()
    {
        $params = [
            'patient_id'   => '1722836', //病人唯一码
            'start_date'    => date("Ymd"), //开始日期（格式：yyyyMMdd 需大于当前日期）（必填）
            'end_date'      => date("Ymd", strtotime('6 days')), //结束日期（格式：yyyyMMdd）（必填）
            'patient_name' => '张三', //患者姓名（必填）
        ];

        $resultInfo = Pay::getPaymentDetailedDate($params);
        print_r($resultInfo);
    }

    /**
     * 门诊收费预算（BMZJF001/B401）
     */
    public function outpatientPreSettlement()
    {
        $params = [
            'patient_id'   => '1723024', //病人唯一码
            'prescription_number_set'  => '2179066,2179067,2179068,2179068', //划价序号合集（格式：200,330,200  多个序号间以逗号分隔，末位不允许有分隔符）（必填）
            'is_hospital_account'  => '0', //是否扣院内账户（0不使用院内账户走1使用院内账户（默认不使用院内庄户））
            'is_self_pay_settlement' => '0', //是否自费结算（0根据病人医保代码结算1自费结算（默认自费结算）
            'medical_insurance_input_parameter' => '', //医保入参（Xml节点）
        ];

        $resultInfo = OutpatientPay::outpatientPreSettlement($params);
        print_r($resultInfo);
    }

    /**
     * 门诊收费结算（BMZJF002/B402）
     */
    public function outpatientSettlement()
    {
        $params = [
            'patient_id'   => '1723024', //病人唯一码
            'receipt_number'  => '20200311A80200001', //收据号（预算时返回）
            'total_amount'  => '50.04', //总金额（预算时返回）
            'payable_amount' => '50.04', //应付金额（预算时返回）
            'pay_type' => '2', //支付方式（支付方式：0无第三方支付（即应收金额为0，支付金额=0，支付流水号=’’）；参考卫宁支付平台代码表，2微信需要特殊处理）
            'pay_money' => '50.04', //支付金额
            'pay_order_no' => 'H2020031118905114053417', //支付流水号
            'pay_time' => date('Y-m-d H:i:s'), //支付时间
            'is_hospital_account' => '0', //是否扣院内账户（0不使用院内账户走1使用院内账户（默认不使用院内庄户））与预算保持一致
            'is_self_pay_settlement' => '0', //是否自费结算（0根据病人医保代码结算1自费结算（默认自费结算）与预算保持一致
            'platform_order_no' => 'H2020031118905114053417', //平台流水号
            'manufacturer_code' => '', //厂商代码（卫宁 1,墨联 2,联空 3,齐脉 4,海鹚 5,纳里健康 6,金蝶 7,飞凡 8,就医160 9,恒生 10,银医通 11）
            'medical_insurance_input_parameter' => '', //医保入参（Xml节点）
        ];

        $resultInfo = OutpatientPay::outpatientSettlement($params);
        print_r($resultInfo);
    }

    /**
     * 门诊收费取消预算（BMZJF004）
     */
    public function outpatientSettlementCancel()
    {
        $params = [
            'patient_id'   => '1722836', //病人唯一码（必填）
            'receipt_number'  => '20191118A80200001', //结算收据号（必填）
        ];

        $resultInfo = Pay::outpatientSettlementCancel($params);
        print_r($resultInfo);
    }

    /**
     * 处方解锁（BMZJF003）
     */
    public function prescriptionUnlock()
    {
        $params = [
            'patient_id'   => '1722836', //病人唯一码（必填）
            'prescription_number_set'  => '2178708,2178709,2178710', //划价序号合集（格式：200,330,200  多个序号间以逗号分隔，末位不允许有分隔符）（必填）
        ];

        $resultInfo = Pay::prescriptionUnlock($params);
        print_r($resultInfo);
    }

    /**
     * 获取门诊处方明细上传参数（cfmxsc）
     */
    public function getDetailedUploadParam()
    {
        $params = [
            'receipt_number' => '20200312A80200004', //收据号
        ];

        $resultInfo = Settlement::getDetailedUploadParam($params);
        print_r($resultInfo);
    }

    /**
     * 获取门诊预算上传参数（mzys）
     */
    public function getSettlementUploadParam()
    {
        $params = [
            'receipt_number' => '20200309A80200001', //收据号
        ];

        $resultInfo = Settlement::getSettlementUploadParam($params);
        print_r($resultInfo);
    }
	
	/**
     * 撤销明细回写（cxmxhx）
     */
    public function cancelDetailedWriteBack()
    {
        $params = [
            'receipt_number' => '20200305A80200001', //收据号
        ];

        $resultInfo = Settlement::cancelDetailedWriteBack($params);
        print_r($resultInfo);
    }
	
	/**
     * 门诊处方上传回写（mzcfschx）
     */
    public function outpatientPrescriptionWriteBack()
    {
        $params = [
            'receipt_number' => '20200309A80200001', //收据号
            'visit_serial_number' => '20200227990080001', //就诊流水号
            'charging_items_type' => '1', //收费项目种类
            'fees_category' => '12', //收费类别
            'prescription_number' => '10710841', //处方号
            'prescription_date' => '2020030410:41:08', //处方日期
            'hospital_charging_items_code' => '1233', //医院收费项目内码
            'charge_item_center_code' => 'JLYP140815', //收费项目中心编码
            'hospital_charging_items_name' => '一清胶囊', //医院收费项目名称
            'unit_price' => '25.0200', //单价
            'quantity' => '1.00', //数量
            'dosage' => '', //剂型
            'specifications' => '', //规格
            'each_dose' => '', //每次用量
            'usage_frequency' => '', //使用频次
            'doctor_name' => '张睿', //医生姓名
            'prescription_doctor' => '400', //处方医师
            'usage' => '', //用法
            'unit' => '', //单位
            'dept_code' => '11010411', //科室编码
            'execution_days' => '', //执行天数
            'herbal_single_compound_mark' => '', //草药单复方标志
            'operator' => 'A8020', //经办人
            'drug_dispensing_personnel' => '', //发药人员
            'approver' => '孙野', //审批人
            'newborn_cost_identification' => '', //新生儿费用标识
            'manufacturer' => '成都康弘制药有限公司', //生产厂家
            'drug_approval_number' => '国药准字Z19991047', //药品批准文号
            'charging_pricing_method' => '', //收费计价方式
            'minimum_quantity_package' => '', //最小包装内数量
            'amount' => '25.02', //金额
            'amount_care' => '5.0', //自理金额
            'amount_self' => '0.0', //自费金额
            'limit_price_self' => '0.0', //超限价自付金额
            'price_ceiling' => '0.0', //最高限价
            'self_payment_ratio' => '0.2', //自付比例
            'charging_item_level' => '2', //收费项目等级
            'full_cost_sign' => '0', //全额自费标志
            'hospital_burden' => '0.0', //医院负担金额
        ];

        $resultInfo = Settlement::outpatientPrescriptionWriteBack($params);
        print_r($resultInfo);
    }
	
	/**
     * 门诊预算回写（mzyshx）
     * 20200227990080001|20200305A80200011|11|20200305191549|20200305191549||R51.x00|头痛|1||A8020|50.04|||12032|^1^
     * 
     * "50.04","0.0","0.0","0.0","0.0","0.0","50.04","10.0","50.04","40.04","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","20200305A80200011","0.0","0.0","0.0","0.0","11","0.0"
     */
    public function outpatientPreSettlementWriteBack()
    {
        $params = [
            'receipt_number' => '20200309A80200001', //收据号
            'visit_serial_number' => '20200227990080001', //就诊流水号
            'document_no' => '20200309A80200001', //单据号
            'medical_category' => '11', //医疗类别
            'settlement_date' => '20200305191549', //结算日期
            'discharge_date' => '20200305191549', //出院日期
            'discharge_reasons' => '', //出院原因
            'diagnosis_disease_code' => 'R51.x00', //出院诊断疾病编码
            'diagnosis_disease_name' => '头痛', //出院诊断疾病名称
            'account_usage_mark' => '1', //账户使用标志
            'halfway_settlement_flag' => '', //中途结算标志
            'operator' => 'A8020', //经办人
            'total_amount' => '50.04', //医疗费总额
            'fetus_number' => '', //胎儿数
            'localized_backup' => '', //本地化备用
            'developer_logo' => '12032', //开发商标识
            'amount_self' => '0.0', //自费金额
            'this_account_payment' => '0.0', //本次帐户支付
            'overall_expenditure' => '0.0', //统筹支出
            'salvage_money_payment' => '0.0', //救助金支付金额
            'civil_servant_subsidy_payment' => '0.0', //公务员补助支付金额
            'cash_payment_amount' => '50.04', //现金支付金额
            'class_b_self_expense' => '10.0', //乙类自理费用
            'class_a_self_expense' => '50.04', //甲乙类费用
            'meet_basic_medical_expenses' => '40.04', //符合基本医疗费用
            'payment_standard' => '0.0', //起付标准自付
            'entry_cost' => '0.0', //进入统筹费用
            'overall_payment_by_sections' => '0.0', //统筹分段自付
            'large_amount' => '0.0', //进入大额段费用
            'large_amount_person' => '0.0', //大额段个人支付
            'excess_amount' => '0.0', //超封顶线个人自付金额
            'health_care_object_payment' => '0.0', //保健对象支付
            'civil_servant_outpatient_amount' => '0.0', //公务员门诊可补助费用
            'class_b_self_proportion' => '0.0', //乙类自理比例
            'overall_class_b_amount' => '0.0', //统筹段乙类自理费用
            'overall_civil_servant_amount' => '0.0', //统筹段公务员补助支付
            'public_supplementary_expenses' => '0.0', //进入公补段费用
            'public_supplementary_class_b_expenses' => '0.0', //公补段乙类自理费用
            'public_supplementary_fund' => '0.0', //公补段基金支付金额
            'public_supplementary_person' => '0.0', //公补段个人支付金额
            'large_amount_class_b' => '0.0', //大额段乙类自理费用
            'overall_fund' => '0.0', //统筹段基金支付比例
            'overall_civil_servant' => '0.0', //统筹段公务员补助比例
            'public_supplementary_civil_servant' => '0.0', //公补段公务员补助比例
            'large_amount_fund' => '0.0', //大额段基金支付比例
            'civil_servant_first_proportion' => '0.0', //公务员门诊第一段补助比例
            'civil_servant_second_proportion' => '0.0', //公务员门诊第二段补助比例
            'civil_servant_third_proportion' => '0.0', //公务员门诊第三段补助比例
            'neonatal_expenses' => '0.0', //新生儿费用
            'public_supplementary_standard' => '0.0', //公补支起付标准
            'public_supplementary_class_b' => '0.0', //公补支乙类自理
            'public_supplementary_overall' => '0.0', //公补支统筹分段自付
            'civil_servant_first_amount' => '0.0', //公务员门诊第一段补助金额
            'civil_servant_second_amount' => '0.0', //公务员门诊第二段补助金额
            'civil_servant_third_amount' => '0.0', //公务员门诊第三段补助金额
            'hospital_times' => '0.0', //本次住院次数
            'bill_no' => '20200305A80200011', //单据号
            'account_balance' => '0.0', //就诊后帐户余额
            'perinatal_allowance' => '0.0', //生育围产补贴(离休冲减上年账户金额)
            'physical_examination_allowance' => '0.0', //体检补贴
            'hospital_commitment' => '0.0', //医院承担金额
            'medical_treatment_category' => '11', //医疗待遇类别
            'supplementary_medical_payment_amount' => '0.0', //补充医疗支付金额
            'transaction_flow_number' => '20200306101420-12032-4276', //交易流号
            'business_cycle_no' => 'ybt', //业务周期号
        ];

        $resultInfo = Settlement::outpatientPreSettlementWriteBack($params);
        print_r($resultInfo);
    }
	
	/**
     * 获取交易流水号（mzhqlsh）
     */
    public function getTransactionSerialNumber()
    {
        $params = [
            'patient_id' => '1723024', //病人唯一码
        ];

        $resultInfo = Settlement::getTransactionSerialNumber($params);
        print_r($resultInfo);
    }
	
	 /**
     * 门诊预算取消（mzysqx）
     */
    public function outpatientPreSettlementCancel()
    {
        $params = [
            'receipt_number' => '20200309A80200001', //收据号
        ];

        $resultInfo = Settlement::outpatientPreSettlementCancel($params);
        print_r($resultInfo);
    }
	
	/**
     * 门诊结算回写（mzzshx）
     * 20200227990080001|20200305A80200011|11|20200305191549|20200305191549||R51.x00|头痛|1||A8020|50.04|||12032|^1^
     * 
     * "50.04","0.0","0.0","0.0","0.0","0.0","50.04","10.0","50.04","40.04","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","20200305A80200011","0.0","0.0","0.0","0.0","11","0.0"
     */
    public function outpatientSettlementWriteBack()
    {
        $params = [
            'receipt_number' => '20200309A80200001', //收据号
            'visit_serial_number' => '20200227990080001', //就诊流水号
            'document_no' => '20200309A80200001', //单据号
            'medical_category' => '11', //医疗类别
            'settlement_date' => '20200305191549', //结算日期
            'discharge_date' => '20200305191549', //出院日期
            'discharge_reasons' => '', //出院原因
            'diagnosis_disease_code' => 'R51.x00', //出院诊断疾病编码
            'diagnosis_disease_name' => '头痛', //出院诊断疾病名称
            'account_usage_mark' => '1', //账户使用标志
            'halfway_settlement_flag' => '', //中途结算标志
            'operator' => 'A8020', //经办人
            'total_amount' => '50.04', //医疗费总额
            'fetus_number' => '', //胎儿数
            'localized_backup' => '', //本地化备用
            'developer_logo' => '12032', //开发商标识
            'amount_self' => '0.0', //自费金额
            'this_account_payment' => '0.0', //本次帐户支付
            'overall_expenditure' => '0.0', //统筹支出
            'salvage_money_payment' => '0.0', //救助金支付金额
            'civil_servant_subsidy_payment' => '0.0', //公务员补助支付金额
            'cash_payment_amount' => '50.04', //现金支付金额
            'class_b_self_expense' => '10.0', //乙类自理费用
            'class_a_self_expense' => '50.04', //甲乙类费用
            'meet_basic_medical_expenses' => '40.04', //符合基本医疗费用
            'payment_standard' => '0.0', //起付标准自付
            'entry_cost' => '0.0', //进入统筹费用
            'overall_payment_by_sections' => '0.0', //统筹分段自付
            'large_amount' => '0.0', //进入大额段费用
            'large_amount_person' => '0.0', //大额段个人支付
            'excess_amount' => '0.0', //超封顶线个人自付金额
            'health_care_object_payment' => '0.0', //保健对象支付
            'civil_servant_outpatient_amount' => '0.0', //公务员门诊可补助费用
            'class_b_self_proportion' => '0.0', //乙类自理比例
            'overall_class_b_amount' => '0.0', //统筹段乙类自理费用
            'overall_civil_servant_amount' => '0.0', //统筹段公务员补助支付
            'public_supplementary_expenses' => '0.0', //进入公补段费用
            'public_supplementary_class_b_expenses' => '0.0', //公补段乙类自理费用
            'public_supplementary_fund' => '0.0', //公补段基金支付金额
            'public_supplementary_person' => '0.0', //公补段个人支付金额
            'large_amount_class_b' => '0.0', //大额段乙类自理费用
            'overall_fund' => '0.0', //统筹段基金支付比例
            'overall_civil_servant' => '0.0', //统筹段公务员补助比例
            'public_supplementary_civil_servant' => '0.0', //公补段公务员补助比例
            'large_amount_fund' => '0.0', //大额段基金支付比例
            'civil_servant_first_proportion' => '0.0', //公务员门诊第一段补助比例
            'civil_servant_second_proportion' => '0.0', //公务员门诊第二段补助比例
            'civil_servant_third_proportion' => '0.0', //公务员门诊第三段补助比例
            'neonatal_expenses' => '0.0', //新生儿费用
            'public_supplementary_standard' => '0.0', //公补支起付标准
            'public_supplementary_class_b' => '0.0', //公补支乙类自理
            'public_supplementary_overall' => '0.0', //公补支统筹分段自付
            'civil_servant_first_amount' => '0.0', //公务员门诊第一段补助金额
            'civil_servant_second_amount' => '0.0', //公务员门诊第二段补助金额
            'civil_servant_third_amount' => '0.0', //公务员门诊第三段补助金额
            'hospital_times' => '0.0', //本次住院次数
            'bill_no' => '20200305A80200011', //单据号
            'account_balance' => '0.0', //就诊后帐户余额
            'perinatal_allowance' => '0.0', //生育围产补贴(离休冲减上年账户金额)
            'physical_examination_allowance' => '0.0', //体检补贴
            'hospital_commitment' => '0.0', //医院承担金额
            'medical_treatment_category' => '11', //医疗待遇类别
            'supplementary_medical_payment_amount' => '0.0', //补充医疗支付金额
            'transaction_flow_number' => '20200306101420-12032-4276', //交易流号
            'business_cycle_no' => 'ybt', //业务周期号
        ];

        $resultInfo = Settlement::outpatientSettlementWriteBack($params);
        print_r($resultInfo);
    }
	
	/**
     * 门诊正算取消回写（mzzsqxhx）
     */
    public function outpatientSettlementCancelWriteBack()
    {
        $params = [
            'receipt_number' => '20200309A80200001', //收据号
            'business_transaction_code' => '2410', //冲正业务交易编码
            'transaction_serial_numbe' => '20200306101420-12032-4276', //被冲正交易发送方交易流水号
            'correction_reason' => '医保通冲正', //冲正原因
            'developer_logo' => '12032', //开发商标识
        ];

        $resultInfo = Settlement::outpatientSettlementCancelWriteBack($params);
        print_r($resultInfo);
    }
	
	/**
     * 读卡回写（dkhx）
     * ["00224256","61215","吉林省交通科学研究所（CS）","542521198003070216","在职工伤非公务员","2","01","44","19750928","000037426","11","","1","11","0","0","03","0","","31,32,","2020","0","0.0","145.38","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","0.0","10","0.0","0.0","229900","0"]
     */
    public function readWriteBack()
    {
        $params = [
            'patients_id' => '1723024', //病人唯一码
            'personal_number' => '00224256', //个人编号
            'company_number' => '61215', //单位编号
            'company_name' => '吉林省交通科学研究所（CS）', //单位名称
            'card_id' => '542521198003070216', //身份证号
            'name' => '在职工伤非公务员', //姓名
            'sex' => '2', //性别
            'nation' => '01', //民族
            'age' => '44', //年龄
            'birthday' => '19750928', //出生日期
            'social_security_card' => '000037426', //社会保障卡卡号
            'medical_treatment_category' => '11', //医疗待遇类别
            'medical_certificate_number' => '', //医疗证号
            'state' => '1', //参保状态
            'medical_personnel_category' => '11', //医疗人员类别
            'official_logo' => '0', //公务员标志
            'health_care_object_mark' => '0', //保健对象标志
            'special_personnel_sign' => '03', //特殊人员标志
            'non_local_personnel_mark' => '0', //异地人员标志
            'retired_personnel_designated_hospital_code' => '', //离休人员定点医院编码
            'insurance_info' => '31,32,', //险种信息
            'year' => '2020', //年度
            'in_hospital_status' => '0', //在院状态
            'account_balance' => '0.0', //帐户余额
            'this_year_medical_cumulative' => '145.38', //本年医疗费累计
            'this_year_account_cumulative' => '0.0', //本年帐户支出累计
            'this_year_overall_planning_cumulative' => '0.0', //本年统筹支出累计
            'this_year_large_amount_cumulative' => '0.0', //本年大额支出累计
            'this_year_civil_servant_cumulative' => '0.0', //本年公务员支出累计
            'this_year_class_a_b_cumulative' => '0.0', //本年甲乙类费用累计
            'this_year_outpatient_special_disease_cumulative' => '0.0', //本年门诊特病起付标准支付累计
            'this_year_civil_service_clinic_cumulative' => '0.0', //本年公务员门诊可补助费用累计
            'this_year_hospitalization_cumulative' => '0.0', //本年住院起付标准累计
            'this_year_hospitalization_times' => '0.0', //本年住院次数
            'company_type' => '10', //单位类型
            'cards_times' => '0.0', //划卡次数
            'cards_amount' => '0.0', //划卡金额(离休人员上年账户余额)
            'overall_planning_area' => '229900', //所属统筹区
            'industrial_injury_sign' => '0', //工伤标志
        ];

        $resultInfo = Settlement::readWriteBack($params);
        print_r($resultInfo);
    }
	
	/**
     * 科室信息（ksxx）
     */
    public function deptInfo()
    {
        $params = [
            'user' => 'ybt'
        ];

        $resultInfo = Settlement::deptInfo($params);
        print_r($resultInfo);
    }
}
