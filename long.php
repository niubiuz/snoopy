<?php
//header("Content-Type:text/html;charset=utf-8");
include "Snoopy.class.php";
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
ignore_user_abort(); //即使Client断开(如关掉浏览器)，PHP脚本也可以继续执行.
set_time_limit(0); // 执行时间为无限制，php默认执行时间是30秒，可以让程序无限制的执行下去
//$interval=24*60*60; // 每隔一天运行一次
$interval=22*60;

    
//file_put_contents("log.log",$msg,FILE_APPEND);//记录日志
//$sql="update blog set time=now()";
function getRandNum($length){
	$str = null;
	$strPol = "01234567891234567890";
	$max = strlen($strPol)-1;

	for($i=0;$i<$length;$i++){
		$str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
	}

	return $str;
}

function getRandChar($length){
	$str = null;
	$strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
	$max = strlen($strPol)-1;

	for($i=0;$i<$length;$i++){
		$str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
	}

	return $str;
}
//echo getRandNum(5);
//echo getRandChar(5);
for($i=0;$i<=100;$i++){
    
$nr=getRandNum(6);
$ur=getRandChar(6);
echo $ur.'----';
echo $nr.'----';
$str=$ur.$nr."\n";
$open=fopen("log4.txt","a+" );
fwrite($open,$str);
fclose($open);
$snoopy = new Snoopy;
$snoopy->fetch('http://bbs.scol.com.cn/member.php?mod=register');

preg_match('/<input\s*type="hidden"\s*name="formhash"\s*value="(.*?)"\s*\/>/i', $snoopy->results, $matches);
if(!empty($matches)) {
    $formhash = $matches[1];
    echo $formhash;
} else {
    die('Not found the forumhash.');
}
preg_match('/<input\s*type="checkbox"\s*class="pc"\s*name="agreebbrule"\s*value="(.*?)"\s*id="agreebbrule"\s*checked="checked"\s*\/>/i', $snoopy->results, $matchesnd);
if(!empty($matchesnd)) {
    $agreebbrule = $matchesnd[1];
    echo $agreebbrule;
} else {
    die('Not found the agreebbrule.');
}

preg_match_all('/<label\s*for="(.*?)"\s*\>/i', $snoopy->results, $matchesrd);
var_dump($matchesrd);
if(!empty($matchesrd)) {
    $username = $matchesrd[1][0];
    echo $username;
} else {
    die('Not found the username.');
}
preg_match_all('/<label\s*for="(.*?)"\s*\>/i', $snoopy->results, $matchesth);
if(!empty($matchesth)) {
    $passwd = $matchesth[1][1];
    echo $passwd;
} else {
    die('Not found the passwd.');
}
preg_match_all('/<label\s*for="(.*?)"\s*\>/i', $snoopy->results, $matches5);
if(!empty($matches5)) {
    $repasswd = $matches5[1][2];
    echo $repasswd;
} else {
    die('Not found the repasswd.');
}
preg_match_all('/<label\s*for="(.*?)"\s*\>/i', $snoopy->results, $matches6);
if(!empty($matches6)) {
    $email = $matches6[1][3];
    echo $email;
} else {
    die('Not found the email.');
}

$submit_vars[$username] =$ur;
$submit_vars[$email] =$ur.'@126.com';
$submit_vars['activationauth'] ='';
$submit_vars[$passwd] =$ur.$nr;
$submit_vars[$repasswd] =$ur.$nr;
$submit_vars['agreebbrule'] =$agreebbrule;
$submit_vars['formhash'] =$formhash;
$submit_vars['regsubmit'] ='yes';
$submit_vars['referer'] ='http://bbs.scol.com.cn/./';

$snoopy->referer = "http://bbs.scol.com.cn/member.php?mod=register"; 
$ck=$snoopy->headers;

foreach ($ck as $k=>$value){
    if (strpos($value,'Set-Cookie')!==FALSE){
        $arr=  explode(':', $value);
        $u=explode(';', $arr[1]);
        $v=explode('=', $u[0]);
        $snoopy->cookies[$v[0]]=$v[1];
    }
}

$snoopy->submit("http://bbs.scol.com.cn/member.php?mod=register&inajax=1",$submit_vars);
$open=fopen("log.log","a+" );
fwrite($open,mb_convert_encoding($snoopy->results,"utf-8","gbk").'\n');
fclose($open);

//$re =mb_convert_encoding($snoopy->results,"utf-8","gbk");
//print_r($re);
//sleep(10);
//echo "。";
//echo "<br/>";

sleep($interval); // 按设置的时间等待22分钟循环执行


/*$Url='http://yidawang.net/index.html'; 
$http='http://';
if(strpos($Url,$http)!==false) {
  $tempu=parse_url($Url);  
  $message=$tempu['host'];  
  //echo $message;
}
else{
  $message=strtok($Url,'/');
  //echo $message; 
}*/
//echo md5(md5('888888').'399982'); 
//省略php后标签防止后面有空格等输出。
};