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
    cd $1

    $(cd $1 && echo "$( find . -type f \( ! -iname ".*" \) >> $LOG)");

    for i in `ls -a $1`
    do
        if [[ -d "$i" ]] && [[ ! $i = '.' ]] && [[ ! $i = '..' ]]
        then
            cp $1/$i $2 -R
        fi
    done

  fi
}

installFile $SRC $APP