# 乐融沃b2b2c商城开源版

#### 项目介绍
乐融沃b2b2c多商户开源版，是2021年全新推出的一款轻量级、高性能的电商系统，支持H5 + 公众号，前后端源码100%开源，看见及所得，完美支持二次开发，让您快速搭建个性化独立商城。 技术架构：PHP7.2 + Laravel5.7，专注轻量可持续稳定的高可用系统，可学习可商用。

    如果对您有帮助，您可以点右上角 “Star” 收藏一下 ，获取第一时间更新，谢谢！

#### 技术特点
* 采用PHP 7.2 (强类型严格模式)
* Laravel 5.7（优雅的PHP开发框架）
* RBAC（基于角色的权限控制管理）

#### 系统演示

- 商城后台演示：http://backend.mall.laravelvip.com/
- 用户名和密码：test 123456

#### 源码下载

下载地址：https://gitee.com/laravelmall/laravelvip-b2c

#### 环境要求
- CentOS 7.0+
- Nginx 1.10+
- PHP 7.1+
- MySQL 5.6+


#### 如何安装
- composer install
- php artisan key:generate
- cp .env.example .env
- 修改 .env配置文件中的数据库连接信息和域名配置
    - 配置二级域名\
      BACKEND_DOMAIN=backend.b2c.com
      FRONTEND_DOMAIN=www.b2c.com
      MOBILE_DOMAIN=m.b2c.com
      PUSH_DOMAIN=push.b2c.com #配置 Websocket 域名
    - 数据库配置\
      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=laravelvip_b2b2c
      DB_USERNAME=homestead
      DB_PASSWORD=secret
- 导入mysql文件
    - 将 ./database/laravelvip_b2b2c.sql导入数据库

#### 后台地址

- 后台地址：http://backend.你的域名.com/
- 默认的账户密码：admin 123456
- 前台地址：http://www.你的域名.com/

#### 版权须知

1. 允许个人学习研究使用，支持二次开发，允许商业用途（仅限自运营）。
2. 允许商业用途，但仅限自运营，如果商用必须保留版权信息，望自觉遵守。
3. 不允许对程序代码以任何形式任何目的的再发行或出售，否则将追究侵权者法律责任。


本项目包含的第三方源码和二进制文件之版权信息另行标注。

版权所有Copyright © 2018-2028 By 乐融沃科技 (http://www.laravelvip.com) All rights reserved。





