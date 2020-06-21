# ShopSystem
- 一个基于PHP开发的简易商店系统

~~自己手敲的简易MVC框架，BUG百出，仅供参考~~

这是一个PHP课程设计大作业，仅供学习。

## 功能
- 账号登陆注册
- 发布商品
- 商品信息修改
- 商品删除
- 商品购买
- 商品发货
- 账号余额管理

## 文件结构
#### App 目录
`app`目录包含应用程序的核心代码

#### Core 目录
`core`目录，框架核心目录

#### Public 目录
`public`目录包含入口文件`index.php`，它是进入应用程序的所有请求的入口点。此目录还包含了一些你的资源文件（如图片、JavaScript 和 CSS）。

#### Handler 目录
`handler`目录，控制器处理类目录。

#### Resources 目录
`resources`目录包含了视图文件，还有所有语言文件。

## 安装方式
配置`.env`文件，入口文件为 `public/index.php`，进行`composer`安装。

```
composer update
```