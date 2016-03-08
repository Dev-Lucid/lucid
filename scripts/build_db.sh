#!/bin/sh
BASEDIR=$(dirname "$0")

DB="$BASEDIR/../db/development.sqlite"

if [ -f $DB ] ; then
    rm $DB
fi

sqlite3 $DB ".read $BASEDIR/../db/build/sqlite.regions.sql";
sqlite3 $DB ".read $BASEDIR/../db/build/sqlite.main.sql";
sqlite3 $DB ".read $BASEDIR/../db/build/sqlite.views.sql";