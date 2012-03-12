<table class="forum" style="width:{page:width};" cellpadding="0" cellspacing="1">
    <tr>
        <td class="headb" colspan="3">{lang:mod} - {lang:head_list}</td>
    </tr>
    <tr>
        <td class="leftb">{icon:editpaste} <a href="?mod=codepaste&amp;action=create">{lang:addcode}</a></td>
        <td class="leftb">{icon:contents} {lang:all}: {head:count}</td>
        <td class="rightb">{head:pages_navigation}</td>
    </tr>
</table>
<br />
{head:message}
<table class="forum" style="width:{page:width};" cellpadding="0" cellspacing="1">
    <tr>
        <td class="headb" style="width:75px;">{sort:date} {lang:date}</td>
        <td class="headb">{sort:name} {lang:name}</td>
        <td class="headb" style="width:100px;">{sort:mod} {lang:modul}</td>
        <td class="headb" style="width:100px;">{lang:file}</td>
        <td class="headb" style="width:125px;">{sort:version} {lang:version}</td>
        <td class="headb" style="width:50px;">{lang:views}</td>
        <td class="headb">{lang:comment}</td>
    </tr>
    {loop:codepaste}
    <tr>
        <td class="leftc">{codepaste:date}</td>
        <td class="leftc">
          <a href="?mod=codepaste&amp;action=view&amp;id={codepaste:id}">{codepaste:name}</a>
          {if:useredit}<a href="?mod=codepaste&amp;action=edit&amp;id={codepaste:id}" title="{lang:edit}">{icon:edit}</a>{stop:useredit}
        </td>
      {if:modfile}
        <td class="leftc">{codepaste:mod}</td>
        <td class="leftc">{codepaste:file}.{codepaste:type}</td>
      {stop:modfile}
      {if:path}
        <td class="leftc" colspan="2">{codepaste:path}.{codepaste:type}</td>
      {stop:path}
        <td class="leftc">{codepaste:version}</td>
        <td class="centerb">{codepaste:views}</td>
        <td class="centerb">{codepaste:comment}</td>
    </tr>
    {stop:codepaste}
</table>
