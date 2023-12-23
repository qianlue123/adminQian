
# 来源

安装完成后的 freepbx 里的一个目录, 显示页面。在原先基础上做修改, 使布局、按钮控制等操作符合我们的习惯。

使用的版本: SNG7-PBX16-64bit-2302-1.iso (CentOS7)

【位置】`/var/www/html/admin/views/`

# 用法

在ISO安装完成后, 登录将原先的两个目录替换。

```bash
cd /var/www/html/admin
git clone --branch qianPBX https://github.com/qianlue123/adminQian.git

sudo mv asstes/less/freepbx asstes/less/freepbx.bak
sudo mv views views.bak

sudo mv adminQian/asstes/less/freepbx ./asstes/less/
sudo mv adminQian/views .
rm -rf adminQian
```

## 本地目录结构

```
admin/
├── assets
│   ├── ...
│   └── less
│       ├── cache/      # 运行中自动生成随机名文件
│       ├── ...
│       └── freepbx/    # 样式表目录
│           ├── ...
│           └── *.less
├── ...
├── modules             # 所有的模块
└── views               # 页面对应的实际代码
    ├── whoops/
    ├── ...
    └── *.php
```

本来想用两个仓库分开装 php代码和样式表, 但是那样不好同步。

# 参考

暂无
