tinyts3 for clansphere 1.5.1
----------------------------

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


changelog:

0.1   - initial test release
1.0   - final release containing some bugfixes
1.1   - fixed some problems with spaces plus minor code optimizations
1.2   - better timeout handling, improved userlist, option info text added
1.3   - bugfixed userlist and improved online users count
1.4   - improved handling of empty and defect user data
1.5   - new function handles server response to allow for arbitrary content length
1.5.1 - added check for website encoding to transform user names