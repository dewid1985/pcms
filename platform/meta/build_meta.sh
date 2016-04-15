#!/bin/bash

dir=$( cd "$(dirname "${BASH_SOURCE[0]}")" && pwd )
subdir=$( cd "$dir" && cd ../../ && pwd )

php  $subdir/onPHP/onphp/meta/bin/build.php $dir/meta_config.inc.php $dir/config.meta.xml
