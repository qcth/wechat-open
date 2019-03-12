<?php


namespace qcth\open\plug;


use qcth\open\plug_trait\CurlTrait;
use qcth\open\plug_trait\TokenTrait;

/**
 * 小程序客服消息
 * Class AppPlug
 * @package qcth\open\plug
 */
class AppSendMsg extends Common {
    use TokenTrait,CurlTrait;


    //发送
    public function send_msg($xml_obj,$content){
        $url="https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={$this->authorizer_access_token()} ";

        $post_data['touser']=$xml_obj->FromUserName;
        $post_data['msgtype']="text";
        $post_data['text']=["content"=>$content];

        $this->curl($url,json_encode($post_data));die;
    }

}
