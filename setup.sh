#!/bin/sh

# Setup plugins and stuff
. ./update.sh

# We make sure we can delete the contents of the cache by setting the
# sgid and suid bit
chmod -R a+rws cache
chmod -R a+rws log

# Upload folder
mkdir -p web/uploads
chmod a+rws web/uploads

# Thumbnail folder
mkdir -p web/thumbs
chmod a+rws web/thumbs

# We'll confgiure the database if the configuration
# does not exist

if [ ! -e config/databases.yml ]; then
  php symfony configure:database "sqlite:%SF_DATA_DIR%/db.db";
fi;

# Generate database classes
php symfony doctrine:build --all-classes --sql

if [ "$1" == "all" ]; then
  php symfony doctrine:build --db --and-load
  chmod a+rwx data/db.db
fi;
