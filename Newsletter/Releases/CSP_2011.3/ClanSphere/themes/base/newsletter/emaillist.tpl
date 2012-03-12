<table class="forum" style="width:{page:width}" cellpadding="0" cellspacing="{page:cellspacing}">
	<tr>
		<td class="headb" colspan="3">{lang:mod_name} - {lang:email_list}</td>
	</tr>
	<tr>
		<td class="leftb">{icon:contents} {lang:total}: {head:count}</td>
		<td class="leftb"><a href="{url:newsletter_manage}">{lang:back}</a></td>
		<td class="rightb">{head:pages}</td>
	</tr>
</table>
<br />
<table class="forum" style="width:{page:width}" cellpadding="0" cellspacing="{page:cellspacing}">
	<tr>
		<td class="headb">{sort:email} {lang:email}</td>
		<td class="headb">{sort:time} {lang:date}</td>
		<td class="headb">{sort:active} {lang:active}</td>
	</tr>
	{loop:email}
		<tr>
			<td class="leftc">{email:newsletter_user_email}</td>
			<td class="leftc">{email:newsletter_user_time}</td>
			<td class="leftc">{email:newsletter_user_active}</td>
		</tr>	
	{stop:email}
</table>