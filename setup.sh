#!/bin/sh

root_dir=$PWD;

# This script will setup the required steps to using this application
git submodule init
git submodule update

mkdir cache/ log/
chmod -R ugo+rw cache
chmod -R ugo+rw log


#  We'll be using the sfDoctrinePlugin's web resources
if [ -d lib/vendor/symfony/lib/plugins/sfDoctrinePlugin/web ]; then
  if [ ! -h web/sfDoctrinePlugin ]; then
    cd web/;

    ln -s ../lib/vendor/symfony/lib/plugins/sfDoctrinePlugin/web sfDoctrinePlugin;

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

# Download and setup sfDoctrineNestedSetPlugin, remove previous version if set.
cd plugins;

if [ -d sfDoctrineNestedSetPlugin ]; then
  rm -r sfDoctrineNestedSetPlugin;
fi;

wget http://plugins.symfony-project.org/get/sfDoctrineNestedSetPlugin/sfDoctrineNestedSetPlugin-1.0.0.tgz
tar -xzf sfDoctrineNestedSetPlugin-1.0.0.tgz
mv sfDoctrineNestedSetPlugin-1.0.0 sfDoctrineNestedSetPlugin
rm sfDoctrineNestedSetPlugin-1.0.0.tgz

cd $root_dir;

# Download and setup ckeditor
cd web;
if [ ! -d js ]; then
  mkdir js;
fi;
cd js;

if [ -d ckeditor ]; then
  rm -r ckeditor
fi;

wget http://download.cksource.com/CKEditor/CKEditor/CKEditor%203.4.2/ckeditor_3.4.2.tar.gz
tar -xzf ckeditor_3.4.2.tar.gz
rm ckeditor_3.4.2.tar.gz

cd $root_dir;

### END SETUP OF PLUGINS ###

php symfony project:permissions
php symfony configure:database "sqlite:db.db"
php symfony doctrine:build --all-classes --sql
