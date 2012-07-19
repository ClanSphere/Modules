<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
 <tr>
  <td class="headb" colspan="2">{lang:mod_name} - {lang:manage}</td>
 </tr>
 <tr>
  <td class="leftb">{icon:contents} {lang:total}: {count:all}</td>
  <td class="rightb">{pages:list}</td>
 </tr>
</table>
<br />

{head:message}
<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
 <tr>
  <td class="headb">{sort:name} {lang:name}</td>
  <td class="headb">{sort:switch} {lang:switch}</td>
  <td class="headb" colspan="2">{lang:entries}</td>
  <td class="headb" colspan="2">{lang:options}</td>
 </tr>
 {loop:feedback}
 <tr>
  <td class="leftc"><a href="{url:feedback_mail:id={feedback:feedback_id}}">{feedback:feedback_name}</a></td>
  <td class="centerc">{feedback:switch}</td>
  <td class="rightc">{feedback:entries}</td>
  <td class="centerc"><a href="{url:feedback_details:id={feedback:feedback_id}}" title="{lang:details}">{icon:txt}</a></td>
  <td class="centerc"><a href="{url:feedback_edit:id={feedback:feedback_id}}" title="{lang:edit}">{icon:edit}</a></td>
  <td class="centerc"><a href="{url:feedback_remove:id={feedback:feedback_id}}" title="{lang:remove}">{icon:editdelete}</a></td>
 </tr>
 {stop:feedback}
</table>