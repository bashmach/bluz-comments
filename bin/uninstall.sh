#!/bin/sh

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

APP="$( realpath "$DIR/../../../../application" )"

LOG=$DIR/.installed

while read line
do
    FILEPATH="$(realpath $APP/$line)"

    if [[ -f $FILEPATH ]]
    then
        rm $FILEPATH
    fi
done <$LOG

echo "" > $LOG