<table class="forum" style="width:{page:width}">
  <tr>
    <td class="headb" colspan="4">{lang:mod_name} - {lang:manage_games}</td>
  </tr>
  <tr>
    <td class="leftb">{icon:editpaste} <a href="{url:create}">{lang:create}</a></td>
	<td class="leftb">{lang:total}: {count:games}</td>
	<td class="leftb"><a href="{url:back}">{lang:back}</a></td>
	<td class="rightb">{pages:list}</td>
  </tr>
</table>
<br />
{if:liga}
<table class="forum" style="width:{page:width}">
  {loop:ligen}
  {if:not_enough}
  <tr>
    <td class="centerb">{ligen:liga_name}</td>
  </tr>
   {stop:not_enough}
  {stop:ligen}
</table> 
<br />
{stop:liga} 
<table class="forum" style="width:{page:width}">
  <tr>
    <td class="headb">{lang:liga_name}</td>
    <td class="headb">{lang:team_name}</td>	
    <td class="headb">{lang:team_name}</td>
	<td class="headb">{lang:score}</td>
	<td class="headb">{lang:date}</td>
	<td class="headb">{lang:options}</td>			
  </tr>
  {loop:games}
  <tr>
    <td class="leftb">{games:liga}</td>
    <td class="leftb">{games:team1}</td>
    <td class="leftb">{games:team2}</td>		
    <td class="centerb">{games:score}</td>
	<td class="centerb">{games:time}</td>
	<td class="centerb">{games:edit} {games:remove}</td>
  </tr>
  {stop:games}
</table>  
  