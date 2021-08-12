<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-10-11 02:10:50 --> Severity: Notice --> Undefined variable: nama_program D:\xampp5635\htdocs\medika\application\modules\users\views\login_animate.php 6
ERROR - 2020-10-11 02:10:51 --> 404 Page Not Found: /index
ERROR - 2020-10-11 02:13:25 --> 404 Page Not Found: /index
ERROR - 2020-10-11 02:13:37 --> 404 Page Not Found: /index
ERROR - 2020-10-11 02:13:43 --> 404 Page Not Found: /index
ERROR - 2020-10-11 02:14:49 --> 404 Page Not Found: /index
ERROR - 2020-10-11 02:18:25 --> 404 Page Not Found: /index
ERROR - 2020-10-11 02:28:36 --> 404 Page Not Found: /index
ERROR - 2020-10-11 07:41:54 --> Severity: Error --> Call to undefined method Pendaftaran_model::GetPasienRI() D:\xampp5635\htdocs\medika\application\modules\pendaftaran\controllers\Pendaftaran.php 1064
ERROR - 2020-10-11 07:46:37 --> Severity: Error --> Call to undefined method Pendaftaran_model::GetPasienRI() D:\xampp5635\htdocs\medika\application\modules\pendaftaran\controllers\Pendaftaran.php 1064
ERROR - 2020-10-11 07:49:24 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp5635\htdocs\medika\application\modules\pendaftaran\views\form_tr_pendaftaran.php 22
ERROR - 2020-10-11 07:49:57 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp5635\htdocs\medika\application\modules\pendaftaran\views\form_tr_pendaftaran.php 22
ERROR - 2020-10-11 07:50:08 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp5635\htdocs\medika\application\modules\pendaftaran\views\form_tr_pendaftaran.php 22
ERROR - 2020-10-11 07:50:15 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp5635\htdocs\medika\application\modules\pendaftaran\views\form_tr_pendaftaran.php 22
ERROR - 2020-10-11 07:51:04 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp5635\htdocs\medika\application\modules\pendaftaran\views\form_tr_ranap.php 22
ERROR - 2020-10-11 08:01:09 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM rs_hdtransaksiri as a 
			   inner join rs_pasien as b ON a.medrec=b.medre' at line 2 - Invalid query: SELECT `a`.*, `b`.`nama_pasien`, `b`.`status_pasien`, `b`.`tgl_lahir`, `b`.`jenis_kelamin`, `d`.`nama_dokter`, `e`.`nama_customer`, `f`.`nama_kelas`, g.
	           FROM rs_hdtransaksiri as a 
			   inner join rs_pasien as b ON a.medrec=b.medrec 
			   inner join rs_dokter as d ON d.id_dokter=a.id_dokter 
			   inner join rs_customer as e ON e.id_customer=a.id_customer
			   inner join rs_kelas as f ON f.kode_kelas=a.kode_kelas
			   inner join rs_ruang as g ON g.id_ruang=a.id_ruang
			   inner join rs_bed as h ON h.id_bed=a.id_bed
			   inner join rs_bed_nomor as i ON i.id_nomorbed=a.nomor_bed
			   WHERE a.status_selesai!='1' AND a.noreg='RJ2007200001'
			   ORDER BY a.tgl_entry DESC, `d`.`nama_dokter`, `a`.`no_urut`
ERROR - 2020-10-11 08:01:52 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM rs_hdtransaksiri as a 
			   inner join rs_pasien as b ON a.medrec=b.medre' at line 2 - Invalid query: SELECT `a`.*, `b`.`nama_pasien`, `b`.`status_pasien`, `b`.`tgl_lahir`, `b`.`jenis_kelamin`, `d`.`nama_dokter`, `e`.`nama_customer`, `f`.`nama_kelas`, g.
	           FROM rs_hdtransaksiri as a 
			   inner join rs_pasien as b ON a.medrec=b.medrec 
			   inner join rs_dokter as d ON d.id_dokter=a.id_dokter 
			   inner join rs_customer as e ON e.id_customer=a.id_customer
			   inner join rs_kelas as f ON f.kode_kelas=a.kode_kelas
			   inner join rs_ruang as g ON g.id_ruang=a.id_ruang
			   inner join rs_bed as h ON h.id_bed=a.id_bed
			   inner join rs_bed_nomor as i ON i.id_nomorbed=a.nobed
			   WHERE a.status_selesai!='1' AND a.noreg='RJ2007200001'
			   ORDER BY a.tgl_entry DESC, `d`.`nama_dokter`, `a`.`no_urut`
