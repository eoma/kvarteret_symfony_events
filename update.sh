#!/bin/sh

root_dir=$PWD;

# This script will setup the required steps to using this application

git submodule sync
git submodule init
git submodule update

mkdir cache/ log/

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

# Download and setup iCalcreator by KigKonsult

cd lib/vendor;

if [ -d iCalcreator ]; then
  rm -rf iCalcreator
fi;

wget -O iCalcreator.zip http://www.kigkonsult.se/downloads/dl.php?f=iCalcreator-2.8
mkdir iCalcreator
unzip iCalcreator.zip -d iCalcreator

cd $root_dir;

# Download and setup FullCalendar
cd web
mkdir -p js/fullcalendar
mkdir -p css/fullcalendar

wget http://arshaw.com/fullcalendar/downloads/fullcalendar-1.5.zip
unzip fullcalendar-1.5.zip
mv fullcalendar-1.5/fullcalendar/*.js js/fullcalendar
mv fullcalendar-1.5/fullcalendar/*.css css/fullcalendar

rm -r fullcalendar-1.5
rm fullcalendar-1.5.zip

cd $root_dir;

### END SETUP OF PLUGINS ###

# Copy dakEventsPlugin fixtures to this projects fixtures
mkdir -p data/fixtures
cd plugins/dakEventsPlugin/data/fixtures
for file in *.sample; do
  cp "$file" "${root_dir}/data/fixtures/${file/.sample}";
done;
cd $root_dir;

# Some housecleaning
php symfony cc
php symfony project:permissions

# Make sure our plugins' web resources are accessible
php symfony plugin:publish-assets
