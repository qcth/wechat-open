<?php


namespace qcth\wechat_open\plug;



use qcth\wechat_open\plug_trait\CurlTrait;
use qcth\wechat_open\plug_trait\TokenTrait;

/**
 * 微信二维码
 * Class Qrcode
 * @package qcth\open\plug
 */
class WechatQrcode extends Common {
    use CurlTrait,TokenTrait;


	/**
	 * @param int $scene_id 自行设定的参数(第几个二维码）
	 * @param int $expire 正数为临时二维码 0 永久二维码
	 *
	 * @return bool
	 */
	public function createQrcode( $scene_id = 0, $expire = 0 ) {

		if ( $expire ) {
			//临时二维码
			$data = [ 'action_name'    => 'QR_SCENE',
			          'expire_seconds' => 2592000,
			          'action_info'    => [ 'scene' => [ 'scene_id' => $scene_id ] ]
			];
		} else {
			//永久二维码
			//永久二维码只能在1~100000
			if ( $scene_id < 1 || $scene_id > 100000 ) {
				$scene_id = 1;
			}
			$data = [ 'action_name' => 'QR_LIMIT_SCENE', 'action_info' => [ 'scene' => [ 'scene_id' => $scene_id ] ] ];
		}

		$url     = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=' . $this->authorizer_access_token();
		$content = $this->curl( $url, json_encode( $data ) );
		$result  = json_decode($content,true);
		
		
		return isset( $result['ticket'] ) ? $result['ticket'] : false;
	}

	//通过ticket换取二维码
	public function getQrcode( $ticket ) {
		$ticket = urlencode( $ticket );

		return "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=$ticket";
		
		//header( 'location:' . $url );  //跳转后，直接展示二维码
	}
	
	//下载二维码
	
	private function download_image(){
		
	}

}