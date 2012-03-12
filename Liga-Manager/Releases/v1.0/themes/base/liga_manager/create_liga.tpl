<table class="forum" style="width:{page:width}">
  <tr>
    <td class="headb">{lang:mod_name} - {lang:create_liga}</td>
  </tr>
  <tr>
    <td class="leftb">{head:body_text}</td>
  </tr>
</table>
<br />
<form method="post" name="create_liga" action="{url:create}">
<table class="forum" style="width:{page:width}">
  <tr>
    <td class="leftb" style="width:175px;">{icon:yast_group_add} {lang:liga_name}</td>
	<td class="leftc"><input type="text" name="liga_name" value="{create:liga_name}" size="50" maxlength="250" /></td>
  </tr>
  <tr>
    <td class="leftb">{icon:1day} {lang:liga_year}</td>
	<td class="leftc"><input type="text" name="liga_year" value="{create:liga_year}" size="50" maxlength="250" /></td>
  </tr> 
  <tr>
    <td class="leftb">{icon:kdmconfig} {lang:liga_max_teams}</td>
	<td class="leftc"><input type="text" name="liga_max_teams" value="{create:liga_max_teams}" size="4" maxlength="4" /></td>
  </tr>     
  <tr>
    <td class="leftb">{icon:enumList} {lang:liga_order}</td>
	<td class="leftc"><input type="text" name="liga_order" value="{create:liga_order}" size="4" maxlength="4" /></td>
  </tr>   
  <tr>
    <td class="leftb">{icon:enumList} {lang:points}</td>
	<td class="leftc">
	  <input type="text" name="liga_points_win" value="{create:liga_points_win}" size="4" maxlength="4" />/
	  <input type="text" name="liga_points_draw" value="{create:liga_points_draw}" size="4" maxlength="4" />/
	  <input type="text" name="liga_points_loose" value="{create:liga_points_loose}" size="4" maxlength="4" />	  	  
	</td>
  </tr>    
  <tr>
    <td class="centerb" colspan="2"><input type="submit" name="submit" value="{lang:submit}" /></td>
  </tr> 
</table>
</form>  