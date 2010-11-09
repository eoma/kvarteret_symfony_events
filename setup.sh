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

# Make sure the plugins directory exist
if [ ! -d plugins/ ]; then
  mkdir plugins;
fi;


### BEGIN SETUP OF PLUGINS ###

cd plugins;

# Download and setup sfDoctrineNestedSetplugin, remove previous version if set.
if [ -d sfDoctrineNestedSetPlugin ]; then
  rm -r sfDoctrineNestedSetPlugin;
fi;

wget http://plugins.symfony-project.org/get/sfDoctrineNestedSetPlugin/sfDoctrineNestedSetPlugin-1.0.0.tgz
tar -xzvf sfDoctrineNestedSetPlugin-1.0.0.tgz
mv sfDoctrineNestedSetPlugin-1.0.0 sfDoctrineNestedSetPlugin

cd ..;

### END SETUP OF PLUGINS ###

php symfony project:permissions
php symfony configure:database "sqlite:db.db"
php symfony doctrine:build --all-classes --sql
