<?php
// ClanSphere 2009 - www.clansphere.net
// $Id: view.php 3009 2009-05-03 14:57:11Z hajo $

$cs_lang = cs_translate('newsletter');
$cs_get = cs_get('id');
$data = array();

$newsletter_id = empty($cs_get['id']) ? 0 : $cs_get['id'];

$from = 'newsletter nwl INNER JOIN {pre}_users usr ON nwl.users_id = usr.users_id ';
$select = 'nwl.newsletter_id AS newsletter_id, nwl.newsletter_subject AS newsletter_subject, nwl.newsletter_time AS newsletter_time, ';
$select .= 'nwl.newsletter_text AS newsletter_text, nwl.users_id AS users_id, usr.users_email AS users_email, usr.users_active AS users_active'; 

$data['newsletter'] = cs_sql_select(__FILE__,$from,$select,"newsletter_id = '" . $newsletter_id . "'");

$data['newsletter']['subject'] = cs_secure($data['newsletter']['newsletter_subject']);
$data['newsletter']['date'] = cs_date('unix',$data['newsletter']['newsletter_time'],1);
$data['newsletter']['user'] = $data['newsletter']['users_email'];
$data['newsletter']['text'] = cs_secure($data['newsletter']['newsletter_text'],1,1);

echo cs_subtemplate(__FILE__,$data,'newsletter','view');