<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
  <tr>
    <td class="headb">{lang:mod_name} - {lang:options}</td>
  </tr>
  <tr>
    <td class="leftb">{lang:body_options}</td>
  </tr>
</table>
<br />

<form method="post" id="tinyts3_options" action="{url:tinyts3_options}">
  <table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
    <tr>
      <td class="leftc">{icon:samba} {lang:host}</td>
      <td class="leftb"><input type="text" name="host" value="{options:host}" maxlength="80" size="40" /><br />{lang:info_host}</td>
    </tr>
    <tr>
      <td class="leftc">{icon:network} {lang:dns}</td>
      <td class="leftb"><input type="text" name="dns" value="{options:dns}" maxlength="80" size="40" /><br />{lang:info_dns}</td>
    </tr>
    <tr>
      <td class="leftc">{icon:nfs_mount} {lang:query_port}</td>
      <td class="leftb"><input type="text" name="query_port" value="{options:query_port}" maxlength="20" size="10" /><br />{lang:info_query_port}</td>
    </tr>
    <tr>
      <td class="leftc">{icon:nfs_unmount} {lang:client_port}</td>
      <td class="leftb"><input type="text" name="client_port" value="{options:client_port}" maxlength="20" size="10" /><br />{lang:info_client_port}</td>
    </tr>
    <tr>
      <td class="leftc">{icon:agt_reload} {lang:ttl}</td>
      <td class="leftb"><input type="text" name="ttl" value="{options:ttl}" maxlength="10" size="4" /> {lang:seconds}</td>
    </tr>
    <tr>
      <td class="leftc">{icon:ksysguard} {lang:options}</td>
      <td class="leftb"><input type="submit" name="submit" value="{lang:edit}" /></td>
    </tr>
  </table>
</form>