<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-02-19 06:30:21 --> Severity: Warning --> Missing argument 1 for Pendaftaran_model::pilih_jadwal(), called in D:\xampp5635\htdocs\medika\application\modules\pendaftaran\controllers\Pendaftaran.php on line 1044 and defined D:\xampp5635\htdocs\medika\application\modules\pendaftaran\models\Pendaftaran_model.php 167
ERROR - 2021-02-19 06:30:21 --> Severity: Warning --> Missing argument 1 for Pendaftaran_model::pilih_jam(), called in D:\xampp5635\htdocs\medika\application\modules\pendaftaran\controllers\Pendaftaran.php on line 1046 and defined D:\xampp5635\htdocs\medika\application\modules\pendaftaran\models\Pendaftaran_model.php 187
ERROR - 2021-02-19 06:30:21 --> Severity: Warning --> Missing argument 2 for Pendaftaran_model::pilih_jam(), called in D:\xampp5635\htdocs\medika\application\modules\pendaftaran\controllers\Pendaftaran.php on line 1046 and defined D:\xampp5635\htdocs\medika\application\modules\pendaftaran\models\Pendaftaran_model.php 187
ERROR - 2021-02-19 00:37:20 --> Severity: Parsing Error --> syntax error, unexpected '}' D:\xampp5635\htdocs\medika\application\modules\pendaftaran\models\Pendaftaran_model.php 191
ERROR - 2021-02-19 00:37:38 --> Severity: Parsing Error --> syntax error, unexpected '$dept' (T_VARIABLE) D:\xampp5635\htdocs\medika\application\modules\pendaftaran\models\Pendaftaran_model.php 193
ERROR - 2021-02-19 00:38:04 --> Severity: Parsing Error --> syntax error, unexpected '' AND hari ='' (T_CONSTANT_ENCAPSED_STRING) D:\xampp5635\htdocs\medika\application\modules\pendaftaran\models\Pendaftaran_model.php 193
ERROR - 2021-02-19 06:39:13 --> Severity: Warning --> Missing argument 1 for Pendaftaran_model::pilih_jadwal(), called in D:\xampp5635\htdocs\medika\application\modules\pendaftaran\controllers\Pendaftaran.php on line 1044 and defined D:\xampp5635\htdocs\medika\application\modules\pendaftaran\models\Pendaftaran_model.php 167
ERROR - 2021-02-19 06:39:13 --> Severity: Warning --> Missing argument 1 for Pendaftaran_model::pilih_jam(), called in D:\xampp5635\htdocs\medika\application\modules\pendaftaran\controllers\Pendaftaran.php on line 1046 and defined D:\xampp5635\htdocs\medika\application\modules\pendaftaran\models\Pendaftaran_model.php 187
ERROR - 2021-02-19 06:39:13 --> Severity: Warning --> Missing argument 2 for Pendaftaran_model::pilih_jam(), called in D:\xampp5635\htdocs\medika\application\modules\pendaftaran\controllers\Pendaftaran.php on line 1046 and defined D:\xampp5635\htdocs\medika\application\modules\pendaftaran\models\Pendaftaran_model.php 187
ERROR - 2021-02-19 06:40:48 --> Severity: Warning --> Missing argument 1 for Pendaftaran_model::pilih_jadwal(), called in D:\xampp5635\htdocs\medika\application\modules\pendaftaran\controllers\Pendaftaran.php on line 1044 and defined D:\xampp5635\htdocs\medika\application\modules\pendaftaran\models\Pendaftaran_model.php 167
ERROR - 2021-02-19 06:40:48 --> Severity: Warning --> Missing argument 1 for Pendaftaran_model::pilih_jam(), called in D:\xampp5635\htdocs\medika\application\modules\pendaftaran\controllers\Pendaftaran.php on line 1046 and defined D:\xampp5635\htdocs\medika\application\modules\pendaftaran\models\Pendaftaran_model.php 187
ERROR - 2021-02-19 06:40:48 --> Severity: Warning --> Missing argument 2 for Pendaftaran_model::pilih_jam(), called in D:\xampp5635\htdocs\medika\application\modules\pendaftaran\controllers\Pendaftaran.php on line 1046 and defined D:\xampp5635\htdocs\medika\application\modules\pendaftaran\models\Pendaftaran_model.php 187
ERROR - 2021-02-19 06:40:48 --> Query error: Table 'jps_db.rs_departemendokterx' doesn't exist - Invalid query: SELECT
                rs_departemendokter.id_dokter as dokter_id,
				rs_dokter_schedule.id,
				rs_dokter_schedule.id_dokter,
                rs_dokter_schedule.nama_dokter,
				rs_dokter_schedule.days,
				rs_dokter_schedule.hari,
				rs_dokter_schedule.jam_awal,
				rs_dokter_schedule.jam_akhir
				FROM
                rs_departemendokterx
				inner join rs_dokter_schedule on rs_departemendokter.id_dokter = rs_dokter_schedule.id_dokter
				
