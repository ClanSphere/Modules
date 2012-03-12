<?php
/*
 * Newsletter Subscribe Mod
* @author Patrick "Fr33z3m4n" Jaskulski
*
*/
$cs_lang = cs_translate('newsletter');

$data = array();
$cs_get = cs_get(0,array('key'));
$data['if']['error'] = true;

if(isset($cs_get['key'])) {
	$where = "newsletter_user_key = '" . trim($cs_get['key']) . "'";
	$check = cs_sql_select(__FILE__,'newsletter_user','newsletter_user_id, newsletter_user_key',$where,0,0,1);
	if(!empty($check)) {
		cs_sql_update(__FILE__,'newsletter_user',array('newsletter_user_active','newsletter_user_key'),array(1,''),$check['newsletter_user_id']);
		$data['if']['activate'] = true;
		$data['if']['error'] = false;
	}
	else {
		$data['if']['activate'] = false;	
	}
}
echo cs_subtemplate(__FILE__,$data,'newsletter','activate');