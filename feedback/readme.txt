feedback for clansphere v1
--------------------------

requirements:

- MUST HAVE: ClanSphere 2011.3 or newer installed and sql-updates up to date

- Earlier versions are not supported and won't be in future, please consider upgrading


install steps:

1. upload content to your clansphere installation except for this file and any *.sql

2. run "feedback_install.sql" in database -> import and empty the cache if needed

3. set access level of this module for all access entries to 2 or for admins to 5

4. you can change the feedback settings in system -> options -> feedback

5. enable feedback by adding a hyperlink to the list action, e.g. {url:feedback_list}

6. have fun using it