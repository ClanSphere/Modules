<?php
/*
 * Newsletter Subscribe Mod
* @author Patrick "Fr33z3m4n" Jaskulski
*
*/
$cs_lang = cs_translate('newsletter');

$cs_post = cs_post(0,array('submit','email','type'));

$data = array();
$data['if']['subscribe'] 	= false;
$data['if']['unsubscribe']	= false;
$data['if']['error']		= false;

$cs_contact = cs_sql_option(__FILE__, 'contact');

if(isset($cs_post['submit'])) {
	$email 		= trim($cs_post['email']);
	$type 		= trim($cs_post['type']);

	$error = 0;
	$errormsg = "";

	if(empty($email)) {
		$error++;
		$errormsg .= $cs_lang['email_false'] . cs_html_br(1);
	}

	$pattern = "=^[_a-z0-9-]+(\.[_a-z0-9-]+)*@([0-9a-z](-?[0-9a-z])*\.)+[a-z]{2}([zmuvtg]|fo|me)?$=i";
	if(!preg_match($pattern,$email)) {
		$error++;
		$errormsg .= $cs_lang['email_false'] . cs_html_br(1);
	}

	if($type == 'subscribe' AND empty($error)) {
		$data['if']['subscribe'] = true;
		$select = 'newsletter_user_id';
		$where = "newsletter_user_email = '" . $email . "'";
		$check = cs_sql_select(__FILE__,'newsletter_user',$select,$where,0,0,1);
		if(empty($check)) {
			include_once 'mods/users/functions.php';
			$key = generate_code(15);
			$save_cells = array('newsletter_user_email','newsletter_user_ip','newsletter_user_time','newsletter_user_key');
			$save_data = array($email,cs_getip(),cs_time(), $key);
			cs_sql_insert(__FILE__,'newsletter_user',$save_cells,$save_data);
			$title = $cs_lang['entry'];
			$link = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?mod=newsletter&action=activate&key=' . $key;
			$message = $cs_lang['entry_msg'];
			$message .= cs_html_link($link,$cs_lang['email'] . ' ' . $cs_lang['confirm']);
			$message .= $cs_lang['entry_msg2'] . 	$cs_contact['def_org'];
			cs_mail($email,$title,$message,$cs_contact['def_mail'],'text/html');
			$data['subscribe']['msg'] = $cs_lang['subscribemod'];
		}
		else {
			$data['subscribe']['msg'] = $cs_lang['subscribe_err'];
		}
	}
	elseif($type == 'unsubscribe' AND empty($error)) {
		$data['if']['unsubscribe'] = true;
		$select = 'newsletter_user_id';
		$where = "newsletter_user_email = '" . $email . "'";
		$check = cs_sql_select(__FILE__,'newsletter_user',$select,$where,"",0,1);
		if(!empty($check)) {
			cs_sql_delete(__FILE__,'newsletter_user',$check['newsletter_user_id']);
			$data['unsubscribe']['msg'] = $cs_lang['unsubscribe'];
		}
		else {
			$data['unsubscribe']['msg'] = $cs_lang['unsubscribe_err'];
		}

	}
	else {
		$data['if']['error'] = true;
		$data['error']['msg'] = $errormsg;
	}
}
echo cs_subtemplate(__FILE__,$data,'newsletter','subscribe');