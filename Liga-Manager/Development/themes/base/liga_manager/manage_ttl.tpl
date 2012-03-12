<table class="forum" style="width:{page:width}">
  <tr>
    <td class="headb" colspan="4">{lang:mod_name} - {lang:manage_ttl}</td>
  </tr>
  <tr>
    <td class="leftb">{icon:editpaste} <a href="{url:create}">{lang:create}</a></td>
	<td class="leftb">{lang:total}: {count:ttl}</td>
	<td class="leftb"><a href="{url:back}">{lang:back}</a>
	<td class="rightb">{pages:list}</td>
  </tr>
  <tr>
    <td class="leftb" colspan="4">
	<form method="post" name="ttt_manage" action="{url:form}">
	  {lang:show} {head:dropdown} {head:button}
	</form>
    </td>
  </tr>
</table>  
<br />
{head:getmsg}
<table class="forum" style="width:{page:width}">
  <tr>
    <td class="headb">{lang:team_name}</td>
	<td class="headb">{lang:liga_name}</td>
	<td class="headb">{lang:options}</td>
  </tr>
  {loop:ttl}
  <tr>
    <td class="leftb">{ttl:team_name}</td>
	<td class="leftb">{ttl:liga_name}</td>
	<td class="centerb">{ttl:edit}</td>
  </tr>
  {stop:ttl}
</table>  