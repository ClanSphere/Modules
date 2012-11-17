tinymce for clansphere 0.9
--------------------------

requirements:

- MUST HAVE: ClanSphere 2011.3 or newer installed and sql-updates up to date

- Earlier versions are not supported and won't be in future, please consider upgrading


install steps:

1. upload content to your clansphere installation except for this file and any *.sql

2. run "tinymce_install.sql" in database -> import and empty the cache if needed

3. set access level of this module for all access entries to 2 or for admins to 5

4. you can change the tinymce skin, for example try o2k7 silver in systen -> options -> tinymce

5. enable tinymce for whatever you want to use it (full support for usage in rte_html and rte_abcode mode)

6. have fun using it

changelog:

0.1   - initial test release
0.1.1 - removed " replace to \" as it is unneeded and caused some errors
0.2   - tinymce update to 3.2.3
0.2.1 - compatible to clansphere 2009.0_rc3 release
0.2.2 - corrected indent and div behavior at replacements
0.3.0 - tinymce update to 3.2.4
0.3.1 - tinymce update to 3.2.4.1 and info.php corrections
0.3.8 - clansphere plugin is now clansphere_features
0.3.9 - bbcode plugin is now clansphere_abcode
0.4   - tinymce update to 3.2.5 and autosize updates
0.5   - tinymce update to 3.3.1 and bugfixes at init files
0.6   - tinymce update to 3.3.6 plus header fix for init javascript
0.7   - changed init process to be jquery based for clansphere 2010
0.7.1 - tinymce update to 3.3.7 and init process fix for clansphere 2010 beta 1
0.7.2 - fixed tiny_init.php to work without ajax (thx to schiri)
0.7.3 - tinymce update to 3.3.8
0.7.4 - tinymce update to 3.3.9.1
0.7.5 - tinymce update to 3.3.9.2
0.7.6 - first version that works with and requires clansphere 2010.1 (r4577+)
0.7.7 - tinymce update to 3.3.9.3 - should only be used with clansphere 2010.3 or newer
0.8   - tinymce update to 3.4.2 - should only be used with clansphere 2011.1 or newer
0.8.1 - tinymce update to 3.4.8 - should only be used with clansphere 2011.3 or newer
0.9   - tinymce update to 3.5.7 and bugfixed usage of both editor modes [thanks to skaos]