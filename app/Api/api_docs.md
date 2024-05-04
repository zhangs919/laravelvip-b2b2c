# 接口地址：http://www.mall.laravelvip.com/api
# 除登录接口外，其他接口在调用的时候都要在header中增加token参数
~~~
header: {
    'Authorization': `Bearer token值`
  }
~~~

# 会员管理后台api文档

# AppApiV1ControllersAuthController

## 用户登录 [POST /auth/login]
用户登录获取token值

+ Request (application/json)
    + Body

            {
                "user_name": "foo",
                "password": "bar"
            }

+ Response 200 (application/json)
    + Body

            {
                "access_token": "aasdasdasda",
                "token_type": "bearer",
                "expires_in": 3600
            }

## 获取当前登录用户信息 [GET /auth/me]
获取当前登录用户信息

## 退出登录 [POST /auth/logout]
退出登录

## 刷新token [POST /auth/refresh]
刷新token

# AppApiV1ControllersIndexController
首页Class IndexController

## 首页 [GET /]
返回首页数据

# AppApiV1ControllersUtilController
首页Class IndexController

## 上传图片 [POST /util/upload-image]
上传图片

+ Request (application/json)
    + Body

            {
                "filename": "name"
            }

+ Response 200 (application/json)
    + Body

            {
                "data": "图片相关信息对象",
                "code": 200,
                "message": "上传成功！"
            }

# AppApiV1ControllersConferenceController
Class ConferenceController

## 会议通知列表 [GET /conferences]
会议通知列表

+ Request (application/json)
    + Body

            {
                "type": "类型：0-会议 1-通知",
                "page[cur_page]": 1,
                "page[page_size]": 10
            }

+ Response 200 (application/json)
    + Body

            {
                "data": "会议记录列表对象",
                "message": "",
                "code": 200
            }

## 会议记录详情 [GET /conferences/{id}]
会议记录详情

+ Response 200 (application/json)
    + Body

            {
                "data": "会议记录对象",
                "message": "",
                "code": 200
            }

## 会议记录新增表单 [GET /conferences/create]
会议记录新增表单

## 会议记录新增表单提交 [POST /conferences]
会议记录新增表单提交

+ Request (application/json)
    + Body

            {
                "type": "类型：0-会议 1-通知",
                "title": "会议标题",
                "header_img": "会议头图",
                "start_time": "会议开始时间",
                "end_time": "会议结束时间",
                "address": "会议地址",
                "host": "主持人",
                "recorder": "记录人",
                "participants": "参会人员，多个以逗号分隔",
                "content": "会议内容，图文",
                "conf_status": "会议状态"
            }

+ Response 200 (application/json)
    + Body

            {
                "data": "会议对象",
                "message": "",
                "code": 200
            }

## 会议记录编辑表单 [GET /conferences/{id}edit]
会议记录编辑表单

## 会议记录编辑表单提交 [PATCH /conferences/{id}]
会议记录编辑表单提交,将要更新的内容放在url后面

+ Request (application/json)
    + Body

            {
                "title": "会议标题",
                "header_img": "会议头图",
                "seal": "公司公章",
                "start_time": "会议开始时间",
                "end_time": "会议结束时间",
                "address": "会议地址",
                "host": "主持人",
                "recorder": "记录人",
                "participants": "参会人员，多个以逗号分隔",
                "content": "会议内容，图文"
            }

+ Response 200 (application/json)
    + Body

            {
                "data": "会议对象",
                "message": "",
                "code": 200
            }

## 会议记录删除 [POST /conferences/{id}]
会议记录删除

## 签名列表 [GET /conferences/sign-list]
签名列表

+ Request (application/json)
    + Body

            {
                "conf_id": "会议id",
                "page[cur_page]": 1,
                "page[page_size]": 10
            }

+ Response 200 (application/json)
    + Body

            {
                "data": "会议记录列表对象",
                "message": "",
                "code": 200
            }
