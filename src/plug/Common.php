<?php

namespace qcth\wechat_open\plug;

/**
 * Class Common  插件父类
 * @package qcth\open\plug
 */
class Common{

    protected $config; //配置项数组
    //标识是小程序还是公众平台
    protected $type_name;

    public function __construct($config=null){
        if(!is_null($config)){
            //赋值配置项
            $this->config=$config;
        }

        //子类初始化
        if(method_exists($this,'_init')){
            $this->_init();
        }

        //设置标识
        $this->get_config();
    }

    //设置标识,,区分是小程序还是公众平台
    private function get_config(){
        //当前调用的类名
        $class_name=end(explode('\\',static::class));
        //类前缀
        $class_pre=strtolower(substr($class_name,0,6));

        if($class_pre=='wechat'){   //微信
            $this->type_name='weixin';
        }else{                    //小程序
            $this->type_name='small';
        }

    }
}