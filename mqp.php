<?php
header("Content-Type:text/html;charset=utf-8");
include "Snoopy.class.php";
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$snoopy = new Snoopy;

$snoopy->fetch('http://www.shagualicai.cn/');

$ck0=$snoopy->headers;

foreach ($ck0 as $k=>$value){
    if (strpos($value,'Set-Cookie')!==FALSE){
        $arr=  explode(':', $value);
        $u=explode(';', $arr[1]);
        $v=explode('=', $u[0]);
        $snoopy->cookies[$v[0]]=$v[1];
    }
}
var_dump($snoopy->cookies);
$uname='17096241215';
$passwd='948o23';
$submit_vars['action'] ='loginauth';
$submit_vars['rm'] ='';
$submit_vars['TextBoxUserName'] =$uname;
$submit_vars['TextBoxPassword'] =$passwd;
$submit_vars['_dt']='1447840923971';

$snoopy->submit("http://reg.shagualicai.cn/login_auth.php",$submit_vars);

$re =mb_convert_encoding($snoopy->results,"utf-8","utf-8");
print_r($re);
//sleep(10);
echo "。";
//echo "<br/>";

$ck=$snoopy->headers;

foreach ($ck as $k=>$value){
    if (strpos($value,'Set-Cookie')!==FALSE){
        $arr=  explode(':', $value);
        $u=explode(';', $arr[1]);
        $v=explode('=', $u[0]);
        $snoopy->cookies[$v[0]]=$v[1];
    }
}

var_dump($snoopy->cookies);

$content='%3CP%3E%E9%A9%AC%E5%89%8D%E7%82%AE%E6%AF%94%E9%A9%AC%E5%90%8E%E7%82%AE%E5%A5%BD%E5%95%8A%E3%80%82%3C%2FP%3E';

$submit_vars2['sid']='227';
$submit_vars2['content']=$content;
$submit_vars2['answer_type']=1;
$submit_vars2['ask_id']=0;

$snoopy->submit("http://www.shagualicai.cn/qa/addAnswer/",$submit_vars2);

$re =mb_convert_encoding($snoopy->results,"utf-8","utf-8");
print_r($re);
//sleep(10);
echo "。";
//echo "<br/>";


