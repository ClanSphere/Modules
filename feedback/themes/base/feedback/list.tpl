<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
 <tr>
  <td class="headb" colspan="2">{lang:mod_name} - {lang:list}</td>
 </tr>
 <tr>
  <td class="leftb">{lang:total}: {head:feedback_count}</td>
  <td class="rightb">{head:pages}</td>
 </tr>
</table>
<br />

<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
 <tr>
  <td class="headb">{sort:name} {lang:name}</td>
 </tr>
{loop:feedback}
 <tr>
  <td class="leftc">{feedback:feedback_name}</td>
 </tr>
{stop:feedback}
</table>