<fieldset>
	<legend>Newsletter An/Abmelden</legend>
	<div style="text-align:center">
		{if:error}
			{error:msg}	<br /><br />
			Bitte versuchen Sie es noch einmal !!
		{stop:error}
		{if:subscribe}
			{subscribe:msg}
		{stop:subscribe}
		{if:unsubscribe}
			{unsubscribe:msg}
		{stop:unsubscribe}
	</div>
</fieldset>