<?php
// ClanSphere 2009 - www.clansphere.net
// $Id$

$cs_lang = cs_translate('newsletter');
$cs_post = cs_post('start,sort');
$cs_get = cs_get('start,sort');
$data = array();

$start = empty($cs_get['start']) ? 0 : $cs_get['start'];
if (!empty($cs_post['start']))  $start = $cs_post['start'];
$sort = empty($cs_get['sort']) ? 1 : $cs_get['sort'];
if (!empty($cs_post['sort']))  $sort = $cs_post['sort'];

$cs_sort[1] = 'newsletter_user_email ASC';
$cs_sort[2] = 'newsletter_user_email DESC';
$cs_sort[3] = 'newsletter_user_time DESC';
$cs_sort[4] = 'newsletter_user_time ASC'; 
$cs_sort[5] = 'newsletter_user_active DESC';
$cs_sort[6] = 'newsletter_user_active ASC';
$order = $cs_sort[$sort];
$newsletter_count = cs_sql_count(__FILE__,'newsletter_user');

$data['head']['count'] = $newsletter_count;
$data['head']['pages'] = cs_pages('newsletter','emaillist',$newsletter_count,$start,0,$sort);

$data['sort']['email'] = cs_sort('newsletter','emaillist',$start,0,1,$sort);
$data['sort']['time'] = cs_sort('newsletter','emaillist',$start,0,3,$sort);
$data['sort']['active'] = cs_sort('newsletter','emaillist',$start,0,5,$sort);

$select = 'newsletter_user_email, newsletter_user_active, newsletter_user_time';
$data['email'] = cs_sql_select(__FILE__,'newsletter_user',$select,0,$order,$start,$account['users_limit']);

if(!empty($data['email'])) {
	for($a=0; $a<count($data['email']); $a++) {
		$data['email'][$a]['newsletter_user_time'] = cs_date('unix',$data['email'][$a]['newsletter_user_time']);
	}
	
}
echo cs_subtemplate(__FILE__,$data,'newsletter','emaillist');
