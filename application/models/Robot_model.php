<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Robot_model extends CI_Model {

	private function getPicText($title, $chatJson, $cText, $other = "") {
		$cList = $chatJson['list'];
		$content = array();
		$content[] = array("Title" => $cText, "Description" => "", "PicUrl" => "", "Url" => "");
		$i = 0;
		foreach ($cList as $key => $val) {
			if ($i > 9) {
				break;
			}
			$content[] = array("Title" => $val[$title] . "\n" . ($other ? $val[$other] : ""), "Description" => "", "PicUrl" => $val['icon'], "Url" => $val['detailurl']);
			$i++;
		}
		return $content;
	}
	public function getText($keyword="") {
		$chatURL = "http://www.tuling123.com/openapi/api?key=d4979a14a52ec4bdf6a46a300a4b04b4&info={$keyword}";
		$ch = curl_init();
		$timeout = 5;
		curl_setopt ($ch, CURLOPT_URL, $chatURL);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$chatStr = curl_exec($ch);
		curl_close($ch);
		
		//$chatStr = file_get_contents($chatURL);
		
		$chatJson = json_decode($chatStr, true);
		$code = $chatJson['code'];
		$cText = $chatJson['text'];
		$cUrl = $chatJson['url'];

		switch ($code) {
		case '100000':
			$content = $cText;
			break;

		case '200000':
			$content = $cText . $cUrl;
			break;

		case '301000':
			$content = "自己百度吧[呲牙]";
			break;

		case '302000':
			$content = getPicText('article', $chatJson, $cText);
			break;

		case '304000':
			$content = getPicText('name', $chatJson, $cText);
			break;

		case '305000':
			$cList = $chatJson['list'];
			$content = array();
			$content[] = array("Title" => $cText, "Description" => "", "PicUrl" => "", "Url" => "");
			$i = 0;
			foreach ($cList as $key => $val) {
				if ($i > 9) {
					break;
				}
				$content[] = array("Title" => $val['start'] - $val['terminal'] . "\n" . $val['trainnum'] . " " . $val['starttime'],
					"Description" => "", "PicUrl" => $val['icon'], "Url" => $val['detailurl']);
				$i++;
			}
			break;

		case '306000':
			$cList = $chatJson['list'];
			$content = array();
			$content[] = array("Title" => $cText, "Description" => "", "PicUrl" => "", "Url" => "");
			$i = 0;
			foreach ($cList as $key => $val) {
				if ($i > 9) {
					break;
				}
				$content[] = array("Title" => $val['flight'] . "\n" . $val['route'] . " " . $val['starttime'] . " " . $val['endtime'],
					"Description" => "", "PicUrl" => $val['icon'], "Url" => $val['detailurl']);
				$i++;
			}
			break;

		case '307000':case '309000':case '311000':case '312000':
			$content = getPicText('name', $chatJson, $cText, 'price');
			break;

		case '308000':
			$content = getPicText('name', $chatJson, $cText, 'info');
			break;

		case '310000':
			$content = getPicText('info', $chatJson, $cText, 'number');
			break;
		}
		return $content;
	}

}