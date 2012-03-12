<table class="forum" style="width:{page:width}">
  <tr>
    <td class="headb">{lang:mod_name} - {lang:create_game}</td>
  </tr>
  <tr>
    <td class="leftb">{head:body_text}</td>
  </tr>
</table>  
<br />
<form method="post" name="create_game" action="{url:create}">
<table class="forum" style="width:{page:width}">
  <tr>
    <td class="leftb" style="width:150px;">{icon:yast_group_add} {lang:liga_name}</td>
	<td class="leftc">{dropdown:liga}</td>
  </tr>
  <tr>
    <td class="leftb" style="width:150px;">{icon:yast_group_add} {lang:team1_name}</td>
	<td class="leftc">{dropdown:team1}</td>
  </tr>
  <tr>
    <td class="leftb" style="width:150px;">{icon:yast_group_add} {lang:team2_name}</td>
	<td class="leftc">{dropdown:team2}</td>
  </tr>    
  <tr>
    <td class="leftb" style="width:150px;">{icon:smallcal} {lang:score}</td>
	<td class="leftc">
	  <input type="text" name="score_team1" value="{create:score_team1}" size="5" maxlength="5" /> : 
	  <input type="text" name="score_team2" value="{create:score_team2}" size="5" maxlength="5" />	  
	</td>
  </tr>   
  <tr>
    <td class="leftb" style="width:150px;">{icon:yast_group_add} {lang:date}</td>
	<td class="leftc">{create:games_time}</td>
  </tr>    
  <tr>
    <td class="centerb" colspan="2">
	  <input type="submit" name="submit" value="{lang:submit}" />
	  <input type="submit" name="cancel" value="{lang:cancel}" />
	</td>
  </tr>
</table>  
</form>