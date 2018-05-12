<?php
/**[数据配置文件]
 * @Author: 250375742@qq.com
 * @Date:   2014-08-15 11:07:35
 * @Last Modified by:   Jason
 * @Last Modified time: 2015-05-04 09:17:38
 */
// 数据库连接信息=>数据库类型://用户名:密码@链接地址:密码/数据库名称
// auth权限设置
// AUTH_ON           认证开关
// AUTH_TYPE         认证方式，1为时时认证；2为登录认证。
// AUTH_GROUP        用户组数据表名
// AUTH_GROUP_ACCESS 用户组明细表
// AUTH_RULE         权限规则表
// AUTH_USER         用户信息表
return array (
    'DB_TYPE' => 'mysql',
    'DB_HOST' => '127.0.0.1',
    'DB_NAME' => 'cp8aa.com',
    'DB_USER' => 'cp8aa.com',
    'DB_PWD' => '3sAWzK8Y4Pnmr5yA',
    'DB_PORT' => '3306',
    'DB_PREFIX' => 'db_',
    'DB_CHARSET' => 'utf8',

    //'SHOW_PAGE_TRACE'			=> true,//调试模式
    'APP_SUB_DOMAIN_DEPLOY' 	=>  1,   // 是否开启子域名部署
    // 子域名部署规则
    'APP_SUB_DOMAIN_RULES'  	=>  array(
        'm' => 'Mobile',
    ),

    /* URL设置 */
    'URL_ROUTER_ON'  => true,   // 是否开启URL路由
    'URL_MODEL' => '2',//REWRITE模式
    'URL_ROUTE_RULES'    => array(
        '/^([0-9a-z]+)(|\/)$/'                     => 'Home/Index/hall?catpinyin=:1',
        '/^([0-9a-z]+)\/kjzb(|\/)$/'               => 'Home/Index/kjzb?catpinyin=:1',
        '/^([a-z]+)\/([a-z]+)\/([0-9]+)(|\/)$/'                => 'Home/Index/detail?catpinyin=:1&typepinyin=:2&id=:3',
        '/^([0-9a-z]+)\/([0-9a-z]+)(|\/)$/'             => 'Home/Index/lists?catpinyin=:1&typepinyin=:2',
        '/^([0-9a-z]+)\/([0-9a-z]+)\/index_([0-9]+)(|\/)$/'             => 'Home/Index/lists?catpinyin=:1&typepinyin=:2&pageNum=:3',
    ),
	// 我的第一个数据库连接
    'DB_PDC' => array(
        'DB_TYPE' => 'mysql',
        'DB_USER' => 'hygo',
        'DB_PWD' => 'hygo',
        'DB_HOST' => '192.168.1.87',
        'DB_PORT' => '3306',
        'DB_NAME' => 'db_pdc',
        'DB_PREFIX' => 'db_'
    ),
);
