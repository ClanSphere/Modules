tinyts3 for clansphere v1
-------------------------

requirements:

- MUST HAVE: ClanSphere 2011.3 or newer installed and sql-updates up to date

- Earlier versions are not supported and won't be in future, please consider upgrading


install steps:

1. upload content to your clansphere installation except for this file and any *.sql

2. run "tinyts3_install.sql" in database -> import and empty the cache if needed

3. set access level of this module for all access entries to 2 or for admins to 5

4. you can change the tinyts3 settings in system -> options -> tinyts3

5. enable tinyts3 by using the {tinyts3:navlist} placeholder inside your template file, e.g. index.htm

6. have fun using it