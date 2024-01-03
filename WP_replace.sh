#!/bin/bash

# ----- ----- ----- -----
# freepbx os从头安装完成后, clone本仓库
# bash WP_replace.sh 替换部分文件
# ----- ----- ----- -----

set -u

# 功能：去除目录，保存原目录到 /opt, 自己改的目录不存
# logic: 确认 /opt 目录是否已经存在，没有就移动，有就直接删除
removeDir() {
  local dir=`basename $1`
  if [ -d '/opt/${dir}.bak' ]; then sudo rm -r $1
  else 
    sudo mv $1 /opt/${dir}.bak
  fi
}

# ----- ----- main ----- -----
posSrc="/var/www/html/admin"

# 界面框架本身替换
removedir ${posSrc}/assets/less/freepbx
removedir ${posSrc}/views

sudo cp -r ./asstes/less/freepbx ${posSrc}/asstes/less/
sudo cp -r ./views ${posSrc}

removeDir ${posSrc}/modules/WP_test
sudo cp -r ./modules/WP_test ${posSrc}/modules/
