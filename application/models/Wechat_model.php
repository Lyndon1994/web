<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Wechat_model extends CI_Model
{

    public function __construct()
    {
        $this->load->model('robot_model');
    }

    public function valid()
    {
        $echoStr = $_GET["echostr"];
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $tmpArr = array(TOKEN, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if ($tmpStr == $signature) {
            echo $echoStr;
            exit;
        }
    }

    //响应消息
    public function responseMsg()
    {
        $timestamp = $_GET['timestamp'];

        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)) {
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);

            //消息类型分离
            switch ($RX_TYPE) {
                case "event":
                    $result = $this->receiveEvent($postObj);
                    break;
                case "image":
                    $result = $this->receivePic($postObj);
                    break;

                case "voice":
                    $result = $this->receiveText($postObj, $postObj->Recognition);
                    break;

                case "link":
                    //$contentStr = "感谢你的分享！";
                    break;

                case "location":
                    $result = $this->receiveLocation($postObj);
                    break;
                case "text":
                    $result = $this->receiveText($postObj);
                    break;
            }

            echo $result;
        } else {
            echo "";
            exit;
        }
    }

    //接收事件消息
    private function receiveEvent($object)
    {
        $content = "";
        switch ($object->Event) {
            case "subscribe":
                $content = "感谢你的关注！用微笑面对生活！\n不管怎样的事情，都请安静地愉快吧！这是人生。我们要依样地接受人生，勇敢地、大胆地，而且永远地微笑着。";
                break;
        }

        $result = $this->transmitText($object, $content);
        return $result;
    }

    //接收文本消息
    private function receiveText($object, $Recognition = "")
    {

        $fromUsername = $object->FromUserName; //FromUserName	发送方帐号（一个OpenID）
        $toUsername = $object->ToUserName; //ToUserName	开发者微信号
        //获取用户信息


        //分析接收的文本
        $keyword = $Recognition ? trim($Recognition) : trim($object->Content);
        $keyword = trim($keyword, "。");

        //回复内容预设为空
        $content = "";

        //菜单
        if ($keyword == '？' || $keyword == '?') {
            $content = "不管怎样的事情，都请安静地愉快吧！这是人生。我们要依样地接受人生，勇敢地、大胆地，而且永远地微笑着。";
        }

        // $this->logger($object, $keyword, $fromUsername); //消息日志记录
        // function merge_spaces($string)
        // {
        //     return preg_replace("/\s(?=\s)/", "\\1", $string);
        // }

        // $keyword = merge_spaces($keyword);

        if (!$content) {

            //判断用户有么有注册
            $id = $this->check_register($object);

            if ($keyword == '注册') {
                if ($id != FALSE) {
                    $content = '请输入手机号';
                    // $content = "<a href=\"http://wechat.xidian.ga/users/create?id={$id}\">点此注册>></a>";
                } else {
                    $content = '你已经注册了。';
                }
            } elseif (strlen($keyword) == 11 && preg_match('/^1[3|4|5|7|8][0-9]\d{4,8}$/', $keyword) && $id!= FALSE) {
                $phone = $keyword;
                $code = rand(100000, 999999);
                $data = array(
                    'id' => '' . $id,
                    'phone' => $phone,
                    'code' => $code
                );
                $this->db->insert('tmp', $data);

                //发送验证码
                function curl_get($url)
                {
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $dom = curl_exec($ch);
                    curl_close($ch);
                    return $dom;
                }

                $url = "http://sms.bechtech.cn/Api/send/data/json?accesskey=4788&secretkey=0518bd35d50c18e8151d8b7f7c886dcff8ebeeae&mobile={$phone}&content=" . urlencode("同学您好，验证码：{$code}【魅族校园】");
                $json = curl_get($url);
                $arr = json_decode($json, true); //格式化返回数组
                if ($arr['result'] == '01')
                    $content = '发送成功，请输入6位验证码';
                else
                    $content = '验证码发送失败，请重试。';

            } elseif (strlen($keyword) == 6 && preg_match('/^\d*$/', $keyword) && $id != FALSE) {
                $code = intval($keyword);
                $sql = "select phone,code,time from tmp WHERE id = ? ORDER BY time DESC LIMIT 1";
                $query = $this->db->query($sql, array('' . $id));
                $row = $query->row();
                if ($row->code == $code) {
                    $stime = $row->time;
                    $now = date("Y-m-d H:i:s");
                    $minute = floor((strtotime($now) - strtotime($stime)) / 60);
                    if ($minute > 10) {
                        $content = '验证码过期，请重新输入手机号验证！';
                    } else {
                        //验证成功
                        $data = array(
                            'phone' => $row->phone,
                            'openid' => '' . $id,
                        );
                        $this->db->insert('users', $data);
                        $content = '恭喜您，注册成功！';
                    }
                } else {
                    $content = '输入验证码错误，请重新输入。';
                }
            } elseif ($keyword == '借伞') {
                $content = 'please hold on...';
            } elseif ($keyword == 'lr') {
                date_default_timezone_set('PRC');
                $today = date("y-m-d H:i:s");
                $love = "2014-10-4 20:20:00";
                $time = strtotime($today) - strtotime($love);
                $date = floor(($time) / 86400);
                $hour = floor(($time) % 86400 / 3600);
                $minute = floor(($time) % 86400 % 3600 / 60);
                $second = floor(($time) % 86400 % 60);
                $content = $date . "天" . $hour . "小时" . $minute . "分钟" . $second . "秒";
            } else
                $content = $this->robot_model->getText($keyword);
        }

        if ($content) {
            if (is_array($content)) {
                if (isset($content[0])) {
                    $result = $this->transmitNews($object, $content);
                } else
                    if (isset($content['MusicUrl'])) {
                        $result = $this->transmitMusic($object, $content);
                    }
            } else {
                $result = $this->transmitText($object, $content);
            }
            return $result;
        }

    }

