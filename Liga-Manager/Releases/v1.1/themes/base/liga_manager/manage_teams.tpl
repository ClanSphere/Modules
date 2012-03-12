<table class="forum" style="width:{page:width}">
  <tr>
    <td class="headb" colspan="4">{lang:mod_name} - {lang:manage_teams}</td>
  </tr>
  <tr>
    <td class="leftb">{icon:editpaste} <a href="{url:create_team}">{lang:create_team}</a></td>
	<td class="leftb">{lang:total}: {count:teams}</td>
	<td class="rightb"><a href="{url:back}">{lang:back}</a>
	<td class="rightb">{pages:list}</a>
  </tr>
</table>  
<br />
{msg:redirect}
<table class="forum" style="width:{page:width}">
  <tr>
    <td class="headb">{lang:team_name}</td>
	<td class="headb">{lang:team_short}</td>
	<td class="headb">{lang:options}</td>
  </tr>
  {loop:teams}
  <tr>
    <td class="leftb">{teams:team_name}</td>
	<td class="leftb">{teams:team_short}</td>
	<td class="leftb">{teams:edit} {teams:remove}</td>
  </tr>  
  {stop:teams}
</table>  