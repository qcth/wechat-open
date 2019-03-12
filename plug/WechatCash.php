<?php

namespace qcth\open\plug;



use qcth\app\library_ext\GetRandStrTrait;
use qcth\open\plug_trait\CurlTrait;
use qcth\open\plug_trait\MakeSignTrait;
use qcth\open\plug_trait\XmlTrait;

/**
 * 微信红包
 * Class cash
 * @package qcth\open\plug
 */
class WechatCash extends Common {
    use GetRandStrTrait,MakeSignTrait,CurlTrait,XmlTrait;

	//发布现金红包
	public function sendRedPack( $data ) {
		$data['mch_billno'] = time();
		$data['mch_id']     = $this->config['weixin']['mch_id'];
		$data['wxappid']    = $this->config['weixin']['authorizer_appid'];
		$data['total_num']  = "1";//红包发放总人数
		$data['client_ip']  = $_SERVER['REMOTE_ADDR'];
		$data['nonce_str']  = $this->get_rand_str( 16 );
		$data['sign']       = $this->make_sign( $data );
		$xml                = $this->array_to_xml( $data );
		$res                = $this->curl_post_ssl( "https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack", $xml );

		return $this->xml_to_array( $res );
	}


}