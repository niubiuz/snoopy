<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
header("Content-Type:text/html;charset=utf-8");
include "Snoopy.class.php";
$snoopy = new Snoopy;



//ignore_user_abort(); //即使Client断开(如关掉浏览器)，PHP脚本也可以继续执行.
//set_time_limit(0); // 执行时间为无限制，php默认执行时间是30秒，可以让程序无限制的执行下去

//$snoopy->fetch('http://126.com/');

//$ck=$snoopy->headers;

/*foreach ($ck as $k=>$value){
    if (strpos($value,'Set-Cookie')!==FALSE){
        $arr=  explode(':', $value);
        $u=explode(';', $arr[1]);
        $v=explode('=', $u[0]);
        $snoopy->cookies[$v[0]]=$v[1];
    }
}*/

$submit_vars['username'] ='wangpangyx@126.com';
$submit_vars['savelogin'] =0;
$submit_vars['url2'] ='http%3A%2F%2Fmail.126.com%2Ferrorpage%2Ferror126.htm';
$submit_vars['password'] ='591874';

$snoopy->submit("http://mail.126.com/entry/cgi/ntesdoor?df=mail126_letter&from=web&funcid=loginone&iframe=1&language=-1&passtype=1&product=mail126&verifycookie=-1&net=failed&style=-1&race=-2_-2_-2_db&uid=wangpangyx@126.com&hid=10010102",$submit_vars);

$ck=$snoopy->headers;
var_dump($ck);

foreach ($ck as $k=>$value){
    if (strpos($value,'Set-Cookie')!==FALSE){
        $arr=  explode(':', $value);
        $u=explode(';', $arr[1]);
        $v=explode('=', $u[0]);
        $snoopy->cookies[$v[0]]=$v[1];
    }
    if (strpos($value,'x-ntes-mailentry-location')!==FALSE){
        $arr1=explode(':', $value);
        $arrunion=[$arr1[1],$arr1[2]];
        $str2=  implode(':', $arrunion);
        
        $sid=explode('=', $value);
        $newsid = substr($sid[1],0,strlen($sid[1])-3); 
        

    }
}
//echo $newsid;
//var_dump($str2);
// /js6/s?sid=UAsslPPxxgBYpPvCAMxxYjxolnbFWVCP&func=mbox:readMessage&deftabclick=t0&l=read&action=read
//$snoopy->fetchlinks($str2);
$newurl='http://mail.126.com/js6/s?sid='.$newsid.'&func=mbox:readMessage&deftabclick=t0&l=read&action=read';
$submit_vars2['var']='%3C%3Fxml%20version%3D%221.0%22%3F%3E%3Cobject%3E%3Cstring%20name%3D%22id%22%3E41%3A1tbiKRilYVXnBt7StgAAs7%3C%2Fstring%3E%3Cboolean%20name%3D%22header%22%3Etrue%3C%2Fboolean%3E%3Cboolean%20name%3D%22returnImageInfo%22%3Etrue%3C%2Fboolean%3E%3Cboolean%20name%3D%22returnAntispamInfo%22%3Etrue%3C%2Fboolean%3E%3Cboolean%20name%3D%22autoName%22%3Etrue%3C%2Fboolean%3E%3Cobject%20name%3D%22returnHeaders%22%3E%3Cstring%20name%3D%22Resent-From%22%3EA%3C%2Fstring%3E%3Cstring%20name%3D%22Sender%22%3EA%3C%2Fstring%3E%3Cstring%20name%3D%22List-Unsubscribe%22%3EA%3C%2Fstring%3E%3Cstring%20name%3D%22Reply-To%22%3EA%3C%2Fstring%3E%3C%2Fobject%3E%3Cboolean%20name%3D%22supportTNEF%22%3Etrue%3C%2Fboolean%3E%3C%2Fobject%3E';
$snoopy->submit($newurl,$submit_vars2);

//$re =mb_convert_encoding($snoopy->results,"utf-8","utf-8");
//print_r($re);
//sleep(10);
echo "。";
echo "<br/>";



$open=fopen("pt126.log","a+" );
fwrite($open,mb_convert_encoding($snoopy->results,"utf-8","utf-8").'\n');
fclose($open);