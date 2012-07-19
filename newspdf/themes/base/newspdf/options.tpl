<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
 <tr>
  <td class="headb">{lang:mod_name} - {lang:options}</td>
 </tr>
 <tr>
  <td class="leftb">{lang:options_info}</td>
 </tr>
</table>
<br />

<form method="post" action="{url:newspdf_options}">
<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
 <tr>
  <td class="leftc">{icon:resizecol} {lang:max_width}</td>
  <td class="leftb" colspan="2"><input type="text" name="img_max_width" value="{op:img_max_width}" maxlength="4" size="4" /> {lang:pixel}</td>
 </tr>
 <tr>
  <td class="leftc">{icon:resizerow} {lang:max_height}</td>
  <td class="leftb" colspan="2"><input type="text" name="img_max_height" value="{op:img_max_height}" maxlength="4" size="4" /> {lang:pixel}</td>
 </tr>
 <tr>
  <td class="leftc">{icon:hdd_unmount} {lang:img_upload_to}</td>
  <td class="leftb" colspan="2"><input type="text" name="img_upload_to" value="{op:img_upload_to}" maxlength="80" size="40" /></td>
 </tr>
 <tr>
  <td class="leftc">{icon:insert_table_col} {lang:dpi_x}</td>
  <td class="leftb" style="width:120px"><input type="text" name="pdf_dpi_x" value="{op:pdf_dpi_x}" maxlength="4" size="4" /></td>
  <td class="leftb" rowspan="2">{lang:dpi_info1}<br />{lang:dpi_info2}<br />{lang:dpi_info3}</td>
 </tr>
 <tr>
  <td class="leftc">{icon:insert_table_row} {lang:dpi_y}</td>
  <td class="leftb"><input type="text" name="pdf_dpi_y" value="{op:pdf_dpi_y}" maxlength="4" size="4" /></td>
 </tr> 
 <tr>
  <td class="leftc">{icon:hdd_unmount} {lang:pdf_upload_to}</td>
  <td class="leftb" colspan="2"><input type="text" name="pdf_upload_to" value="{op:pdf_upload_to}" maxlength="80" size="40" /></td>
 </tr>
 <tr>
  <td class="leftc">{icon:ksysguard} {lang:options}</td>
  <td class="leftb" colspan="2">
    <input type="submit" name="submit" value="{lang:edit}" />
  </td>
 </tr>
</table>
</form>
<br />

<table class="forum" cellpadding="0" cellspacing="{page:cellspacing}" style="width:{page:width}">
 <tr>
  <td class="headb" colspan="2">{lang:imagick}</td>
 </tr>
 <tr>
  <td class="leftc">{lang:im_version}</td>
  <td class="leftb">{im:version}</td>
 </tr>
 <tr>
  <td class="leftc">{lang:im_version_id}</td>
  <td class="leftb">{im:version_id}</td>
 </tr>
 <tr>
  <td class="leftc">{lang:im_formats}</td>
  <td class="leftb">{im:formats}</td>
 </tr>
</table>