#!/bin/sh

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

APP="$( realpath "$DIR/../../../../application" )"

SRC="$(realpath $DIR/../src)"
LOG=$DIR/.installed

rm $LOG
touch $LOG

installFile(){
  # do something
  if [[ -d "$1" ]]
  then
    $(cd $DIR/../src && echo "$( find . -type f \( ! -iname ".*" \) >> $LOG)");

    cd $DIR/../src

    for i in `ls -a $1`
    do
        if [[ -d "$i" ]] && [[ ! $i = '.' ]] && [[ ! $i = '..' ]]
        then
            cp $SRC/$i $APP -R
        fi
    done

  fi
}

installFile $SRC