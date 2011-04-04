#!/bin/sh

root_dir=$PWD;

# This script will setup the required steps to using this application
git submodule init
git submodule update

mkdir cache/ log/

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

# Download and setup htmlpurifier
cd lib/vendor;

if [ -d htmlpurifier ]; then
  rm -rf htmlpurifier
fi;

wget http://htmlpurifier.org/releases/htmlpurifier-4.3.0.tar.gz
tar -xzf htmlpurifier-4.3.0.tar.gz
mv htmlpurifier-4.3.0 htmlpurifier
rm htmlpurifier-4.3.0.tar.gz

cd $root_dir

### END SETUP OF PLUGINS ###

php symfony project:permissions

# We make sure we can delete the contents of the cache by setting the
# sgid and suid bit
chmod -R a+rws cache
chmod -R a+rws log

# Upload folter
mkdir -p web/uploads
chmod a+rws web/uploads

# Thumbnail folder
mkdir -p web/thumbs
chmod a+rws web/thumbs

# Copy dakEventsPlugin fixtures to this projects fixtures
mkdir -p data/fixtures
cd plugins/dakEventsPlugin/data/fixtures
for file in *.sample; do
  cp "$file" "${root_dir}/data/fixtures/${file/.sample}";
done;
cd $root_dir;

# We'll confgiure the database if the configuration
# does not exist

if [ ! -e config/databases.yml ]; then
  php symfony configure:database "sqlite:db.db";
fi;

php symfony doctrine:build --all-classes --sql

# Make sure our plugins' web resources are accessible
php symfony plugin:publish-assets
