
* 2019.10.18 装修模板相关表数据有新增 数据在laravelvip.sql中
  
* 后台菜单权限及系统配置:backend.sql
    - 包括表：admin_menu admin_node admin_role system_config
* 备份backend.sql:
  ```shell
  sh scripts/backup_backend.sh homestead{用户名} secret{密码} laravelmall{数据库名}
  ```