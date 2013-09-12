<?php
include("wx_tpl.php");
// define your token
define("TOKEN", "kavichen");
$wechatObj = new wechatCallback();
$wechatObj->responseMsg();
// $wechatObj->valid();
// $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

class wechatCallback
{
    // include("wx_tpl.php");
    public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }

    public function responseMsg()
    {
        //get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        //extract post data
        if (!empty($postStr)){

            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);

            switch($RX_TYPE)
            {
            case "text":
                $resultStr = $this->handleText($postObj);
                break;
            case "event":
                $resultStr = $this->handleEvent($postObj);
                break;
            default:
                $resultStr = "Unknow msg type: ".$RX_TYPE;
                break;
            }
            echo $resultStr;
        }else {
            echo "";
            exit;
        }
    }

    public function handleText($postObj)
    {
        include("wx_tpl.php");
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $keyword = trim($postObj->Content);
        $time = time();
        // include("wx_tpl.php");
        // $textTpl = "<xml>
        //             <ToUserName><![CDATA[%s]]></ToUserName>
        //             <FromUserName><![CDATA[%s]]></FromUserName>
        //             <CreateTime>%s</CreateTime>
        //             <MsgType><![CDATA[%s]]></MsgType>
        //             <Content><![CDATA[%s]]></Content>
        //             <FuncFlag>0</FuncFlag>
        //             </xml>";             
        if(!empty( $keyword ))
        {
            $msgType = "text";
            // 天气 
            $str = mb_substr($keyword, -2, 2,"UTF-8");
            $str_key = mb_substr($keyword, 0, -2,"UTF-8");
            if(($str == '天气' || $str == '天氣') && !empty($str_key))
            {
                $data = $this->weather($str_key);
                if(empty($data->weatherinfo)){
                    $contentStr = "干，没有查到\"".$str_key."\"的天气信息！";
                }
                else
                {
                    $contentStr =
                        "【".$data->weatherinfo->city."天气预报】\n".$data->weatherinfo->date_y." ".$data->weatherinfo->fchh."时发布"."\n\n实时天气\n".$data->weatherinfo->weather1." ".$data->weatherinfo->temp1." ".$data->weatherinfo->wind1."\n\n温馨提示：".$data->weatherinfo->index_d."\n\n明天\n".$data->weatherinfo->weather2." ".$data->weatherinfo->temp2." ".$data->weatherinfo->wind2."\n\n后天\n".$data->weatherinfo->weather3." ".$data->weatherinfo->temp3." ".$data->weatherinfo->wind3;
                }
            }
            else if($str == '订阅')
            {
                $resultStr = "<xml>\n
                <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
                <FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
                <CreateTime>".time()."</CreateTime>\n
                <MsgType><![CDATA[news]]></MsgType>\n
                <ArticleCount>1</ArticleCount>\n
                <Articles>\n";
                $resultStr .="<item>\n
                <Title><![CDATA[test]]></Title>\n
                <Description><![CDDTA[test]]></Description>\n
                <PicUrl><![CDATA[http://chenqiwei.com/profile/8bit.jpg]]</PicUrl>\n
                <Url><![CDATA[http://chenqiwei.com]]></Url>\n
                </item>\n";
                /*
                 *$resultStr .= "<item>\n <Title><![CDATA[test2]]></Title>\n <Description><![CDATA[]]></Description>\n <PicUrl><![CDATA[http://chenqiwei.com/profile/8bit.jpg]]</PicUrl>\n <Url><![CDATA[http://chenqiwei.com]]</Url>\n </item>\n";
                 */
                $resultStr .="</Articles>\n
                              </xml>";
                echo $resultStr;
                break;
                /*
                 *$msgType = "text";
                 *$contentStr = "陈琦威：".
                 *    "\n";
                 */
            }
            else
            {
                $msgType = "text";
                $contentStr = "陈琦威：".
                    "\n".
                    "平台目前处于开发阶段，我可以收到你发过来的信息，但是不能处理，请见谅！";
            }
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            echo $resultStr;
        }else{
            echo "Input something...";
        }
    }

    public function handleEvent($object)
    {
        //$contentStr = "";
        $resultStr = "";
        $fromUsername = $object->FromUserName;
        $toUsername = $object->ToUserName;
        switch ($object->Event)
        {
        case "subscribe":
            $resultStr = "<xml>\n
                <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
                <FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
                <CreateTime>".time()."</CreateTime>\n
                <MsgType><![CDATA[news]]></MsgType>\n
                <ArticleCount>2</ArticleCount>\n
                <Articles>\n";
            $resultStr .="<item>\n
                <Title><![CDATA[test]]></Title>\n
                <Description><![CDDTA[]]></Description>\n
                <PicUrl><![CDATA[http://chenqiwei.com/profile/8bit.jpg]]</PicUrl>\n
                <Url><![CDATA[http://chenqiwei.com]]</Url>\n
                </item>\n";
            $resultStr .= "<item>\n <Title><![CDATA[test2]]></Title>\n <Description><![CDATA[]]></Description>\n <PicUrl><![CDATA[http://chenqiwei.com/profile/8bit.jpg]]</PicUrl>\n <Url><![CDATA[http://chenqiwei.com]]</Url>\n </item>\n";
             /*
              *$resultStr = "<xml>\n
              *   <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
              *   <FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
              *   <CreateTime>".time()."</CreateTime>\n
              *   <MsgType><![CDATA[news]]></MsgType>\n
              *   <ArticleCount>2</ArticleCount>\n
              *   <Articles>\n
              *   <item>\n
              *   <Title><![CDATA[test]]></Title>\n
              *   <Description><![CDDTA[]]></Description>\n
              *   <PicUrl><![CDATA[http://chenqiwei.com/profile/8bit.jpg]]</PicUrl>\n
              *   <Url><![CDATA[http://chenqiwei.com]]</Url>\n
              *   </item>\n
              *   <item>\n
              *   <Title><![CDATA[test2]]></Title>\n
              *   <Description><![CDATA[]]></Description>\n
              *   <PicUrl><![CDATA[http://chenqiwei.com/profile/8bit.jpg]]</PicUrl>\n
              *   <Url><![CDATA[http://chenqiwei.com]]</Url>\n
              *   </item>\n
              *   </Articles>\n
              *   </xml>";
              */
            /*
             *$resultStr .="<item>\n
             *    <Title><![CDATA[test1]]></Title>\n
             *    <Description><![CDDTA[]]</Description>\n
             *    <PicUrl><![CDATA[http://chenqiwei.com/profile/8bit.jpg]]</PicUrl>\n
             *    <Url><![CDATA[http://chenqiwei.com]]</Url>\n
             *    </item>\n";
            <FuncFlag>0</FuncFlag>\n

             */
            $resultStr .="</Articles>\n
                </xml>";
            break;
        default :
            $contentStr = "Unknow Event: ".$object->Event;
            break;
        }
        return $resultStr;
    }

    public function responseText($object, $content, $flag=0)
    {
        // include("wx_tpl.php");
        $textTpl = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[text]]></MsgType>
            <Content><![CDATA[%s]]></Content>
            <FuncFlag>%d</FuncFlag>
            </xml>";
        $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content, $flag);
        return $resultStr;
    }

    private function weather($n){
        include("weather_cityId.php");
        $c_name = $weather_cityId[$n];
        if(!empty($c_name)){
            $json=file_get_contents("http://m.weather.com.cn/data/".$c_name.".html");
            return json_decode($json);
        }
        else
        {
            return $c_name;
        }
    }

    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];    

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
}

?>
