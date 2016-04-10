#!/bin/sh
dir=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )
app="$dir/../"

tail -n 0 -f $app/debug.log | cut -c 76-10000
