#!/bin/sh
dir=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )
app="$dir/../web"
port=${1-9000}
docs_port=$(($port + 2))
ip=${2-127.0.0.1}
open http://$ip:$port
open http://$ip:$(($port + 2))
php -S $ip:$port -t $app  > /dev/null 2>&1  & touch debug.log & ./bin/tail-log.sh & php bin/watcher.php
