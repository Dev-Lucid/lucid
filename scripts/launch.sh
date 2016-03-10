#!/bin/sh
dir=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )
app="$dir/../app"
port=${1-9000}
docs_port=$(($port + 2))
ip=${2-127.0.0.1}
open http://$ip:$port
open http://$ip:$(($port + 2))
php -S $ip:$port -t $app  > /dev/null 2>&1  & touch debug.log & ./scripts/tail-log.sh & php -f scripts/watcher.php & php -S $ip:$docs_port -t "$dir/../vendor/devlucid/lucid/docs"
