<?php

namespace xjryanse\third\service;

use xjryanse\system\interfaces\MainModelInterface;
use xjryanse\system\service\SystemErrorLogService;
use xjryanse\logic\Arrays;
use xjryanse\logic\Debug;
use xjryanse\curl\Query;
use think\facade\Request;
use Exception;

/**
 * 第三方api调用日志
 */
class ThirdApiLogService extends Base implements MainModelInterface {

    use \xjryanse\traits\InstTrait;
    use \xjryanse\traits\MainModelTrait;

    protected static $mainModel;
    protected static $mainModelClass = '\\xjryanse\\third\\model\\ThirdApiLog';

    /**
     * 根据apiId和请求参数调用
     * @param type $apiId   
     * @param type $param   
     * @param type $appId   指定的appId，无时使用默认
     */
    public static function queryAndLog( $apiId, $param = [],$appId=''){
        if(self::mainModel()->inTransaction()){
            throw new Exception('请不要在事务中操作远程接口调用');
        }
        //无时使用默认
        $info = ThirdApiService::getInstance( $apiId )->getWithApp( $appId );
        if($info['api_param']){
            $paramCov   = json_decode($info['api_param'],JSON_UNESCAPED_UNICODE);
            $param      = Arrays::keyReplace($param, $paramCov);
        }

        try {
            $url            = Arrays::value($info, 'api_url');
            $method         = Arrays::value($info, 'api_method');
            $codeField      = Arrays::value($info, 'code_field');
            $data['ip']     = Request::ip();
            $data['brand_id']       = Arrays::value($info, 'brand_id');
            $data['third_app_id']   = Arrays::value($info, 'thirdAppId');
            $data['api_id'] = $apiId;
            $data['url']    = $url;
            $parseUrl       = parse_url($url); 
            $data['url_ip'] = gethostbyname( $parseUrl['host'] );
            $data['header'] = '';
            $data['param']  = json_encode($param, JSON_UNESCAPED_UNICODE);
            Debug::debug('$param', $param);
            if( strtolower($method) == 'post' ){
                $res = Query::post($url, $param);
            } else {
                $res = Query::geturl($url, $param);
            }
            Debug::debug('$res', $res);

            $data['code']       = Arrays::value($res, $codeField);
            $data['response']   = json_encode($res, JSON_UNESCAPED_UNICODE);

            $log = self::save($data);
            return ['log_id'=>$log['id'],'res'=>$res];   //log:记录的日志信息,res 接口原样返回
        } catch (\Exception $e) {
            //不报异常，以免影响访问
            SystemErrorLogService::exceptionLog($e);  
        }
    }
    
    /**
     * 提取记录并转化
     */
    public function getWithCov()
    {
        $info = $this->get();
        if($info){
            $info['param'] = json_decode($info['param'], JSON_UNESCAPED_UNICODE);
            $info['response'] = json_decode($info['response'], JSON_UNESCAPED_UNICODE);
        }
        return $info;
    }
    
    /**
     *
     */
    public function fId() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 应用id
     */
    public function fAppId() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 公司id
     */
    public function fCompanyId() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * _third_api表的id
     */
    public function fApiId() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 访问ip
     */
    public function fIp() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     *
     */
    public function fUrl() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 目标url的ip
     */
    public function fUrlIp() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 请求头部
     */
    public function fHeader() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 请求参数
     */
    public function fParam() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 返回结果状态码
     */
    public function fCode() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 返回结果参数
     */
    public function fResponse() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 排序
     */
    public function fSort() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 状态(0禁用,1启用)
     */
    public function fStatus() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 有使用(0否,1是)
     */
    public function fHasUsed() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 锁定（0：未锁，1：已锁）
     */
    public function fIsLock() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 锁定（0：未删，1：已删）
     */
    public function fIsDelete() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 备注
     */
    public function fRemark() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 创建者，user表
     */
    public function fCreater() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 更新者，user表
     */
    public function fUpdater() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 创建时间
     */
    public function fCreateTime() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 更新时间
     */
    public function fUpdateTime() {
        return $this->getFFieldValue(__FUNCTION__);
    }

}
