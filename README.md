
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
│   ├── ...             # 各个模块的 assets 软连接
│   ├── js
│   └── less
│       ├── ...
│       └── freepbx/    # 样式表目录
│           ├── ...
│           └── *.less
├── ...
├── modules             # 所有的模块
│   └── ***             # 自己的模块
└── views               # 页面对应的实际代码
    ├── whoops/
    ├── ...
    └── *.php
```

本来想用两个仓库分开装 php代码和样式表, 但是那样不好同步。

## 新增模块的设计

将功能分到3个对应的php文件里，这个文件作为入口点引用另外的指定功能文件。

```
feature/
├── forcein.php        # 电话强插
├── forceout.php       # 电话强拆
└── ...
```

模块项目不用写 `<script type="text/javascript" src="assets/js/test.js" charset="utf-8"></script>` 这种 JS 文件引入语句，php框架会自动从 `/admin/assets/xxx` 里加载。使用 `ln -s` 连上就行。 

# 参考

暂无
