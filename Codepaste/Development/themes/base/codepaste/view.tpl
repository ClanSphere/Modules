<table class="forum" style="width:{page:width};" cellpadding="0" cellspacing="1">
    <tr>
        <td class="headb">{lang:mod} - {lang:head_view}</td>
    </tr>
    <tr>
        <td class="leftb">{lang:body_view}</td>
    </tr>
</table>
<br />
<table class="forum" style="width:{page:width};" cellpadding="0" cellspacing="1">
    <tr>
        <td class="leftb" style="width:125px;">{icon:kcmdf} {lang:name}</td>
        <td class="leftc">{codepaste:name}</td>
    </tr>
    <tr>
        <td class="leftb">{icon:yast_user_add} {lang:author}</td>
        <td class="leftc">
            <img src="symbols/countries/{users:country}.png" width="16" height="11" alt="{users:country}" />
            <a href="?mod=users&amp;action=view&amp;id={users:id}">{users:nick}</a>
        </td>
    </tr>
    <tr>
        <td class="leftb">{icon:package_system} {lang:version}</td>
        <td class="leftc">{codepaste:version}</td>
    </tr>
    <tr>
        <td class="leftb">{icon:folder_home2} {lang:file}</td>
        <td class="leftc">
        {if:modfile}
          {codepaste:mod}/{codepaste:file}.{codepaste:type}
        {stop:modfile}
        {if:path}
        {codepaste:path}.{codepaste:type}
        {stop:path}
        </td>
    </tr>
    <tr>
        <td class="leftb">{icon:1day} {lang:date}</td>
        <td class="leftc">{codepaste:date}</td>
    </tr>
    <tr>
        <td class="leftb">{icon:kedit} {lang:info}</td>
        <td class="leftc">{codepaste:info}</td>
    </tr>
    <tr>
        <td class="leftb">{icon:info} {lang:textold}</td>
        <td class="leftc">
          <a href="javascript:cs_clip('1')">
          <img src="/clansphere/clansphere_2007.4.2_de-en/symbols/clansphere/plus.gif" id="img_1" alt="">
          {lang:textold}</a>
          <br />
          <div style="display: none;" id="span_1">{codepaste:textold}</div>
        </td>
    </tr>
    <tr>
        <td class="leftb">{icon:info} {lang:textnew}</td>
        <td class="leftc">
          <a href="javascript:cs_clip('2')">
          <img src="/clansphere/clansphere_2007.4.2_de-en/symbols/clansphere/plus.gif" id="img_2" alt="">
          {lang:textnew}</a>
          <br />
          <div style="display: none;" id="span_2">{codepaste:textnew}</div>
        </td>
    </tr>
    <tr>
        <td class="centerc" colspan="2">
            <a href="javascript:back();">Zur&uuml;ck</a> -
            <a href="?mod=codepaste&amp;action=list">{lang:head_list}</a>
        </td>
    </tr>
</table>
<a href="#" name="com0"></a>
