This project is an attempt at creating an event and booking system built on top of
the symfony framework. See http://www.symfony-project.org/

It utilises the Doctrine object relational mapper (orm).

It makes use of the symfony plugins

*   sfDoctrineGuardPlugin
*   sfDoctrineNestedSetPlugin
*   sfCKEditorPlugin
*   [dakEventsPlugin][dakEvents]

  [dakEvents]: https://github.com/eoma/dakEventsPlugin

It is mostly a __test project__ for a frontend and backend solution implementing [dakEventsPlugin][dakEvents].

Use in production?
------------------

You should consider making your own symfony project implementing [dakEventsPlugin][dakEvents] and modify your
project to your needs.

If you want to use this project in production, at least change the CSRFsecrets in apps/<frontend and backend>/config/settings.yml

How to configure the system
---------------------------

To check if your web server supports symfony you should download the configuration checker script
from http://sf-to.org/1.4/check.php and put it somewhere. If you've got shell access to the server
run the command
> php check_configuration.php

In the project directory, you can run the command

    sh setup.sh

to take care of most of the following steps and more.

If you want to use sqlite, please make sure that the database file is writable and readable by you and the web server.
You can do this on your private test server by issuing the command

    chmod ugo+rw /path/to/db/file

Do NOT do this on a shared hosting or production site if you're concerned about your data.

When you've successfully cloned the repository, go into the repository and run the commands

   git submodules init
   git submodules update

to fetch all submodules (specifically the symfony framework and dakEventsPlugin)

Then you should configure your databases. Generally symfony will create a configuration that's
common to the development, test, staging and production environment.

Please see [Symfony's gentle introduction to running it](http://www.symfony-project.org/gentle-introduction/1_4/en/03-Running-Symfony).

If you are comfortable just using an sqlite database then just run

    php symfony configure database:database "sqlite:db.db"

Make sure the directoreis cache/ and log/ exist, if not create them.
To fix permissions run:

    php symfony project:permissions

If you make changes to schema.yml (the database model) please run

    php symfony doctrine:build --all-classes

Setup script ends here

If you want to reload/reset the database, then run

    php symfony doctrine:build --sql --db --and-load

If you want to reload every database aspect (model, forms, fixtures, etc...)

    php symfony doctrine:build --all --and-load

Default administrator user is admin with password changeme, do immediately change this.

Other users included are locationOwner and arranger, both with password changeme.
