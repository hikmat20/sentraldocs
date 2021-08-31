<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-08-31 01:58:47 --> 404 Page Not Found: /index
ERROR - 2021-08-31 01:58:53 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:10:53 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'xSELECT a.*, b.nm_lengkap FROM tbl_pejabat a
        INNER JOIN users b on a.id' at line 1 - Invalid query: xSELECT a.*, b.nm_lengkap FROM tbl_pejabat a
        INNER JOIN users b on a.id_user = b.id_user
		WHERE a.id_jabatan='6' AND a.id_perusahaan='1' AND a.id_cabang='1'
ERROR - 2021-08-31 09:15:24 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'xSELECT a.*, b.nm_lengkap FROM tbl_pejabat a
        INNER JOIN users b on a.id' at line 1 - Invalid query: xSELECT a.*, b.nm_lengkap FROM tbl_pejabat a
        INNER JOIN users b on a.id_user = b.id_user
		WHERE a.id_jabatan='6' AND a.id_perusahaan='1' AND a.id_cabang='1'
ERROR - 2021-08-31 09:22:41 --> Query error: Table 'sentraldocs_db.view_user_jabatan' doesn't exist - Invalid query: SELECT *
FROM `view_user_jabatan`
WHERE `id_perusahaan` = '1'
AND `id_cabang` = '1'
ERROR - 2021-08-31 09:23:37 --> Query error: Table 'sentraldocs_db.view_user_pejabats' doesn't exist - Invalid query: SELECT *
FROM `view_user_pejabats`
WHERE `id_perusahaan` = '1'
AND `id_cabang` = '1'
ERROR - 2021-08-31 09:24:25 --> Query error: Table 'sentraldocs_db.view_user_pejabats' doesn't exist - Invalid query: SELECT *
FROM `view_user_pejabats`
WHERE `id_jabatan` = '6'
AND `id_perusahaan` = '1'
AND `id_cabang` = '1'
ERROR - 2021-08-31 09:24:38 --> Query error: Table 'sentraldocs_db.view_user_pejabats' doesn't exist - Invalid query: SELECT *
FROM `view_user_pejabats`
WHERE `id_jabatan` = '6'
AND `id_perusahaan` = '1'
AND `id_cabang` = '1'
ERROR - 2021-08-31 09:24:50 --> Query error: Unknown column 'id_jabatan' in 'where clause' - Invalid query: SELECT *
FROM `view_user_pejabat`
WHERE `id_jabatan` = '6'
AND `id_perusahaan` = '1'
AND `id_cabang` = '1'
ERROR - 2021-08-31 09:26:40 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'xSELECT a.*, b.nm_lengkap FROM tbl_pejabat a
		INNER JOIN users b on a.id_user ' at line 1 - Invalid query: xSELECT a.*, b.nm_lengkap FROM tbl_pejabat a
		INNER JOIN users b on a.id_user = b.id_user
		WHERE a.id_jabatan='6' AND a.id_perusahaan='1' AND a.id_cabang='1'
