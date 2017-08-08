# SQLFiddle
### Version 1.0.0

SQL Fiddle is a plugin for SugarCRM/SuiteCRM

This module provides SQL Editor functionality in SugarCRM/SuiteCRM.
It connects to CRM database using database credentials mentioned in config file of CRM.
In the left side of window, you can see the details about the database, its tables and their corresponding columns.
Only admin users can query into database.

After installation you will find an extra item **SQL Fiddle** in the admin panel where you can query into database.

Known limitations:
1) Compatibility with databases other than MySQL has not been tested.
2) Not tested with complex queries.

TODO:
1) Remove *Delete* access.
2) Add icon.
3) Needs to handle scenarios, where results from query not returned.
4) Needs to Clean-up junk HTML, CSS, JS and PHP code.

By:
  Sohan U. S. Tirpude
  mynameischangezkhan@gmail.com
