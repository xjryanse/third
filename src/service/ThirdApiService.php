<?php

namespace xjryanse\third\service;

use xjryanse\system\interfaces\MainModelInterface;

/**
 * 第三方api清单
 */
class ThirdApiService extends Base implements MainModelInterface {

    use \xjryanse\traits\InstTrait;
    use \xjryanse\traits\MainModelTrait;

    protected static $mainModel;
    protected static $mainModelClass = '\\xjryanse\\third\\model\\ThirdApi';

    /**
     *
     */
    public function fId() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     *
     */
    public function fAppId() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     *
     */
    public function fCompanyId() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * api名称
     */
    public function fApiName() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * api分组
     */
    public function fApiGroup() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * api地址
     */
    public function fApiUrl() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 调用方式：get,post
     */
    public function fApiMethod() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * api参数
     */
    public function fApiParam() {
        return $this->getFFieldValue(__FUNCTION__);
    }

    /**
     * 请求结果处理类库
     */
    public function fReflecDealClass() {
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
