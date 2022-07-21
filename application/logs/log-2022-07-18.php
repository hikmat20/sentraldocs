<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-07-18 09:50:50 --> 404 Page Not Found: /index
ERROR - 2022-07-18 09:50:53 --> 404 Page Not Found: /index
ERROR - 2022-07-18 09:50:53 --> 404 Page Not Found: /index
ERROR - 2022-07-18 09:50:53 --> 404 Page Not Found: /index
ERROR - 2022-07-18 09:51:22 --> 404 Page Not Found: /index
ERROR - 2022-07-18 10:06:13 --> Severity: Notice --> Undefined variable: datgroupmenu F:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\menus\views\menus_form.php 73
ERROR - 2022-07-18 10:14:04 --> 404 Page Not Found: /index
ERROR - 2022-07-18 10:14:04 --> 404 Page Not Found: /index
ERROR - 2022-07-18 10:44:11 --> Severity: Warning --> Creating default object from empty value F:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\users\libraries\Auth.php 61
ERROR - 2022-07-18 10:44:11 --> Severity: Notice --> Undefined property: stdClass::$nm_lengkap F:\SENTRAL\SENTRALDOCS\sentraldocs\themes\dashboard\views\header.php 227
ERROR - 2022-07-18 10:44:11 --> Severity: Notice --> Undefined property: stdClass::$username F:\SENTRAL\SENTRALDOCS\sentraldocs\themes\dashboard\views\footer.php 49
ERROR - 2022-07-18 10:45:23 --> Query error: Unknown column 'xuser_groups.id_group' in 'field list' - Invalid query: SELECT `xuser_groups`.`id_group`, `groups`.`nm_group`
FROM `user_groups`
JOIN `groups` ON `user_groups`.`id_group` = `groups`.`id_group`
WHERE `id_user` = '69'
ORDER BY `nm_group` ASC
ERROR - 2022-07-18 10:45:54 --> Query error: Unknown column 'xuser_groups.id_group' in 'field list' - Invalid query: SELECT `xuser_groups`.`id_group`, `groups`.`nm_group`
FROM `user_groups`
JOIN `groups` ON `user_groups`.`id_group` = `groups`.`id_group`
WHERE `id_user` = '69'
ORDER BY `nm_group` ASC
ERROR - 2022-07-18 10:46:02 --> 404 Page Not Found: /index
ERROR - 2022-07-18 10:46:02 --> 404 Page Not Found: /index
ERROR - 2022-07-18 10:46:03 --> 404 Page Not Found: /index
ERROR - 2022-07-18 10:46:16 --> Query error: Unknown column 'xuser_groups.id_group' in 'field list' - Invalid query: SELECT `xuser_groups`.`id_group`, `groups`.`nm_group`
FROM `user_groups`
JOIN `groups` ON `user_groups`.`id_group` = `groups`.`id_group`
WHERE `id_user` = '2'
ORDER BY `nm_group` ASC
ERROR - 2022-07-18 10:46:16 --> 404 Page Not Found: /index
ERROR - 2022-07-18 10:53:32 --> Query error: Unknown table 'xt1' - Invalid query: SELECT `xt1`.*
FROM `menus` as `t1`
LEFT JOIN `menus` as `t2` ON `t1`.`id` = `t2`.`parent_id`
WHERE `t1`.`parent_id` = 0
AND `t1`.`group_menu` = 1
AND `t1`.`status` = 1
GROUP BY `t1`.`id`
ORDER BY `t1`.`order` ASC
ERROR - 2022-07-18 10:56:21 --> Query error: Unknown column 'xt1.id' in 'group statement' - Invalid query: SELECT `t1`.*
FROM `menus` as `t1`
WHERE `t1`.`parent_id` = '1'
AND `t1`.`group_menu` = 1
AND `t1`.`status` = 1
AND `t1`.`permission_id` IN(NULL)
GROUP BY `t1`.`id`, `xt1`.`id`
ORDER BY `t1`.`order` ASC
ERROR - 2022-07-18 15:43:29 --> Query error: Unknown column 'user_groups.id_user' in 'on clause' - Invalid query: SELECT *
FROM `users`
JOIN `user_groups` ON `users`.`id_user` = `user_groups`.`id_user`
WHERE `users`.`id_user` = ''
AND `id_group` = 1
ERROR - 2022-07-18 16:03:40 --> Query error: Unknown column 'user_groups.id_user' in 'on clause' - Invalid query: SELECT *
FROM `users`
JOIN `user_groups` ON `users`.`id_user` = `user_groups`.`id_user`
WHERE `users`.`id_user` = ''
AND `id_group` = 1
ERROR - 2022-07-18 16:04:18 --> Query error: Unknown column 'user_groups.id_user' in 'on clause' - Invalid query: SELECT *
FROM `users`
JOIN `user_groups` ON `users`.`id_user` = `user_groups`.`id_user`
WHERE `users`.`id_user` = ''
AND `id_group` = 1
ERROR - 2022-07-18 16:04:27 --> Query error: Unknown column 'user_groups.id_user' in 'on clause' - Invalid query: SELECT *
FROM `users`
JOIN `user_groups` ON `users`.`id_user` = `user_groups`.`id_user`
WHERE `users`.`id_user` = ''
AND `id_group` = 1
ERROR - 2022-07-18 16:05:31 --> Query error: Unknown column 'user_groups.id_user' in 'on clause' - Invalid query: SELECT *
FROM `users`
JOIN `user_groups` ON `users`.`id_user` = `user_groups`.`id_user`
WHERE `users`.`id_user` = ''
AND `id_group` = 1
ERROR - 2022-07-18 16:06:10 --> Query error: Unknown column 'user_groups.id_user' in 'on clause' - Invalid query: SELECT *
FROM `users`
JOIN `user_groups` ON `users`.`id_user` = `user_groups`.`id_user`
WHERE `users`.`id_user` = ''
AND `id_group` = 1
ERROR - 2022-07-18 16:06:24 --> Severity: Notice --> Undefined property: CI::$auth F:\SENTRAL\SENTRALDOCS\sentraldocs\application\libraries\Menu_generator.php 21
ERROR - 2022-07-18 16:06:24 --> Severity: Error --> Call to a member function user_id() on null F:\SENTRAL\SENTRALDOCS\sentraldocs\application\libraries\Menu_generator.php 21
ERROR - 2022-07-18 16:07:35 --> Query error: Unknown column 'user_groups.id_user' in 'on clause' - Invalid query: SELECT *
FROM `users`
JOIN `user_groups` ON `users`.`id_user` = `user_groups`.`id_user`
WHERE `users`.`id_user` = ''
AND `id_group` = 1
ERROR - 2022-07-18 16:09:02 --> Severity: Notice --> Undefined property: CI::$users_model F:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\users\libraries\Auth.php 134
ERROR - 2022-07-18 16:09:02 --> Severity: Error --> Call to a member function join() on null F:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\users\libraries\Auth.php 134
ERROR - 2022-07-18 16:09:39 --> Query error: Unknown column 'user_groups.id_user' in 'on clause' - Invalid query: SELECT *
FROM `users`
JOIN `user_groups` ON `users`.`id_user` = `user_groups`.`id_user`
WHERE `users`.`id_user` = ''
AND `id_group` = 1
ERROR - 2022-07-18 16:10:48 --> Query error: Unknown column 'user_groups.id_user' in 'on clause' - Invalid query: SELECT *
FROM `users`
JOIN `user_groups` ON `users`.`id_user` = `user_groups`.`id_user`
WHERE `users`.`id_user` = ''
AND `id_group` = 1
ERROR - 2022-07-18 16:11:15 --> Query error: Unknown column 'user_groups.id_user' in 'on clause' - Invalid query: SELECT *
FROM `users`
JOIN `user_groups` ON `users`.`id_user` = `user_groups`.`id_user`
WHERE `users`.`id_user` = ''
AND `id_group` = 1
ERROR - 2022-07-18 16:11:23 --> Query error: Unknown column 'user_groups.id_user' in 'on clause' - Invalid query: SELECT *
FROM `users`
JOIN `user_groups` ON `users`.`id_user` = `user_groups`.`id_user`
WHERE `users`.`id_user` = ''
AND `id_group` = 1
ERROR - 2022-07-18 16:11:38 --> Query error: Unknown column 'user_groups.id_user' in 'on clause' - Invalid query: SELECT *
FROM `users`
JOIN `user_groups` ON `users`.`id_user` = `user_groups`.`id_user`
WHERE `users`.`id_user` = ''
AND `id_group` = 1
ERROR - 2022-07-18 16:11:45 --> Query error: Unknown column 'user_groups.id_user' in 'on clause' - Invalid query: SELECT *
FROM `users`
JOIN `user_groups` ON `users`.`id_user` = `user_groups`.`id_user`
WHERE `users`.`id_user` = ''
AND `id_group` = 1
ERROR - 2022-07-18 16:12:04 --> Query error: Unknown column 'user_groups.id_user' in 'on clause' - Invalid query: SELECT *
FROM `users`
JOIN `user_groups` ON `users`.`id_user` = `user_groups`.`id_user`
WHERE `users`.`id_user` = ''
AND `id_group` = 1
ERROR - 2022-07-18 16:12:14 --> Severity: Notice --> Undefined variable: data F:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\users\libraries\Auth.php 142
ERROR - 2022-07-18 16:12:40 --> Query error: Unknown column 'user_groups.id_user' in 'on clause' - Invalid query: SELECT *
FROM `users`
JOIN `user_groups` ON `users`.`id_user` = `user_groups`.`id_user`
WHERE `users`.`id_user` = ''
AND `id_group` = 1
ERROR - 2022-07-18 16:13:17 --> Query error: Unknown column 'user_groups.id_user' in 'on clause' - Invalid query: SELECT *
FROM `users`
JOIN `user_groups` ON `users`.`id_user` = `user_groups`.`id_user`
WHERE `users`.`id_user` = ''
AND `id_group` = 1
ERROR - 2022-07-18 16:13:35 --> Query error: Unknown column 'user_groups.id_user' in 'on clause' - Invalid query: SELECT *
FROM `users`
JOIN `user_groups` ON `users`.`id_user` = `user_groups`.`id_user`
WHERE `users`.`id_user` = ''
AND `id_group` = 1
ERROR - 2022-07-18 16:27:13 --> Query error: Unknown column 'user_groups.id_user' in 'on clause' - Invalid query: SELECT *
FROM `users`
JOIN `user_groups` ON `users`.`id_user` = `user_groups`.`id_user`
WHERE `users`.`id_user` = ''
AND `id_group` = 1
ERROR - 2022-07-18 16:28:42 --> 404 Page Not Found: /index
ERROR - 2022-07-18 16:28:42 --> 404 Page Not Found: /index
ERROR - 2022-07-18 16:28:43 --> 404 Page Not Found: /index
ERROR - 2022-07-18 16:28:57 --> Severity: Notice --> Undefined variable: auth F:\SENTRAL\SENTRALDOCS\sentraldocs\application\libraries\Menu_generator.php 330
ERROR - 2022-07-18 16:28:57 --> 404 Page Not Found: /index
ERROR - 2022-07-18 16:30:05 --> Query error: Unknown column 'user_groups.id_user' in 'on clause' - Invalid query: SELECT `permissions`.`id_permission`
FROM `users`
JOIN `user_groups` ON `users`.`id_user` = `user_groups`.`id_user`
JOIN `group_permissions` ON `user_groups`.`id_group` = `group_permissions`.`id_group`
JOIN `permissions` ON `group_permissions`.`id_permission` = `permissions`.`id_permission`
WHERE `users`.`id_user` = '2'
ERROR - 2022-07-18 16:37:41 --> Severity: Notice --> Undefined property: Menu_generator::$auth F:\SENTRAL\SENTRALDOCS\sentraldocs\application\libraries\Menu_generator.php 329
ERROR - 2022-07-18 16:38:49 --> Severity: Notice --> Undefined property: Menu_generator::$auth F:\SENTRAL\SENTRALDOCS\sentraldocs\application\libraries\Menu_generator.php 329
ERROR - 2022-07-18 16:38:49 --> Severity: Error --> Call to a member function user_id() on null F:\SENTRAL\SENTRALDOCS\sentraldocs\application\libraries\Menu_generator.php 329
ERROR - 2022-07-18 16:40:21 --> Severity: Notice --> Undefined property: Menu_generator::$db F:\SENTRAL\SENTRALDOCS\sentraldocs\application\libraries\Menu_generator.php 329
ERROR - 2022-07-18 16:40:21 --> Severity: Error --> Call to a member function get_where() on null F:\SENTRAL\SENTRALDOCS\sentraldocs\application\libraries\Menu_generator.php 329
ERROR - 2022-07-18 16:41:13 --> Severity: Notice --> Undefined property: Menu_generator::$db F:\SENTRAL\SENTRALDOCS\sentraldocs\application\libraries\Menu_generator.php 329
ERROR - 2022-07-18 16:41:13 --> Severity: Error --> Call to a member function get_where() on null F:\SENTRAL\SENTRALDOCS\sentraldocs\application\libraries\Menu_generator.php 329
ERROR - 2022-07-18 16:41:21 --> Severity: Notice --> Undefined property: Menu_generator::$db F:\SENTRAL\SENTRALDOCS\sentraldocs\application\libraries\Menu_generator.php 329
ERROR - 2022-07-18 16:41:21 --> Severity: Error --> Call to a member function get_where() on null F:\SENTRAL\SENTRALDOCS\sentraldocs\application\libraries\Menu_generator.php 329
ERROR - 2022-07-18 16:42:50 --> Severity: Notice --> Undefined property: Menu_generator::$db F:\SENTRAL\SENTRALDOCS\sentraldocs\application\libraries\Menu_generator.php 329
ERROR - 2022-07-18 16:42:50 --> Severity: Error --> Call to a member function get_where() on null F:\SENTRAL\SENTRALDOCS\sentraldocs\application\libraries\Menu_generator.php 329
ERROR - 2022-07-18 16:43:17 --> Severity: Notice --> Undefined property: stdClass::$group_id F:\SENTRAL\SENTRALDOCS\sentraldocs\application\libraries\Menu_generator.php 329
