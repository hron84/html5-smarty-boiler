HTML 5 Boilerplate with Smarty
==============================

This project is a HTML 5 Boilerplate with a taste of Smarty PHP template framework
and some MVC design patterns.

Installation and first steps
----------------------------

You can install this framework in a two different way:

 - Specify pubic dir as document root in your web server confiuration.
   This is the default mode, so you do not need to anything than configure your
   web server
 - If you cannot set document root then move the content of public folder to a
   root of working directory (move all files/folders one level up), and edit
   index.php and remove one dot from the beginning of the path of setup.php.
   In this case, you should disable access to protected folder with .htaccess
   or from web server configuration to make your application more secure.

After you decided the layout, you need to create your own config.php (based on
the provided sample) and specify values to some config variables that matching
your environment. See the comments and samples in the config.php

Choosing database framework
---------------------------

The sample application uses DB.php (in classes folder) as a default database
framework. If you want to use ActiveRecord instead, edit setup.php and enable
loading ActiveRecord. Be sure you enable the initialization code too!


MVC and REST
------------

The framework currently have a very basic routing logic. In further versions,
it maybe changes.

The mapping to controllers is calculated based on the exact path you called
with some defaults. 

Take these examples:

    /users              => UsersController->index()
    /users/show/4       => UsersController->show()
    /projects/edit/5    => ProjectsController->edit()

There is a few limits and rule to make this routing work:
 - For routing / path you have to specify default controller's name in 
   config.php (`$config['default_controller']`). 
   You need to specify path element, **not** the class name.
 - You cannot create action names what is reserved word in PHP. 
   For example, the 'new' action name is causes syntax errors.
 - Make sure your non-action methods are marked to `protected` or `private`.

The last part of the URL is put to `$request->params['id']`. Currently no
support for nested URL-s (like /users/projects/4/5) and you need to specify
more parameters in GET variables.


DB.class
--------

The frameworks's own DB support is very limited. It contains from two parts:
DB.php and AbstractModel.class.php.

DB.php is a PDO wrapper class, what provides support for single database
connection.

AbstractModel.class.php is designed to keep model codes small. In your own
models you need to override two method: 
 - `getClass()` this method is exists because a limitation of PHP, this 
   function has to return with `__CLASS__`.
 - `getTable()` this method returns with a database table name where the model stores its
   records.

Currently AbstractModel's update method are not refresh the active instance of 
the model, instead returns with a new one. So you can simply drop the old instance.

For create a new record you can use `AbstractModel::create()`.

AbstractModel is checks the passed keys whether matches your column names or not  
but create/update do not take care about default values, they simply trust in RDBMS.

ActiveRecord
------------

For usage of ActiveRecord, please visit the own documentation website of the project:
http://www.phpactiverecord.org/docs/.

Licensing
---------

This project is licensed under the terms of GNU Lesser General Public License (LGPL) v3.0.

Known other bugs and limitations
--------------------------------

There is no ones.

Bugs and support
----------------

Please use the GitHub issues page ( https://github.com/hron84/html5-smarty-boiler/issues ).

Bugs, patches, ideas are welcome!
