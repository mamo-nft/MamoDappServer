<?php
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

function http_post_json($url, $jsonStr)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($jsonStr)
        )
    );
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
 
    return array($httpCode, $response);
}

/*
$servername = "localhost";
$username = "mamo";
$password = "admin1";
// 创建连接
$conn = mysqli_connect($servername, $username, $password);
mysqli_select_db($conn,'mamo');
// 检测连接
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = 'SELECT * FROM `swap` WHERE `ID` = 1';
$mysqli_result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($mysqli_result);
$time = $row['time'];
mysqli_free_result($mysqli_result);
*/

$url = "https://bsc.streamingfast.io/subgraphs/name/pancakeswap/exchange-v2";
$jsonStr = json_encode(array('query' => 'query poolTransactions {
  swaps(first: 10, orderBy: timestamp, orderDirection: desc, where: {pair: "0x3597852fa8308b67945c5dc2c5023f41575ee8b4", timestamp_gt: '.$time.', amount0In_gt: 0 }) {
    from
    amount0In
    amount1In
    amount0Out
    amount1Out
    amountUSD
    timestamp
  }
}'));
$data = http_post_json($url, $jsonStr);
$data1=json_decode($data[1], true);
//var_dump($data1);
//count($data1["data"]["swaps"]);
$times = 600 - intval(910/100)*60;
if($times <= 30){
  $times = 30;
}
if($data1["data"]["swaps"][0]["timestamp"] >= $time+$times){
  $sql = 'UPDATE `swap` SET `time`=`time`+30 WHERE `ID`= 1';
  if (/*mysqli_query($conn, $sql)*/1==1) {
    echo '{"state":0,"address":"'.$data1["data"]["swaps"][0]["from"].'"}';
  } else {
    echo '{"state":3,"address":"0x0"}';
  }
}else{
  $sql = 'UPDATE `swap` SET `time`='.$data1["data"]["swaps"][0]["timestamp"].' WHERE `ID`= 1';
  if (/*mysqli_query($conn, $sql)*/1==1) {
    echo '{"state":1,"address":"0x0"}';
  } else {
    echo '{"state":3,"address":"0x0"}';
  }
}
//mysqli_close($conn);
?>
