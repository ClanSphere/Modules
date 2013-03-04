ckeditor for clansphere 1.0
---------------------------

requirements:

- MUST HAVE: ClanSphere 2011.3 or newer installed and sql-updates up to date

- Earlier versions are not supported and won't be in future, please consider upgrading


install steps:

1. upload content to your clansphere installation except for this file and any *.sql

2. run "ckeditor_install.sql" in database -> import and empty the cache if needed

3. set access level of this module for all access entries to 2 or for admins to 5

4. you can change the ckeditor skin, for example try office2003 in systen -> options -> ckeditor

5. enable ckeditor for whatever you want to use it (full support for usage in rte_html and rte_abcode mode)

6. have fun using it

changelog:

1.0 - initial standalone release with ckeditor 3.6.6.1 and fckeditor filebrowser 2.6.9