ERROR - 2021-08-31 09:28:12 --> Severity: Notice --> Undefined variable: prsh D:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\jabatan\controllers\Jabatan.php 121
ERROR - 2021-08-31 09:28:12 --> Severity: Notice --> Undefined variable: cbg D:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\jabatan\controllers\Jabatan.php 121
ERROR - 2021-08-31 09:28:12 --> Severity: Notice --> Undefined variable: jabatan D:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\jabatan\controllers\Jabatan.php 123
ERROR - 2021-08-31 10:33:01 --> Severity: Notice --> Trying to get property 'id' of non-object D:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\jabatan\controllers\Jabatan.php 236
ERROR - 2021-08-31 10:33:01 --> Severity: Notice --> Trying to get property 'usr' of non-object D:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\jabatan\controllers\Jabatan.php 236
ERROR - 2021-08-31 10:33:01 --> Severity: Notice --> Undefined variable: prsh D:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\jabatan\controllers\Jabatan.php 236
ERROR - 2021-08-31 10:33:01 --> Severity: Notice --> Trying to get property 'cbg' of non-object D:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\jabatan\controllers\Jabatan.php 236
ERROR - 2021-08-31 10:35:13 --> Severity: Notice --> Trying to get property 'id' of non-object D:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\jabatan\controllers\Jabatan.php 236
ERROR - 2021-08-31 10:35:13 --> Severity: Notice --> Trying to get property 'usr' of non-object D:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\jabatan\controllers\Jabatan.php 236
ERROR - 2021-08-31 10:35:13 --> Severity: Notice --> Trying to get property 'prsh' of non-object D:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\jabatan\controllers\Jabatan.php 236
ERROR - 2021-08-31 10:35:13 --> Severity: Notice --> Trying to get property 'cbg' of non-object D:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\jabatan\controllers\Jabatan.php 236
ERROR - 2021-08-31 10:35:13 --> Query error: Unknown column 'ids' in 'where clause' - Invalid query: DELETE FROM `tbl_pejabat`
WHERE `ids` IS NULL
AND `id_user` IS NULL
AND `id_perusahaan` IS NULL
AND `id_cabang` IS NULL
ERROR - 2021-08-31 10:35:55 --> Query error: Unknown column 'ids' in 'where clause' - Invalid query: DELETE FROM `tbl_pejabat`
WHERE `ids` = '6'
AND `id_user` = '67'
AND `id_perusahaan` = '1'
AND `id_cabang` = '1'
ERROR - 2021-08-31 10:36:19 --> Query error: Unknown column 'ids' in 'where clause' - Invalid query: DELETE FROM `tbl_pejabat`
WHERE `ids` = '6'
AND `id_user` = '67'
AND `id_perusahaan` = '1'
AND `id_cabang` = '1'
ERROR - 2021-08-31 10:50:59 --> Severity: Notice --> Undefined variable: pejabat D:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\jabatan\views\add_jabatan.php 107
ERROR - 2021-08-31 10:50:59 --> Severity: Warning --> Invalid argument supplied for foreach() D:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\jabatan\views\add_jabatan.php 107
ERROR - 2021-08-31 10:59:55 --> Severity: Notice --> Undefined variable: pejabat D:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\jabatan\views\add_jabatan.php 107
ERROR - 2021-08-31 10:59:55 --> Severity: Warning --> Invalid argument supplied for foreach() D:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\jabatan\views\add_jabatan.php 107
ERROR - 2021-08-31 10:59:58 --> Severity: Notice --> Undefined index: cari D:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\jabatan\controllers\Jabatan.php 187
ERROR - 2021-08-31 11:00:48 --> Severity: Notice --> Undefined index: cari D:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\jabatan\controllers\Jabatan.php 187
ERROR - 2021-08-31 11:12:20 --> Severity: Notice --> Trying to get property 'id_jabatan' of non-object D:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\jabatan\controllers\Jabatan.php 195
ERROR - 2021-08-31 11:12:36 --> Severity: Notice --> Trying to get property 'id' of non-object D:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\jabatan\controllers\Jabatan.php 195
ERROR - 2021-08-31 11:12:48 --> Severity: Notice --> Undefined index: id D:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\jabatan\controllers\Jabatan.php 195
ERROR - 2021-08-31 11:13:51 --> Severity: Notice --> Undefined index: id D:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\jabatan\controllers\Jabatan.php 195
ERROR - 2021-08-31 11:14:21 --> Severity: Notice --> Trying to get property 'id' of non-object D:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\jabatan\controllers\Jabatan.php 195
ERROR - 2021-08-31 08:11:54 --> 404 Page Not Found: /index
ERROR - 2021-08-31 08:12:11 --> 404 Page Not Found: /index
ERROR - 2021-08-31 08:22:41 --> 404 Page Not Found: /index
ERROR - 2021-08-31 08:22:44 --> 404 Page Not Found: /index
ERROR - 2021-08-31 08:23:34 --> 404 Page Not Found: /index
ERROR - 2021-08-31 08:23:37 --> 404 Page Not Found: /index
ERROR - 2021-08-31 08:49:22 --> 404 Page Not Found: /index
ERROR - 2021-08-31 08:49:23 --> 404 Page Not Found: /index
ERROR - 2021-08-31 08:49:59 --> 404 Page Not Found: /index
ERROR - 2021-08-31 08:50:06 --> 404 Page Not Found: /index
ERROR - 2021-08-31 08:51:03 --> 404 Page Not Found: /index
ERROR - 2021-08-31 08:51:17 --> 404 Page Not Found: /index
ERROR - 2021-08-31 08:53:35 --> 404 Page Not Found: /index
ERROR - 2021-08-31 08:53:40 --> 404 Page Not Found: /index
ERROR - 2021-08-31 08:53:59 --> 404 Page Not Found: /index
ERROR - 2021-08-31 08:54:03 --> 404 Page Not Found: /index
ERROR - 2021-08-31 08:56:07 --> 404 Page Not Found: /index
ERROR - 2021-08-31 08:56:14 --> 404 Page Not Found: /index
ERROR - 2021-08-31 08:56:22 --> 404 Page Not Found: /index
ERROR - 2021-08-31 08:56:26 --> 404 Page Not Found: /index
ERROR - 2021-08-31 08:56:43 --> 404 Page Not Found: /index
ERROR - 2021-08-31 08:56:49 --> 404 Page Not Found: /index
ERROR - 2021-08-31 08:56:49 --> 404 Page Not Found: /index
ERROR - 2021-08-31 08:56:50 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:02:45 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:04:05 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:09:47 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:09:48 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:11:09 --> Severity: Notice --> Trying to access array offset on value of type null D:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\users\libraries\Auth.php 30
ERROR - 2021-08-31 09:11:09 --> Severity: Notice --> Trying to access array offset on value of type null D:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\users\libraries\Auth.php 30
ERROR - 2021-08-31 09:11:10 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:11:12 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:11:17 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:11:17 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:12:43 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:12:50 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:12:51 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:13:18 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:13:35 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:13:43 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:13:44 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:13:46 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:13:47 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:13:47 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:14:03 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:14:14 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:14:15 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:14:19 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:14:42 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:14:45 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:14:46 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:14:54 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:14:54 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:14:56 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:15:48 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:16:00 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:16:01 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:16:03 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:16:46 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:16:52 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:16:52 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:16:59 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:16:59 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:17:05 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:17:30 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:17:32 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:19:02 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:19:03 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:19:12 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:19:12 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:19:20 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:19:22 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:19:32 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:19:35 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:19:38 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:19:40 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:19:42 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:19:43 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:19:46 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:19:48 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:19:54 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:20:01 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:20:15 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:20:17 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:21:31 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:21:38 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:24:56 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:24:58 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:25:16 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:25:18 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:30:45 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:30:53 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:31:15 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:31:15 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:32:06 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:32:12 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:33:36 --> Severity: error --> Exception: Cannot use object of type Template as array D:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\users\libraries\Auth.php 77
ERROR - 2021-08-31 09:37:55 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:37:59 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:38:29 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:38:33 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:39:07 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:39:14 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:39:26 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:39:33 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:40:04 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:40:10 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:41:00 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:42:34 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:42:36 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:42:36 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:42:41 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:44:50 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:44:52 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:45:00 --> Severity: Notice --> Undefined property: Auth::$session D:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\users\libraries\Auth.php 76
ERROR - 2021-08-31 09:45:00 --> Severity: Notice --> Trying to get property 'userdata' of non-object D:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\users\libraries\Auth.php 76
ERROR - 2021-08-31 09:45:28 --> Severity: Notice --> Undefined property: Auth::$session D:\SENTRAL\SENTRALDOCS\sentraldocs\application\modules\users\libraries\Auth.php 76
ERROR - 2021-08-31 09:46:54 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:46:59 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:47:48 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:47:51 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:47:52 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:47:53 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:48:32 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:48:39 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:48:40 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:48:51 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:48:52 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:49:18 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:49:41 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:49:57 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:50:18 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:50:28 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:51:35 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:51:43 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:51:44 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:51:44 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:51:51 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:51:54 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:51:54 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:52:01 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:52:06 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:52:08 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:52:11 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:52:13 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:52:20 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:52:23 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:52:28 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:52:28 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:52:34 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:52:35 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:52:53 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:54:24 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:54:37 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:54:39 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:54:45 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:54:46 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:54:55 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:55:06 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:55:06 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:55:33 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:55:45 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:57:22 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:57:37 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:57:42 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:57:47 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:57:52 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:57:53 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:57:59 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:58:36 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:58:37 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:58:41 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:58:41 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:59:03 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:59:08 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:59:09 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:59:21 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:59:28 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:59:29 --> 404 Page Not Found: /index
ERROR - 2021-08-31 09:59:59 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:00:00 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:00:10 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:00:21 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:01:32 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:04:04 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:05:37 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:05:38 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:05:41 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:05:42 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:05:45 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:05:48 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:05:51 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:05:53 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:05:57 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:06:14 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:06:35 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:06:38 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:06:43 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:06:43 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:06:47 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:06:50 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:07:05 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:07:08 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:07:14 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:07:15 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:07:21 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:07:22 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:07:29 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:07:30 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:07:33 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:07:34 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:07:39 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:07:42 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:07:48 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:07:48 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:07:52 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:07:53 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:08:00 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:08:01 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:08:06 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:08:18 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:08:24 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:08:28 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:08:29 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:08:30 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:08:39 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:08:40 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:08:45 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:08:45 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:08:52 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:09:16 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:09:43 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:09:45 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:09:53 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:09:53 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:09:57 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:10:00 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:10:26 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:10:32 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:10:37 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:10:38 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:10:41 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:10:42 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:11:10 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:11:16 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:12:27 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:12:48 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:12:58 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:13:02 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:13:03 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:13:04 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:13:05 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:13:11 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:13:21 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:13:22 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:13:27 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:13:27 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:13:32 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:13:32 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:13:37 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:13:42 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:14:38 --> 404 Page Not Found: /index
ERROR - 2021-08-31 10:15:02 --> 404 Page Not Found: /index
