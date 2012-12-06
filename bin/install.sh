#!/bin/sh

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

APP="$( realpath "$DIR/../../../../application" )"
CSS="$( realpath "$DIR/../../../../public/js" )"
JS="$( realpath "$DIR/../../../../public/css" )"

SRC="$(realpath $DIR/../src)"
ASSETS_CSS="$(realpath $DIR/../assets/css)"
ASSETS_JS="$(realpath $DIR/../assets/js)"

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