<table class="forum" style="width:{page:width}">
  <tr>
    <td class="headb">{lang:mod_name} - {lang:edit_liga}</td>
  </tr>
  <tr>
    <td class="leftb">{head:body_text}</td>
  </tr>
</table>
<br />
<form method="post" name="edit_liga" action="{url:edit}">
<table class="forum" style="width:{page:width}">
  <tr>
    <td class="leftb" style="width:100px;">{icon:yast_group_add} {lang:liga_name}</td>
	<td class="leftc"><input type="text" name="liga_name" value="{edit:liga_name}" size="50" maxlength="250" /></td>
  </tr>
  <tr>
    <td class="leftb">{icon:1day} {lang:liga_year}</td>
	<td class="leftc"><input type="text" name="liga_year" value="{edit:liga_year}" size="50" maxlength="250" /></td>
  </tr> 
  <tr>
    <td class="leftb">{icon:kdmconfig} {lang:liga_max_teams}</td>
	<td class="leftc"><input type="text" name="liga_max_teams" value="{edit:liga_max_teams}" size="4" maxlength="4" /></td>
  </tr>     
  <tr>
    <td class="leftb">{icon:enumList} {lang:liga_order}</td>
	<td class="leftc"><input type="text" name="liga_order" value="{edit:liga_order}" size="4" maxlength="4" /></td>
  </tr>   
  <tr>
    <td class="leftb">{icon:enumList} {lang:points}</td>
	<td class="leftc">
	  <input type="text" name="liga_points_win" value="{edit:liga_points_win}" size="4" maxlength="4" />/
	  <input type="text" name="liga_points_draw" value="{edit:liga_points_draw}" size="4" maxlength="4" />/
	  <input type="text" name="liga_points_loose" value="{edit:liga_points_loose}" size="4" maxlength="4" />	  	  
	</td>
  </tr>   
  <tr>
    <td class="centerb" colspan="2">
	  <input type="hidden" name="liga_id" value="{data:liga_id}" />
	  <input type="submit" name="submit" value="{lang:edit}" />
	</td>
  </tr> 
</table>
</form>  