ERROR - 2020-10-11 08:03:26 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM rs_hdtransaksiri as a 
			   inner join rs_pasien as b ON a.medrec=b.medre' at line 2 - Invalid query: SELECT `a`.*, `b`.`nama_pasien`, `b`.`status_pasien`, `b`.`tgl_lahir`, `b`.`jenis_kelamin`, `d`.`nama_dokter`, `e`.`nama_customer`, `f`.`nama_kelas`, g.
	           FROM rs_hdtransaksiri as a 
			   inner join rs_pasien as b ON a.medrec=b.medrec 
			   inner join rs_dokter as d ON d.id_dokter=a.id_dokter 
			   inner join rs_customer as e ON e.id_customer=a.id_customer
			   inner join rs_kelas as f ON f.kode_kelas=a.kode_kelas
			   inner join rs_ruang as g ON g.id_ruang=a.id_ruang
			   
			   WHERE a.status_selesai!='1' AND a.noreg='RJ2007200001'
			   ORDER BY a.tgl_entry DESC, `d`.`nama_dokter`, `a`.`no_urut`
ERROR - 2020-10-11 08:08:18 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp5635\htdocs\medika\application\modules\pendaftaran\views\form_tr_pendaftaran.php 22
ERROR - 2020-10-11 08:15:57 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp5635\htdocs\medika\application\modules\pendaftaran\views\form_tr_pendaftaran.php 22
ERROR - 2020-10-11 03:57:39 --> 404 Page Not Found: /index
ERROR - 2020-10-11 04:03:16 --> 404 Page Not Found: ../modules/perawat/controllers/Perawat/TrPendaftaranRi
ERROR - 2020-10-11 09:05:20 --> Severity: Error --> Call to a member function GetPasienRI() on null D:\xampp5635\htdocs\medika\application\modules\perawat\controllers\Perawat.php 1202
ERROR - 2020-10-11 09:06:34 --> Severity: Error --> Call to a member function GetPasienRI() on null D:\xampp5635\htdocs\medika\application\modules\perawat\controllers\Perawat.php 1202
ERROR - 2020-10-11 09:07:04 --> Severity: Error --> Call to a member function GetPasienRI() on null D:\xampp5635\htdocs\medika\application\modules\perawat\controllers\Perawat.php 1202
ERROR - 2020-10-11 09:07:46 --> Severity: Error --> Call to a member function GetPasienRI() on null D:\xampp5635\htdocs\medika\application\modules\perawat\controllers\Perawat.php 1202
ERROR - 2020-10-11 04:13:42 --> 404 Page Not Found: /index
ERROR - 2020-10-11 04:17:07 --> 404 Page Not Found: /index
ERROR - 2020-10-11 04:17:32 --> 404 Page Not Found: /index
ERROR - 2020-10-11 05:01:03 --> 404 Page Not Found: /index
ERROR - 2020-10-11 05:08:49 --> 404 Page Not Found: /index
ERROR - 2020-10-11 10:25:47 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp5635\htdocs\medika\application\modules\perawat\controllers\Perawat.php 1072
ERROR - 2020-10-11 10:25:54 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp5635\htdocs\medika\application\modules\perawat\controllers\Perawat.php 1072
ERROR - 2020-10-11 10:26:03 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp5635\htdocs\medika\application\modules\perawat\controllers\Perawat.php 1072
ERROR - 2020-10-11 05:35:57 --> 404 Page Not Found: /index
ERROR - 2020-10-11 05:45:54 --> Severity: Notice --> Undefined variable: datdept D:\xampp5635\htdocs\medika\application\modules\users\views\users_form.php 67
ERROR - 2020-10-11 05:45:54 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp5635\htdocs\medika\application\modules\users\views\users_form.php 67
ERROR - 2020-10-11 05:47:16 --> Could not find the language line "departemen"
ERROR - 2020-10-11 05:47:16 --> Severity: Notice --> Undefined variable: datdept D:\xampp5635\htdocs\medika\application\modules\users\views\users_form.php 67
ERROR - 2020-10-11 05:47:16 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp5635\htdocs\medika\application\modules\users\views\users_form.php 67
ERROR - 2020-10-11 05:48:41 --> Severity: Notice --> Undefined variable: datdept D:\xampp5635\htdocs\medika\application\modules\users\views\users_form.php 67
ERROR - 2020-10-11 05:48:41 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp5635\htdocs\medika\application\modules\users\views\users_form.php 67
ERROR - 2020-10-11 05:55:45 --> Severity: Notice --> Undefined variable: datdept D:\xampp5635\htdocs\medika\application\modules\users\views\users_form.php 67
ERROR - 2020-10-11 05:55:45 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp5635\htdocs\medika\application\modules\users\views\users_form.php 67
ERROR - 2020-10-11 06:04:53 --> Could not find the language line "divisi"
ERROR - 2020-10-11 06:09:05 --> Could not find the language line "dokter"
ERROR - 2020-10-11 06:09:37 --> Could not find the language line "dokter"
ERROR - 2020-10-11 06:17:12 --> Severity: Notice --> Undefined variable: nama_program D:\xampp5635\htdocs\medika\application\modules\users\views\login_animate.php 6
ERROR - 2020-10-11 06:23:38 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:38 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:38 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:38 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:38 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:38 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:38 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:38 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:56 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:56 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:56 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:56 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:56 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:56 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:56 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:56 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:56 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:56 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:56 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:56 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:57 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:57 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:57 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:57 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:57 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:57 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:23:57 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:24:04 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:24:04 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:24:04 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:24:04 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:24:04 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:24:04 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:24:04 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:24:04 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:29:13 --> Severity: Parsing Error --> syntax error, unexpected 'print_r' (T_STRING), expecting ';' or '{' D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 384
ERROR - 2020-10-11 06:31:35 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:31:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:31:35 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:31:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:31:35 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:31:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:31:35 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:31:35 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:35:09 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:35:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:35:09 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:35:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:35:09 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:35:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:35:09 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:35:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:35:09 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:35:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:35:09 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:35:09 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:35:11 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:35:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:35:11 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:35:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:35:11 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:35:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:35:11 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:35:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:11 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:11 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:11 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:17 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:17 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:17 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:17 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:17 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:17 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:17 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:17 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:17 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:17 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:17 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:17 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:18 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:18 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:18 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:18 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:18 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:18 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:18 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:18 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:18 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:18 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:18 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:18 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:18 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:18 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:18 --> Severity: Notice --> Undefined variable: data D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 06:57:18 --> Severity: Notice --> Trying to get property of non-object D:\xampp5635\htdocs\medika\application\modules\users\controllers\Setting.php 185
ERROR - 2020-10-11 11:57:37 --> Severity: Notice --> Undefined variable: datgroupmenu D:\xampp5635\htdocs\medika\application\modules\menus\views\menus_form.php 73
ERROR - 2020-10-11 06:58:28 --> Severity: Notice --> Undefined variable: nama_program D:\xampp5635\htdocs\medika\application\modules\users\views\login_animate.php 6
ERROR - 2020-10-11 06:58:28 --> 404 Page Not Found: /index
ERROR - 2020-10-11 06:58:52 --> Severity: Notice --> Undefined variable: nama_program D:\xampp5635\htdocs\medika\application\modules\users\views\login_animate.php 6
ERROR - 2020-10-11 06:58:52 --> 404 Page Not Found: /index
ERROR - 2020-10-11 11:59:01 --> Severity: Notice --> Undefined variable: datgroupmenu D:\xampp5635\htdocs\medika\application\modules\menus\views\menus_form.php 73
ERROR - 2020-10-11 06:59:37 --> 404 Page Not Found: /index
ERROR - 2020-10-11 11:59:53 --> Severity: Notice --> Undefined variable: datgroupmenu D:\xampp5635\htdocs\medika\application\modules\menus\views\menus_form.php 73
ERROR - 2020-10-11 12:00:40 --> Severity: Notice --> Undefined variable: datgroupmenu D:\xampp5635\htdocs\medika\application\modules\menus\views\menus_form.php 73
ERROR - 2020-10-11 07:00:45 --> Severity: Notice --> Undefined variable: nama_program D:\xampp5635\htdocs\medika\application\modules\users\views\login_animate.php 6
ERROR - 2020-10-11 07:00:45 --> 404 Page Not Found: /index
ERROR - 2020-10-11 07:00:55 --> 404 Page Not Found: /index
ERROR - 2020-10-11 07:01:10 --> Severity: Notice --> Undefined variable: nama_program D:\xampp5635\htdocs\medika\application\modules\users\views\login_animate.php 6
ERROR - 2020-10-11 07:01:10 --> 404 Page Not Found: /index
ERROR - 2020-10-11 12:04:06 --> Severity: Notice --> Undefined variable: datgroupmenu D:\xampp5635\htdocs\medika\application\modules\menus\views\menus_form.php 73
ERROR - 2020-10-11 07:09:45 --> Severity: Notice --> Undefined variable: nama_program D:\xampp5635\htdocs\medika\application\modules\users\views\login_animate.php 6
ERROR - 2020-10-11 07:09:45 --> 404 Page Not Found: /index
ERROR - 2020-10-11 07:09:56 --> 404 Page Not Found: /index
ERROR - 2020-10-11 07:10:06 --> Severity: Notice --> Undefined variable: nama_program D:\xampp5635\htdocs\medika\application\modules\users\views\login_animate.php 6
ERROR - 2020-10-11 07:10:06 --> 404 Page Not Found: /index
ERROR - 2020-10-11 12:10:16 --> Severity: Notice --> Undefined variable: datgroupmenu D:\xampp5635\htdocs\medika\application\modules\menus\views\menus_form.php 73
ERROR - 2020-10-11 12:10:29 --> Severity: Notice --> Undefined variable: datgroupmenu D:\xampp5635\htdocs\medika\application\modules\menus\views\menus_form.php 73
ERROR - 2020-10-11 08:00:07 --> 404 Page Not Found: /index
