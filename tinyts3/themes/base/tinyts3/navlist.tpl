{unless:ts3}
{lang:no_server}
{stop:ts3}
{if:ts3}
TeamSpeak {ts3:version}<br />
<a href="ts3server://{ts3:url}">{ts3:url}</a> &nbsp; {ts3:icon}<br />
<hr style="width: 100%" />
{lang:online}: <b>{ts3:online}</b> / {ts3:maxclients} {lang:clients}<br /> 
{lang:refresh}: {ts3:cache_left} {lang:seconds}<br />
{lang:clientlist}:<br />
<hr style="width: 100%" />
{ts3:users}
{stop:ts3}