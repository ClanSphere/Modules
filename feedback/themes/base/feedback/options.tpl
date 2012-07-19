<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
  <tr>
    <td class="headb">{lang:mod_name} - {lang:options}</td>
  </tr>
  <tr>
    <td class="leftb">{lang:body_options}</td>
  </tr>
</table>
<br />

<form method="post" id="feedback_options" action="{url:feedback_options}">
  <table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
    <tr>
      <td class="leftc">{icon:email} {lang:mail_subject}</td>
      <td class="leftb"><input type="text" name="mail_subject" value="{options:mail_subject}" maxlength="80" size="40" /></td>
    </tr>
    <tr>
      <td class="leftc">{icon:outbox} {lang:mail_detail}</td>
      <td class="leftb"><input type="text" name="mail_detail" value="{options:mail_detail}" maxlength="80" size="50" /></td>
    </tr>
    <tr>
      <td class="leftc">{icon:mail} {lang:mail_short}</td>
      <td class="leftb"><input type="text" name="mail_short" value="{options:mail_short}" maxlength="80" size="50" /></td>
    </tr>
    <tr>
      <td class="leftc">{icon:ksysguard} {lang:options}</td>
      <td class="leftb"><input type="submit" name="submit" value="{lang:edit}" /></td>
    </tr>
  </table>
</form>