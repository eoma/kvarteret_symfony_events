#!/bin/sh

# This script will setup the required steps to using this application
git submodule init
git submodule update

mkdir cache/ log/

#  We'll be using the sfDoctrinePlugin's web resources
if [ -d lib/vendor/symfony/lib/plugins/sfDoctrinePlugin ]; then
  if [ ! -h web/sfDoctrinePlugin ]; then
    cd web/;

    ln -s ../lib/vendor/symfony/lib/plugins/sfDoctrinePlugin sfDoctrinePlugin;

    cd ..;
  else
    echo "The symlink web/sfDoctrinePlugin already exists";
  fi;
else
  echo "!!! Symfony was not checked out successfully !!!";
fi;

php symfony project:permissions
php symfony configure:database "sqlite:db.db"
php symfony doctrine:build --all-classes --sql
