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

# 界面框架本身替换
removedir /var/www/html/admin/assets/less/freepbx
removedir /var/www/html/admin/views

sudo mv ./asstes/less/freepbx /var/www/html/admin/asstes/less/
sudo mv ./views /var/www/html/admin/

removeDir /var/www/html/admin/modules/WP_test
sudo mv ./modules/WP_test /var/www/html/admin/modules/
