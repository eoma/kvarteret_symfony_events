#!/bin/sh

# This script will setup the required steps to using this application
git submodule init
git submodule update

mkdir cache/ log/
php symfony project:permissions
php symfony configure:database "sqlite:db.db"
php symfony doctrine:build --all-classes --sql
