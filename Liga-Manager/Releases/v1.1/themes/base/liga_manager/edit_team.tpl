<table class="forum" style="width:{page:width}">
  <tr>
    <td class="headb">{lang:mod_name} - {lang:edit_team}</td>
  </tr>
  <tr>
    <td class="leftb">{head:body_text}</td>
  </tr>
</table>
<br />
<form method="post" name="edit_team" action="{url:create}">
<table class="forum" style="width:{page:width}">
  <tr>
    <td class="leftb" style="width:100px;">{icon:yast_group_add} {lang:team_name}</td>
	<td class="leftc"><input type="text" name="team_name" value="{edit:team_name}" size="50" maxlength="250" /></td>
  </tr>
  <tr>
    <td class="leftb" style="width:100px;">{icon:1day} {lang:team_short}</td>
	<td class="leftc"><input type="text" name="team_short" value="{edit:team_short}" size="50" maxlength="250" /></td>
  </tr> 
  <tr>
    <td class="centerb" colspan="2">
	  <input type="hidden" name="team_id" value="{data:team_id}" />
	  <input type="submit" name="submit" value="{lang:edit}" />
	</td>
  </tr> 
</table>
</form>  