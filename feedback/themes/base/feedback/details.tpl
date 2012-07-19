<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
 <tr>
  <td class="headb" colspan="3">{lang:mod_name} - {lang:details}</td>
 </tr>
 <tr>
  <td class="leftb" style="width: 30%">{icon:contents} {lang:total}: {count:all}</td>
  <td class="centerb"><a href="{url:feedback_manage}">{lang:manage}</a></td>
  <td class="rightb" style="width: 30%">{pages:list}</td>
 </tr>
</table>
<br />

<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
 <tr>
  <td class="leftc"><strong>{feedback:name}</strong></td>
 </tr>
 <tr>
  <td class="leftb">{feedback:question}</td>
 </tr>
</table>
<br />

{head:message}
<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
 <tr>
  <td class="headb">{sort:email} {lang:email}</td>
  <td class="headb">{sort:time} {lang:date}</td>
  <td class="headb">{lang:options}</td>
 </tr>
 {loop:feedbackmail}
 <tr>
  <td class="leftc">{feedbackmail:email}</td>
  <td class="centerc">{feedbackmail:date}</td>
  <td class="centerc"><a href="{url:feedback_maildel:id={feedbackmail:feedbackmail_id}}" title="{lang:remove}">{icon:editdelete}</a></td>
 </tr>
 <tr>
  <td class="leftb" colspan="3">{feedbackmail:text}</td>
 </tr>
 {stop:feedbackmail}
</table>