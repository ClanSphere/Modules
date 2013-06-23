<?php
// ClanSphere 2010 - www.clansphere.net
// $Id: $

function cs_ts3_parse($handle, $query) {

  $nl = "\n";
  $done = false;
  $result = '';
  
  fwrite($handle, $query . $nl);

  while($done == false)
  {
    $read = fread($handle, 4096);
    $result .= $read;
    $ok = substr($read, -9, 7);
    if(empty($read) OR $ok == ' msg=ok')
      $done = true;
  }

  return $result;
}

function cs_ts3_status($host, $query_port, $client_port) {

  global $cs_main;

  # exit when port data is not available
  if(empty($query_port) OR empty($client_port))
    return false;

  $timeout = 5;

  ini_set("default_socket_timeout", $timeout);

  $ts3_con = @fsockopen($host, $query_port, $errno, $errstr, $timeout);

  if(!empty($errno)) {
    cs_error(__FILE__, 'cs_ts3_status - ' . $errno . ' - ' . $errstr);
    return false;
  }
  else {
    $result = array();
    
    stream_set_timeout($ts3_con, $timeout);

    $result['connect'] = cs_ts3_parse($ts3_con, 'use port=' . $client_port);
    $result['info'] = cs_ts3_parse($ts3_con, 'serverinfo');
    $result['user'] = cs_ts3_parse($ts3_con, 'clientlist');

    fclose($ts3_con);
    
    # format fetched data for later usage
    $info = array();
    $info['userlist'] = array();
    
    $users = explode('|', $result['user']);

    foreach($users AS $user)
    {
      $parts = explode(' ', $user);
      $details = array();

      foreach($parts AS $part)
      {
        $sub = explode('=', $part, 2);
        $details['' . $sub[0] . ''] = isset($sub[1]) ? $sub[1] : '';
      }

      if(isset($details['client_nickname']) AND isset($details['client_type']) AND $details['client_type'][0] == '0') {
        $nick = str_replace(array('\/','\s','\p'), array('/',' ','|'), $details['client_nickname']);
        
        # if encoding is not utf-8 for the webiste then transform the string
        if($cs_main['charset'] != 'UTF-8') {
          $nick = utf8_decode($nick);
        }

        $info['userlist'][] = $nick;
      }
    }

    $conf = explode(' ', $result['info']);
    $vars = array();

    foreach($conf AS $part)
    {
      $parted = explode('=', $part, 2);
      $vars[$parted[0]] = isset($parted[1]) ? $parted[1] : '';
    }

    $info['version'] = isset($vars['virtualserver_version']) ? $vars['virtualserver_version'] : 'Error';
    $info['maxclients'] = isset($vars['virtualserver_maxclients']) ? (int) $vars['virtualserver_maxclients'] : '0';

    # only show real users as online
    $info['online'] = count($info['userlist']);

    # remove build info to shorten version information
    $end = strpos($info['version'], '\s');
    $info['version'] = substr($info['version'], 0, $end);

    # return value is now an array - on errors just false
    return $info;
  }
}