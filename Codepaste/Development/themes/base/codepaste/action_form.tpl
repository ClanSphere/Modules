<form method="post" name="codepaste_{codepaste:action}" action="{page:self}?mod=codepaste&amp;action={codepaste:action}">

<table class="forum" style="width:90%" cellpadding="0" cellspacing="1">
    <tr>
        <td class="leftb">{icon:yast_user_add} {lang:author}</td>
        <td class="leftc">
            <img src="symbols/countries/{users:country}.png" width="16" height="11" alt="{users:country}" />
            <a href="?mod=users&amp;action=view&amp;id={users:id}">{users:nick}</a>
        </td>
    </tr>
    <tr>
        <td class="leftb">{icon:kcmdf} {lang:name} *</td>
        <td class="leftc">
            <input type="text" name="codepaste_name" value="{codepaste:name}" maxlength="35" size="35" class="form" />
        </td>
    </tr>
    <tr>
        <td class="leftb">{icon:1day} {lang:date}</td>
        <td class="leftc">{codepaste:date}</td>
    </tr>
    <tr>
      <td class="leftb">{icon:mime} {lang:type}</td>
      <td class="leftc">
        <select name="codepaste_type" class="form" onchange="document.getElementById('file_ext').firstChild.data=this.form.codepaste_type.options[this.form.codepaste_type.selectedIndex].value">
          <option value="php"{if:php} selected="selected"{stop:php}>{lang:php_file}</option>
          <option value="tpl"{if:tpl} selected="selected"{stop:tpl}>{lang:theme_file}</option>
        </select>
      </td>
    </tr>
    <tr>
        <td class="leftb">{icon:folder_home2} {lang:modul}/{lang:file} *</td>
        <td class="leftc" id="file_cell">
          <div id="auto_file" style="display:{auto_file:display}; float:left;">
            <a href="#" title="{lang:change_path_spec}" onclick="document.getElementById('nauto_file').style.display='block'; document.getElementById('auto_file').style.display='none'">{icon:reload}</a>
            <input type="text" name="codepaste_mod" value="{codepaste:mod}" maxlength="10" size="10" class="form" />/
            <input type="text" name="codepaste_file" value="{codepaste:file}" maxlength="10" size="10" class="form" />.
          </div>
          <div id="nauto_file" style="display:{nauto_file:display}; float:left;">
            <a href="#" title="{lang:change_modfile_spec}" onclick="document.getElementById('auto_file').style.display='block';document.getElementById('nauto_file').style.display='none'">{icon:reload}</a>
            <input type="text" name="codepaste_path" value="{codepaste:path}" maxlength="50" size="20" class="form" />.
          </div>
          <span id="file_ext" style="vertical-align: sub;">{codepaste:type}</span>
        </td>
    </tr>
    <tr>
        <td class="leftb">{icon:package_system} {lang:version} *</td>
        <td class="leftc">
            <select name="categories_id" class="form">
            {loop:version}
                <option value="{version:id}"{version:selected}>{version:name}</option>
            {stop:version}
            </select>
        </td>
    </tr>
    <tr>
        <td class="leftb">{icon:kedit} {lang:info} *</td>
        <td class="leftc">
            <textarea name="codepaste_info" cols="50" rows="3" id="codepaste_info" class="form">{codepaste:info}</textarea>
        </td>
    </tr>
    <tr>
        <td class="leftb">{icon:info} {lang:textold} *</td>
        <td class="leftc">
            <textarea name="codepaste_textold" cols="50" rows="10" id="codepaste_textold" class="form">{codepaste:textold}</textarea>
        </td>
    </tr>
    <tr>
        <td class="leftb">{icon:info} {lang:textnew} *</td>
        <td class="leftc">
            <textarea name="codepaste_textnew" cols="50" rows="10" id="codepaste_textnew" class="form">{codepaste:textnew}</textarea>
        </td>
    </tr>
    <tr>
        <td class="leftb">{icon:ksysguard} {lang:options}</td>
        <td class="leftc">
        {if:edit}
            <input type="hidden" name="codepaste_id" value="{codepaste:id}" class="form" />
            <input type="hidden" name="codepaste_date" value="{codepaste:date_ts}" class="form" />
        {stop:edit}
            <input type="submit" name="submit" value="{lang:{codepaste:action}}" class="form"/>
            <input type="reset" name="reset" value="{lang:reset}" class="form"/>
        </td>
    </tr>
</table>

</form>
