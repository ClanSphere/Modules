<table class="forum" style="width:{page:width}" cellpadding="0" cellspacing="{page:cellspacing}">
  <tr>
    <td class="headb">{lang:mod_name} - {lang:head_edit}</td>
  </tr>
  <tr>
    <td class="leftc">{head:body}</td>
  </tr>
</table>
<br />

<form method="post" id="feedback_edit" action="{url:feedback_edit}">
<table class="forum" style="width:{page:width}" cellpadding="0" cellspacing="{page:cellspacing}">
  <tr>
    <td class="leftc" style="width:130px">{icon:cal} {lang:name} *</td>
    <td class="leftb"><input type="text" name="feedback_name" value="{data:feedback_name}" maxlength="80" size="40" /></td>
  </tr>
  <tr>
    <td class="leftc">{icon:package_settings} {lang:switch}</td>
    <td class="leftb">
      <input type="radio" name="feedback_switch" value="1" {data:switch_on} /> {lang:on}
      <input type="radio" name="feedback_switch" value="0" {data:switch_off} /> {lang:off}
    </td>
  </tr>
  {if:abcode}
  <tr>
    <td class="leftc">{icon:kate} {lang:question}<br />
      <br />
      {abcode:smileys}
    </td>
    <td class="leftb">
      {abcode:features}
      <textarea name="feedback_question" cols="50" rows="8" id="feedback_question">{data:feedback_question}</textarea>
    </td>
  </tr>
  {stop:abcode}
  {if:rte_html}
  <tr>
    <td class="leftc" colspan="2">{icon:kate} {lang:question}</td>
  </tr>
  <tr>
    <td class="leftc" colspan="2" style="padding:0px;">{rte:html}</td>
  </tr>
  {stop:rte_html}
  <tr>
    <td class="leftc">{icon:ksysguard} {lang:options}</td>
    <td class="leftb">
      <input type="hidden" name="id" value="{feedback:id}" />
      <input type="submit" name="submit" value="{lang:edit}" />
    </td>
  </tr>
</table>
</form>