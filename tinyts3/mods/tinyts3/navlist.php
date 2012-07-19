<?php
// ClanSphere 2010 - www.clansphere.net
// $Id: navlist.php 4924 2011-06-22 20:03:24Z hajo $

$cs_lang = cs_translate('tinyts3');

$ts3_config = cs_sql_option(__FILE__, 'tinyts3');

$data = array();
$data['ts3'] = cs_cache_load('tiny_ts3', $ts3_config['ttl']);

$data['if']['ts3'] = (empty($ts3_config['host']) OR empty($ts3_config['dns'])) ? 0 : 1;

if(empty($data['ts3']) AND !empty($data['if']['ts3'])) {

  include_once 'mods/tinyts3/func.php';

  $ts3_info = cs_ts3_status($ts3_config['host'], (int) $ts3_config['query_port'], (int) $ts3_config['client_port']);

  $data['ts3']['url'] = $ts3_config['dns'] . ':' . $ts3_config['client_port'];
  $data['ts3']['version'] = isset($ts3_info['virtualserver_version']) ? cs_secure($ts3_info['virtualserver_version']) : 'Error';
  $data['ts3']['maxclients'] = isset($ts3_info['virtualserver_maxclients']) ? (int) $ts3_info['virtualserver_maxclients'] : '0';
  $data['ts3']['online'] = isset($ts3_info['virtualserver_clientsonline']) ? (int) $ts3_info['virtualserver_clientsonline'] : '0';
  $data['ts3']['users'] = empty($ts3_info['virtualserver_clientlist']) ? $cs_lang['no_clients'] : $ts3_info['virtualserver_clientlist'];

  $icon = empty($data['ts3']['online']) ? 'grey' : 'green';
  if(empty($ts3_info))
    $icon = 'red';
  $data['ts3']['icon'] = cs_html_img('symbols/clansphere/' . $icon . '.gif', 0, 0, 'style="vertical-align:text-bottom"');

  $data['ts3']['time'] = cs_time();
  cs_cache_save('tiny_ts3', $data['ts3'], $ts3_config['ttl']);
}

$data['ts3']['cache_left'] = ($ts3_config['ttl'] - (cs_time() - $data['ts3']['time']));
$data['ts3']['cache_time'] = $ts3_config['ttl'];

echo cs_subtemplate(__FILE__, $data, 'tinyts3', 'navlist');