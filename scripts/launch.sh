#!/bin/sh
dir=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )
app="$dir/../web"
ip=${1-127.0.0.1}
port=${2-9000}
open http://$ip:$port
php bin/copy_fonts.php;
php bin/compile.scss.php;
php bin/compile.javascript.php;
php -S $ip:$port -t $app  > /dev/null 2>&1  & touch debug.log & ./bin/tail-log.sh & php bin/watcher.php
