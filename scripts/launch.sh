#!/bin/sh
dir=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )
app="$dir/../app"
port=${1-9000}
php -S 127.0.0.1:$port -t $app >> /dev/null & touch debug.log & ./scripts/tail-log.sh
