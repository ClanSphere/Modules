<table class="forum" style="width:{page:width}">
  <tr>
    <td class="headb">{lang:mod_name} - {lang:list}</td>
  </tr>
</table>

{if:overview}
<table class="forum" style="width:{page:width}">
  {loop:ligen}
  <tr>
    <td class="centerb">{ligen:liga_name}</td>
  </tr>
  {stop:ligen}
</table>  
{stop:overview}

{if:liga}
<br />
<table class="forum" style="width:{page:width}">
  <tr>
    <td class="headb" colspan="9">{liga:liga_name} {liga:liga_year}</td>
  </tr>
  <tr>
    <td class="leftc" style="width:10px;">{lang:place}</td>
	<td class="leftc" style="width:300px;">{lang:team_name}</td>
	<td class="leftc" style="width:20px;">{lang:games}</td>
	<td class="centerc " style="width:10px;">S</td>
	<td class="centerc" style="width:10px;">U</td>
	<td class="centerc" style="width:10px;">N</td>
	<td class="centerc" style="width:40px;">{lang:goals}</td>
	<td class="centerc">{lang:dif}</td>
	<td class="centerc">{lang:point}</td>
  </tr>	
  {loop:teams}
  <tr>
    <td class="{teams:class}" style="width:10px;">{teams:place}</td>
	<td class="{teams:class2}" style="width:300px;">{teams:team_name}</td>
	<td class="{teams:class}" style="width:20px;">{teams:games}</td>
	<td class="{teams:class} " style="width:10px;">{teams:wins}</td>
	<td class="{teams:class}" style="width:10px;">{teams:draws}</td>
	<td class="{teams:class}" style="width:10px;">{teams:loose}</td>
	<td class="{teams:class}" style="width:25px;">{teams:goal_wins} : {teams:goal_loose}</td>
	<td class="{teams:class}">{teams:dif}</td>
	<td class="{teams:class}">{teams:points}</td>
  </tr>	
  {stop:teams}
</table>
{stop:liga}  