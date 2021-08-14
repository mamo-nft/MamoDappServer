<?
//跨域配置 start
header('content-type:application:json;charset=utf8');
$origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';
$allowOrigins = array(
	'http://localhost:8080',
    'http://127.0.0.1:8848',
	'http://www.mamonft.com'
);
if(in_array($origin, $allowOrigins)){
    //$origin = '*';
    header('Access-Control-Allow-Origin:'.$origin);
}
header('Access-Control-Allow-Credentials:true');
header('Access-Control-Allow-Methods:GET,POST,PUT,OPTIONS');
header('Access-Control-Allow-Headers:x-requested-with,content-type,Authori-zation,Token');
//处理预检信息
if($_SERVER['REQUEST_METHOD']=='OPTIONS'){
    header('Access-Control-Max-Age:3600');//1小时内无需再次预检
    //返回204
    if(PHP_VERSION >= 5.4){
        http_response_code('204');
    }else{
        header('HTTP/1.1 204 No Content');
    }
    exit;
}
// 跨域 end

$redis = new Redis();
$redis->connect('127.0.0.1', '6379');
$redis->auth('m3uIsFelacOVil65'); //密码验证
$redis->select(1);
$dexList = $redis->get("DEX_LIST");
print($dexList);
?>