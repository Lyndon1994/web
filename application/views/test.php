<?php
phpinfo();?>
function get($url,$array='0')
{
    if ($array=='0') //浏览器信息为空
    {$array= array(
        'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.152 Safari/537.36',
        "Referer: {$url}",
    );}
    $ch = curl_init($url); //初始化
    curl_setopt($ch, CURLOPT_HEADER, 0); //不返回header部分
//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1 ); // 使用自动跳转有些报错
    curl_setopt($ch, CURLOPT_HTTPHEADER, $array); //发送模拟信息数组需换行 $post_array= array('Accept-Encoding: gzip');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //返回字符串，而非直接输出源码
    curl_setopt($ch, CURLOPT_TIMEOUT,3);   //超时的秒数
    $curl=curl_exec($ch);
    curl_close($ch);
    return $curl;
}

$M="天枰座";
//利用百度检测纠正字符
$url = "http://m.baidu.com/s?word={$M}";
$url = get($url);
if ( strstr($url,'correct-q') )
{
    $preg = '#class="correct-q">(.*)</a>#iUs'; //#开头  尾部#iUs';
    preg_match_all($preg,$url,$zz);
    $a=$zz[1][0];
    echo "您要找的是不是：{$a}\n请重新输入正确的名字。";
}
else {
    echo '没有';
}