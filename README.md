# SQLFiddle
### Version 2.0

SQL Fiddle is a plugin for SuiteCRM

This module provides SQL Editor functionality in SuiteCRM.
After installation you will find an extra item **SQL Fiddle** in the admin panel where you can query into database.
It connects to CRM database using database credentials mentioned in config file of CRM.
In the left side of window, you can see the details about the database, its tables and their corresponding columns.
Only admin users can query into database.

#### Demo

![Demo](https://raw.githubusercontent.com/changezkhan/crm/master/v2.gif)

#### Installing the Add-on

The ONLY step

Install plug-in using Module Loader, Admin > Module Loader.

![Install SQL Fiddle](https://raw.githubusercontent.com/changezkhan/crm/master/module_installer.png)

#### Usage

After installation, you'll get to see the link on **admin** section under *Developer Tools*.

![Link to SQL Fiddle](https://raw.githubusercontent.com/changezkhan/crm/master/admin_section.png)

After selecting SQL Fiddle, you'll get to see the following window

![SQL Fiddle](https://raw.githubusercontent.com/changezkhan/crm/master/sql_editor_screenshot.png)

And, that's it.

##### Known limitations:

1) Compatibility with databases other than MySQL has not been tested.
2) Not tested with complex queries.

##### TODO:

1) Add icon.
2) Needs to Clean-up junk HTML, CSS, JS and PHP code.

###### By:
  Sohan T.
  
  mynameischangezkhan@gmail.com
