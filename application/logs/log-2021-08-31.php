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
