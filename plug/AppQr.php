<?php


namespace qcth\open\plug;



use qcth\open\plug_trait\CurlTrait;
use qcth\open\plug_trait\TokenTrait;

/**
 * 获取小程序二维码
 * Class AppQr
 * @package qcth\open\plug
 */
class AppQr extends Common {
    use TokenTrait,CurlTrait;


    //绑定微信用户为小程序体验者
    //$weixin_number 微信号
    public function get_qr($path,$page='/pages/index/index',$width='430'){
        $url="https://api.weixin.qq.com/wxa/getwxacode?access_token={$this->authorizer_access_token()}";

        $post_data['path']=$page;
        $post_data['width']=$width;

        $result_data=$this->curl($url,json_encode($post_data));

       return file_put_contents($path,$result_data);

    }


}
