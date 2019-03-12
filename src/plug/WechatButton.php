<?php

namespace qcth\wechat_open\plug;



use qcth\wechat_open\plug_trait\CurlTrait;
use qcth\wechat_open\plug_trait\TokenTrait;

/**
 * 自定义菜单
 * Class button
 * @package qcth\open\plug
 */
class WechatButton extends Common {

    use TokenTrait,CurlTrait;


	//创建菜单
	public function create( $button ) {
		$url     = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=' . $this->authorizer_access_token();
		$result_data = $this->curl( $url, $button );

		return json_decode($result_data,true);
	}

	//创建个性化菜单
	public function createAddconditional( $button ) {
		$url     = 'https://api.weixin.qq.com/cgi-bin/menu/addconditional?access_token=' . $this->authorizer_access_token();
        $result_data = $this->curl( $url, json_encode($button) );

        return json_decode($result_data,true);
	}

	//查询微信服务器上菜单
	public function query() {
		$url     = 'https://api.weixin.qq.com/cgi-bin/menu/get?access_token=' . $this->authorizer_access_token();
        $result_data = $this->curl( $url );

        return json_decode($result_data,true);
	}

	//删除菜单
	public function flush() {
		$url     = 'https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=' . $this->authorizer_access_token();
        $result_data = $this->curl( $url );

        return json_decode($result_data,true);
	}

	public function get_menu(){
	    $url="https://api.weixin.qq.com/cgi-bin/get_current_selfmenu_info?access_token=".$this->authorizer_access_token();

        return $result_data = $this->curl( $url );

        return json_decode($result_data,true);


    }

}