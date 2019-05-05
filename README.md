

<img src="1557047052(1).jpg">




# 安装

composer require itjackjw/yii2-apidoc dev-master

# 添加配置文件


<img src="1.jpg">

<img src="2.jpg">

```
<?php
return[
    ['title'=>'首页模块','author'=>"小明",'apimodule'=>"api","output"=>"index.html"],
    ['title'=>'admin模块','author'=>"小明",'apimodule'=>"module\admin\api","output"=>"admin.html"]
];


title:文件的标题
author：作者
apimodule：要生成的模块路径地址
output：生成的文件名称

```



## 使用

关联控制器

<img src="3.jpg">


主要有两种方式

1.导出一个模块的api 文档

yii  apidoc/index   

-m=要生成的模块类

-f=是否覆盖之前的文件

-o=输出文件的名字

-t=文件标题

-a=作者



2.导出配置文件内所有的api文档

yii  apidoc/all