ERROR - 2021-02-19 06:40:56 --> Severity: Warning --> Missing argument 1 for Pendaftaran_model::pilih_jadwal(), called in D:\xampp5635\htdocs\medika\application\modules\pendaftaran\controllers\Pendaftaran.php on line 1044 and defined D:\xampp5635\htdocs\medika\application\modules\pendaftaran\models\Pendaftaran_model.php 167
ERROR - 2021-02-19 06:40:56 --> Severity: Warning --> Missing argument 1 for Pendaftaran_model::pilih_jam(), called in D:\xampp5635\htdocs\medika\application\modules\pendaftaran\controllers\Pendaftaran.php on line 1046 and defined D:\xampp5635\htdocs\medika\application\modules\pendaftaran\models\Pendaftaran_model.php 187
ERROR - 2021-02-19 06:40:56 --> Severity: Warning --> Missing argument 2 for Pendaftaran_model::pilih_jam(), called in D:\xampp5635\htdocs\medika\application\modules\pendaftaran\controllers\Pendaftaran.php on line 1046 and defined D:\xampp5635\htdocs\medika\application\modules\pendaftaran\models\Pendaftaran_model.php 187
ERROR - 2021-02-19 06:40:56 --> Query error: Table 'jps_db.rs_departemendokterx' doesn't exist - Invalid query: SELECT
                rs_departemendokter.id_dokter as dokter_id,
				rs_dokter_schedule.id,
				rs_dokter_schedule.id_dokter,
                rs_dokter_schedule.nama_dokter,
				rs_dokter_schedule.days,
				rs_dokter_schedule.hari,
				rs_dokter_schedule.jam_awal,
				rs_dokter_schedule.jam_akhir
				FROM
                rs_departemendokterx
				inner join rs_dokter_schedule on rs_departemendokter.id_dokter = rs_dokter_schedule.id_dokter
				
ERROR - 2021-02-19 06:44:37 --> Severity: Warning --> Missing argument 1 for Pendaftaran_model::pilih_jadwal(), called in D:\xampp5635\htdocs\medika\application\modules\pendaftaran\controllers\Pendaftaran.php on line 1044 and defined D:\xampp5635\htdocs\medika\application\modules\pendaftaran\models\Pendaftaran_model.php 167
ERROR - 2021-02-19 06:44:37 --> Severity: Warning --> Missing argument 1 for Pendaftaran_model::pilih_jam(), called in D:\xampp5635\htdocs\medika\application\modules\pendaftaran\controllers\Pendaftaran.php on line 1046 and defined D:\xampp5635\htdocs\medika\application\modules\pendaftaran\models\Pendaftaran_model.php 195
ERROR - 2021-02-19 06:44:37 --> Severity: Warning --> Missing argument 2 for Pendaftaran_model::pilih_jam(), called in D:\xampp5635\htdocs\medika\application\modules\pendaftaran\controllers\Pendaftaran.php on line 1046 and defined D:\xampp5635\htdocs\medika\application\modules\pendaftaran\models\Pendaftaran_model.php 195
ERROR - 2021-02-19 06:44:37 --> Query error: Table 'jps_db.rs_departemendokterx' doesn't exist - Invalid query: SELECT
                rs_departemendokter.id_dokter as dokter_id,
				rs_dokter_schedule.id,
				rs_dokter_schedule.id_dokter,
                rs_dokter_schedule.nama_dokter,
				rs_dokter_schedule.days,
				rs_dokter_schedule.hari,
				rs_dokter_schedule.jam_awal,
				rs_dokter_schedule.jam_akhir
				FROM
                rs_departemendokterx
				inner join rs_dokter_schedule on rs_departemendokter.id_dokter = rs_dokter_schedule.id_dokter
				
ERROR - 2021-02-19 06:54:57 --> Severity: Parsing Error --> syntax error, unexpected '$awal' (T_VARIABLE), expecting ',' or ';' D:\xampp5635\htdocs\medika\application\modules\pendaftaran\views\form_update_rj.php 299
ERROR - 2021-02-19 07:44:07 --> Severity: Parsing Error --> syntax error, unexpected end of file D:\xampp5635\htdocs\medika\application\modules\pendaftaran\views\form_update_rj.php 652
ERROR - 2021-02-19 07:47:33 --> Severity: Warning --> Missing argument 1 for Pendaftaran_model::pilih_jaminan(), called in D:\xampp5635\htdocs\medika\application\modules\pendaftaran\controllers\Pendaftaran.php on line 1048 and defined D:\xampp5635\htdocs\medika\application\modules\pendaftaran\models\Pendaftaran_model.php 243
ERROR - 2021-02-19 12:20:13 --> Severity: Notice --> Undefined variable: nama_program D:\xampp5635\htdocs\medika\application\modules\users\views\login_animate.php 6
