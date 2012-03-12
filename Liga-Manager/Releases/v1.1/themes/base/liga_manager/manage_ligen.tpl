<table class="forum" style="width:{page:width}">
  <tr>
    <td class="headb" colspan="4">{lang:mod_name} - {lang:manage_ligen}</td>
  </tr>
  <tr>
    <td class="leftb">{icon:editpaste} <a href="{url:create_liga}">{lang:create_liga}</a></td>
	<td class="leftb">{lang:total}: {count:ligen}</td>
	<td class="rightb"><a href="{url:back}">{lang:back}</a>
	<td class="rightb">{pages:list}</a>
  </tr>
</table>  
<br />
{msg:redirect}
<table class="forum" style="width:{page:width}">
  <tr>
    <td class="headb">{lang:liga_name}</td>
	<td class="headb">{lang:liga_year}</td>
	<td class="headb">{lang:liga_max_teams}</td>	
	<td class="headb">{sort:order} {lang:liga_order}</td>	
	<td class="headb">{lang:options}</td>
  </tr>
  {loop:ligen}
  <tr>
    <td class="leftb">{ligen:liga_name}</td>
	<td class="leftb">{ligen:liga_year}</td>
	<td class="leftb">{ligen:liga_max_teams}</td>	
	<td class="leftb">{ligen:liga_order}</td>		
	<td class="leftb">{ligen:edit} {ligen:remove}</td>
  </tr>  
  {stop:ligen}
</table>  