//接收图片消息
    private
    function receivePic($object)
    {
        $fromUsername = $object->FromUserName; //FromUserName	发送方帐号（一个OpenID）
        $userPicUrl = $object->PicUrl;

        $faceUrl = "http://apicn.faceplusplus.com/v2/detection/detect?api_key=25dabb8d404d683329b1553e70bce75c&api_secret=9KuQDlHD7PT5qEYExasHq6nAtBhUC8Uh&url={$userPicUrl}&mode=oneface";
        $facestr = file_get_contents($faceUrl);
        $faceson = json_decode($facestr);
        $picAgeValue = $faceson->face[0]->attribute->age->value;
        $picAgeRange = $faceson->face[0]->attribute->age->range;
        $picGender = $faceson->face[0]->attribute->gender->value;
        $picRace = $faceson->face[0]->attribute->race->value;
        $picSmiling = $faceson->face[0]->attribute->smiling->value;
        if ($picAgeValue) {
            if ($picGender == "Male") {
                $content = "小薇觉得他好像" . $picAgeValue . "岁了。\n他的种族为：" . $picRace . "。\n他的微笑程度为：" . $picSmiling . "/100.";
            } else {
                $content = "小薇觉得她好像" . $picAgeValue . "岁了。\n她的种族为：" . $picRace . "。\n她的微笑程度为：" . $picSmiling . "/100.";
            }

        } else {
            $content = "你的图片真不错！";
        }

        $result = $this->transmitText($object, $content);
        return $result;
    }

//接收位置消息
    private
    function receiveLocation($object)
    {

        //我的位置
        $mylatitude = $object->Location_X; //纬度
        $mylongitude = $object->Location_Y; //经度
        $myplace = $object->Label; //地理位置信息

        $content = $myplace . "\n经度：" . $mylongitude . "\n纬度：" . $mylatitude;
        $result = $this->transmitText($object, $content);

        return $result;
    }

//回复文本消息
    private
    function transmitText($object, $content)
    {
        $this->logger($object, $content, "比卡丘"); //消息日志记录
        $xmlTpl = "<xml>
					    <ToUserName><![CDATA[%s]]></ToUserName>
					    <FromUserName><![CDATA[%s]]></FromUserName>
					    <CreateTime>%s</CreateTime>
					    <MsgType><![CDATA[text]]></MsgType>
					    <Content><![CDATA[%s]]></Content>
					</xml>";
        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), $content);
        return $result;
    }

//回复图文消息
    private
    function transmitNews($object, $newsArray)
    {
        if (!is_array($newsArray)) {
            return;
        }
        $itemTpl = "<item>
			            <Title><![CDATA[%s]]></Title>
			            <Description><![CDATA[%s]]></Description>
			            <PicUrl><![CDATA[%s]]></PicUrl>
			            <Url><![CDATA[%s]]></Url>
			        </item>";
        $item_str = "";
        foreach ($newsArray as $item) {
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
        }
        $xmlTpl = "<xml>
					    <ToUserName><![CDATA[%s]]></ToUserName>
					    <FromUserName><![CDATA[%s]]></FromUserName>
					    <CreateTime>%s</CreateTime>
					    <MsgType><![CDATA[news]]></MsgType>
					    <ArticleCount>%s</ArticleCount>
					    <Articles>$item_str</Articles>
					</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), count($newsArray));
        return $result;
    }

//回复音乐消息
    private
    function transmitMusic($object, $musicArray)
    {
        $itemTpl = "<Music>
				        <Title><![CDATA[%s]]></Title>
				        <Description><![CDATA[%s]]></Description>
				        <MusicUrl><![CDATA[%s]]></MusicUrl>
				        <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
				    </Music>";

        $item_str = sprintf($itemTpl, $musicArray['Title'], $musicArray['Description'], $musicArray['MusicUrl'], $musicArray['HQMusicUrl']);

        $xmlTpl = "<xml>
					    <ToUserName><![CDATA[%s]]></ToUserName>
					    <FromUserName><![CDATA[%s]]></FromUserName>
					    <CreateTime>%s</CreateTime>
					    <MsgType><![CDATA[music]]></MsgType>
					    $item_str
					</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

//日志记录//" . date("Y-m-d H:i:s") . "
    private
    function logger($object, $message, $name)
    {
        // $fromUsername = $object->FromUserName; //FromUserName	发送方帐号（一个OpenID）
        // require_once 'connect.php';
        // $sql = "INSERT INTO `log` (`id`, `name`, `content`, `time`, `user_id`) VALUES (NULL, '" . $name . "', '" . $message . "', NULL ,'" . $fromUsername . "')";
        // $mysql->runSql($sql);
    }

    private
    function check_register($object)
    {
        $userOpenId = $object->FromUserName;//获取用户OPENId
        $sql = "SELECT id FROM users WHERE openid = ?";
        $query = $this->db->query($sql, array(''.$userOpenId));
        if ($query->num_rows() > 0) {
            //已经注册！
            return FALSE;
        }
        return $userOpenId;
    }
}
