#!/bin/sh
dir=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )
app="$dir/../app"
port=${1-9000}
ip=${2-0.0.0.0}
php -S $ip:$port -t $app  > /dev/null 2>&1  & touch debug.log & ./scripts/tail-log.sh
