<?php
/*
//登入APP抓包會有一排"mac":"' . $mac . '","androidid":"' . $androidid . '","model":"' . $model . '","nettype":"","appname":"' . $appname . '"}';

$mac = '你這邊要改自己';//
$androidid = '你這邊要改自己登入抓包數據';  
$model = '自己設備'; //手機或者模擬器 設備代號
$appname = 'Pn播放器'; //APP名字稱號
$packagename = 'com.phon.player';//反編譯過後的封包名

駱駝壳沒甚麼  就DATA  而已
data+md5 +mac
*/
error_reporting(0);
header('Content-Type: text/json;charset=UTF-8',true,200);

$url = $_GET["url"];

if(empty($url)){
$init = init(10);
$data = getlist(15);
print_r($data);
}else{
$playurl = geturl(urldecode(base64_decode($url)),3);
header('Location: '.$playurl,true,302);
}

function geturl($url,$timeout){
$headers = array(
'User-Agent: AppleWebKit/537.36 (KHTML, like Gecko) AppTV/1.0',
'Accept: */*',
'Range: bytes=0-',
'Connection: close',
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_TIMEOUT,$timeout);
$result = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);
if($info["http_code"] == 200){
return $data;
}
if($info["http_code"] == 302){
return $info["redirect_url"];
}
if($info["http_code"] == 404){
return "404";
}}

/*------随机生成mac地址12位数字符串-----*/
function generateMacAddress() {
    $hexDigits = '0123456789abcdef';
    $mac = '';
    for ($i = 0; $i < 6; $i++) {
        $segment = '';
        for ($j = 0; $j < 2; $j++) {
            $segment .= $hexDigits[rand(0, 15)];
        }
        $mac .= $segment;
        if ($i < 5) $mac .= ':';
    }
    return $mac;
}


/*------随机生成16位数的16进制字符串id---*/
function generateAndroidID() {
    $hexChars = '0123456789abcdef'; //16进制的字符集
    $androidID = '';// 初始化空字符串
        // 循环生成16位的16进制字符串
    for ($i = 0; $i < 16; $i++) {
        // 随机选择一个16进制字符添加到字符串中
        $androidID .= $hexChars[rand(0, strlen($hexChars) - 1)];
    }    
    return $androidID;
}


function getlist($timeout){
// 使用函数生成一个12位MAC地址并将其赋值给变量 $mac
$mac = generateMacAddress();
//$mac = '55:01:a3:f1:21:32';
//$androidid = 'f3a392ffeacb2f1e';
// 随机生成16位数的16进制字符串
$androidid = generateAndroidID();
$model = 'X98_Pro';
$appname = 'Pn播放器';
$packagename = 'com.phon.player';
$loginurl = 'https://tv02.freepy.cc/login241.php';
$body = 'login={"region":"广东","mac":"' . $mac . '","androidid":"' . $androidid . '","model":"' . $model . '","nettype":"","appname":"' . $appname . '"}';
$header = array(
"accept: */*",
"connection: Keep-Alive",
"user-agent: MSIE AppTV/1.0",
"Content-Type: application/x-www-form-urlencoded",
"Accept-Encoding: gzip",
"Content-Length: ".strlen($body),
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $loginurl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
curl_setopt($ch, CURLOPT_ENCODING,'gzip');
curl_setopt($ch, CURLOPT_TIMEOUT,$timeout);
$result = curl_exec($ch);
curl_close($ch);
$key = md5('10889'.$appname.$packagename.'AD80F93B542B');
$key = md5($key.$appname.$packagename);
$loginkey = substr($key,5,16);
$logindata = openssl_decrypt(trim($result),'AES-128-ECB',$loginkey,0);
$data = json_decode($logindata);
$randkey = $data->randkey;
$url = $data->dataurl;
$body = 'data={"region":"广东","nettype":"佛山联通","rand":"'.$randkey.'","mac":"'.$mac.'","androidid":"'.$androidid.'","model":"'.$model.'","appname":"'.$appname.'"}';
$header = array(
"accept: */*",
"connection: Keep-Alive",
"user-agent: MSIE AppTV",
"Content-Type: application/x-www-form-urlencoded",
"Host: tv02.freepy.cc",
"Accept-Encoding: gzip",
"Content-Length: ".strlen($body),
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, trim($url));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
curl_setopt($ch, CURLOPT_ENCODING,'gzip');
curl_setopt($ch, CURLOPT_TIMEOUT,$timeout);
$result = curl_exec($ch);
curl_close($ch);
$datakey = md5($key.$randkey);
$datakey = substr($datakey,7,16);
$data = substr($result,148);
$data=str_replace("g", "#", $data);
$data=str_replace("t", "g", $data);
$data=str_replace("#", "t", $data);
$data=str_replace("b", "&", $data);
$data=str_replace("f", "b", $data);
$data=str_replace("&", "f", $data);
$list = openssl_decrypt($data,'AES-128-ECB',$datakey,0);
$str = gzuncompress(base64_decode($list));
$data = json_decode($str);
$count = count($data);
for($i=1;$i<$count;$i++){
$final.=lists($data[$i]);
}
return $final;
}

function lists($data){
$result.=$data->name.",#genre#"."\n";
$data = $data->data;
$count = count($data);
for($i=0;$i<$count;$i++){
$pro = $_SERVER['HTTP_X_FORWARDED_PROTO'];
if(empty($pro)){
$pro = $_SERVER['REQUEST_SCHEME'];
if(empty($pro)){
$pro = json_decode($_SERVER['HTTP_CF_VISITOR'])->scheme;
if(empty($pro)){
$pro = "http";
}}}
$server = $pro."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$result.=$data[$i]->name.","."{$server}?url=".base64_encode(urlencode($data[$i]->source[0]))."\n";
}
return $result;
}

function init($timeout){
$url = 'https://tv02.freepy.cc/anv240.php';//直接访问获取软件更新
$header = array(
"User-Agent: Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_0 like Mac OS X; en-us) AppleWebKit/532.9 (KHTML, like Gecko) Version/4.0.5 Mobile/8A293 Safari/6531.22.7",
"Connection: Keep-Alive",
"Accept-Encoding: gzip",
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_ENCODING,'gzip');
curl_setopt($ch, CURLOPT_TIMEOUT,$timeout);
$result = curl_exec($ch);
curl_close($ch);
}
?>
