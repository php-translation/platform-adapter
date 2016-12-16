#!/bin/bash
EXIT="0"
ROOT=$(pwd)

for D in `find ./src -type d -mindepth 1 -maxdepth 1`
do
    echo "Checking $D"
    if grep -Fxq "$TRAVIS_PHP_VERSION" $D/travis.ini
    then
        cd $D
        echo "Updating dependencies"
        composer update

        echo "Running tests"
        ./vendor/bin/phpunit "$@"

        EXITCODE=$?

        # If there is an error, make sure to return it.
        if  [ "$EXITCODE" -ne "0" ]; then
            EXIT=$EXITCODE
            printError $DIR $EXITCODE
        fi

        cd $ROOT
    else
        echo "Skipping"
    fi
done

echo "Exiting with code: $EXIT"
exit "$EXIT"