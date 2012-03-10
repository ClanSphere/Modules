<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
  <tr>
    <td class="headb">{lang:mod_name} - {lang:head_mail}</td>
  </tr>
  <tr>
    <td class="leftc">{data:body_mail}</td>
  </tr>
</table>
<br />

{if:form}
<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
 <tr>
  <td class="leftc"><strong>{feedback:name}</strong></td>
 </tr>
 <tr>
  <td class="leftb">{feedback:question}</td>
 </tr>
</table>
<br />

<form method="post" id="contact_mail" action="{url:feedback_mail:id={feedback:id}}">
<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
  <tr>
    <td class="leftc">{icon:personal} {lang:nick} *</td>
    <td class="leftb"><input type="text" name="nick" value="{mail:nick}" maxlength="40" size="40" /></td>
  </tr>
  <tr>
    <td class="leftc">{icon:mail_generic} {lang:email} *</td>
    <td class="leftb"><input type="text" name="email" value="{mail:email}" maxlength="80" size="40" /></td>
  </tr>
  <tr>
    <td class="leftc">{icon:kate} {lang:text} *</td>
    <td class="leftb"><textarea class="rte_abcode" name="text" cols="50" rows="20" id="text">{mail:text}</textarea></td>
  </tr>
  {if:captcha}
  <tr>
    <td class="leftc">{icon:lockoverlay} {lang:security_code} *</td>
    <td class="leftb">{captcha:img}<input type="text" name="captcha" value="" maxlength="8" size="8" /></td>
  </tr>
  {stop:captcha}
  <tr>
    <td class="leftc">{icon:ksysguard} {lang:options}</td>
    <td class="leftb">
    <input type="submit" name="submit" value="{lang:send}" />
      </td>
  </tr>
</table>
</form>
{stop:form}

{if:done}
<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
  <tr>
    <td class="centerb"><a href="{page:path}">{lang:continue}</a></td>
  </tr>
</table>
{stop:done}