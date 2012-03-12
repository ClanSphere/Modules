<table class="forum" style="width:{page:width}">
 <tr>
  <td class="headb" colspan="3">{lang:mod_name} - {lang:create}</td>
 </tr>
 <tr>
   <td class="leftb">{head:body_text}</td>
 </tr>
</table> 
<br />
<form method="post" name="create_liga" action="{url:create}">
<table class="forum" style="width:{page:width}">
  <tr>
    <td class="leftb" style="width:100px;">{icon:yast_group_add} {lang:liga_name}</td>
	<td class="leftc">{dropdown:liga}</td>
  </tr>
  <tr>
   	<td class="leftb">{icon:yast_group_add} {lang:team_name}</td>
	<td class="leftc"><div id="team">{dropdown:team}</div></td>
  </tr>
  <tr>
    <td class="centerb" colspan="2">
	  <input type="submit" name="submit" value="{lang:submit}" />
	  <input type="submit" name="cancel" value="{lang:cancel}" />
	</td>
  </tr>
</table>
</form>  