<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
        ],
        'oss' => [
                'driver'        => 'oss',
                'access_id'     => env('ALI_ACCESS_KEY_ID'),
                'access_key'    => env('ALI_ACCESS_KEY_SECRET'),
                'bucket'        => 'laravelvip',
                'endpoint'      => 'oss-us-east-1.aliyuncs.com', // OSS 外网节点或自定义外部域名
                //'endpoint_internal' => '<internal endpoint [OSS内网节点] 如：oss-cn-shenzhen-internal.aliyuncs.com>', // v2.0.4 新增配置属性，如果为空，则默认使用 endpoint 配置(由于内网上传有点小问题未解决，请大家暂时不要使用内网节点上传，正在与阿里技术沟通中)
                'cdnDomain'     => 'image.laravelvip.com', // 如果isCName为true, getUrl会判断cdnDomain是否设定来决定返回的url，如果cdnDomain未设置，则使用endpoint来生成url，否则使用cdn
                'ssl'           => false, // true to use 'https://' and false to use 'http://'. default is false,
                'isCName'       => true, // 是否使用自定义域名,true: 则Storage.url()会使用自定义的cdn或域名生成文件url， false: 则使用外部节点生成url
                'debug'         => false
        ],

        /*数据库备份*/
        'backup' => [
            'driver' => 'local',
            'root' => storage_path('/'),
            'url' => env('APP_URL').'/storage',
        ],

    ],

	// 前端静态文件软链接
	'links' => [
		// 系统安装
		public_path('frontend/web/installs') => resource_path('static/installs'),

		// 用户端-PC端
		public_path('frontend/web/css') => resource_path('static/frontend/web/css'),
		public_path('frontend/web/js') => resource_path('static/frontend/web/js'),
		public_path('frontend/web/images') => resource_path('static/frontend/web/images'),
		public_path('frontend/web/assets/d2eace91') => resource_path('static/assets'),
		public_path('frontend/web/68yun') => resource_path('static/68yun'),
		// horizon 队列监控
		public_path('frontend/web/vendor/horizon') => resource_path('../vendor/laravel/horizon/public'),

		// 用户端-手机端
		public_path('frontend/web_mobile/css') => resource_path('static/frontend/web_mobile/css'),
		public_path('frontend/web_mobile/js') => resource_path('static/frontend/web_mobile/js'),
		public_path('frontend/web_mobile/images') => resource_path('static/frontend/web_mobile/images'),
		public_path('frontend/web_mobile/assets/d2eace91') => resource_path('static/assets'),

		// 平台端-PC端
		public_path('backend/web/css') => resource_path('static/backend/web/css'),
		public_path('backend/web/js') => resource_path('static/backend/web/js'),
		public_path('backend/web/images') => resource_path('static/backend/web/images'),
		public_path('backend/web/oss') => resource_path('static/oss'),
		public_path('backend/web/assets/d2eace91') => resource_path('static/assets'),
		public_path('backend/web/68yun') => resource_path('static/68yun'),

		// 商家端-PC端
		public_path('seller/web/css') => resource_path('static/seller/web/css'),
		public_path('seller/web/js') => resource_path('static/seller/web/js'),
		public_path('seller/web/files') => resource_path('static/seller/web/files'),
		public_path('seller/web/images') => resource_path('static/seller/web/images'),
		public_path('seller/web/sound') => resource_path('static/seller/web/sound'),
		public_path('seller/web/assets/d2eace91') => resource_path('static/assets'),
		public_path('seller/web/68yun') => resource_path('static/68yun'),

		// 网点端-PC端
		public_path('store/web/css') => resource_path('static/store/web/css'),
		public_path('store/web/images') => resource_path('static/store/web/images'),
		public_path('store/web/assets/d2eace91') => resource_path('static/assets'),
		public_path('store/web/68yun') => resource_path('static/68yun'),

	],

];
