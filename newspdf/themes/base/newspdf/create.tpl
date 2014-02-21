<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
  <tr>
    <td class="headb"> {lang:mod_name} - {lang:create} </td>
  </tr>
  <tr>
    <td class="leftb"> {head:body} </td>
  </tr>
</table>
<br />

<form method="post" id="newspdf_create" action="{url:newspdf_create}">
  <table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
    <tr>
      <td class="leftc">{icon:kedit} {lang:headline} *</td>
      <td class="leftb"><input type="text" name="news_headline" value="{news:news_headline}" maxlength="200" size="50" /></td>
    </tr>
    <tr>
      <td class="leftc">{icon:folder_yellow} {lang:category} *</td>
      <td class="leftb">{categories:dropdown}</td>
    </tr>
    <tr>
      <td class="leftc">{icon:folder_images} {lang:pdf_source} *</td>
      <td class="leftb">
        {if:source}
        {loop:sources}
        <input type="radio" name="news_pdf" value="{sources:file}" {sources:selected}/> {sources:file}<br />
        {stop:sources}
        {stop:source}
        {unless:source}
        {lang:no_sources}
        {stop:source}
      </td>
    </tr>
    <tr>
      <td class="leftc">{icon:document} {lang:page}</td>
      <td class="leftb">
        <input type="text" name="page_start" value="{pages:start}" maxlength="5" size="5" />
        - <input type="text" name="page_end" value="{pages:end}" maxlength="5" size="5" />
      </td>
    </tr>
    <tr>
      <td class="leftc">{icon:ksysguard} {lang:options}</td>
      <td class="leftb" colspan="2">
        <input type="submit" name="submit" value="{lang:create}" />
     </td>
    </tr>
  </table>
</form>