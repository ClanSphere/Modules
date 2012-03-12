<table class="forum" style="width:{page:width};" cellpadding="0" cellspacing="1">
    <tr>
        <td class="headb">{lang:mod} - {lang:head_remove}</td>
    </tr>
    <tr>
        <td class="leftb">{verify:erasing}</td>
    </tr>
    <tr>
        <td class="centerc">
        <form method="post" name="codepaste_remove" action="{page:self}?mod=codepaste&amp;action=remove">
            <input name="id" value="{codepaste:id}" class="form" type="hidden">
            <input name="agree" value="{lang:confirm}" class="form" type="submit">
            <input name="cancel" value="{lang:cancel}" class="form" type="submit">
        </form>
        </td>
    </tr>
</table>
