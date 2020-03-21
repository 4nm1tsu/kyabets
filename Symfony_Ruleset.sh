#/bin/sh

cp -r `dirname $0`/vendor/escapestudios/symfony2-coding-standard/Symfony `dirname $0`/vendor/squizlabs/php_codesniffer/src/Standards
echo 'Copied!!'
echo `dirname $0`
