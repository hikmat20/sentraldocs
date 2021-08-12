<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-04-25 11:41:06 --> Severity: Notice --> Undefined variable: nama_program D:\xampp1\htdocs\medika\application\modules\users\views\login_animate.php 6
ERROR - 2020-04-25 11:41:07 --> 404 Page Not Found: /index
ERROR - 2020-04-25 11:41:20 --> Severity: Notice --> Undefined variable: nama_program D:\xampp1\htdocs\medika\application\modules\users\views\login_animate.php 6
ERROR - 2020-04-25 11:41:20 --> 404 Page Not Found: /index
ERROR - 2020-04-25 11:59:48 --> 404 Page Not Found: ../modules/pendaftaran/controllers/Pendaftaran/list_pasienri
ERROR - 2020-04-25 12:12:37 --> 404 Page Not Found: ../modules/pendaftaran/controllers/Pendaftaran/list_pasienri
ERROR - 2020-04-25 12:13:50 --> Severity: Notice --> Undefined variable: nama_program D:\xampp1\htdocs\medika\application\modules\users\views\login_animate.php 6
ERROR - 2020-04-25 12:13:50 --> 404 Page Not Found: /index
ERROR - 2020-04-25 17:14:06 --> Severity: Notice --> Undefined variable: datgroupmenu D:\xampp1\htdocs\medika\application\modules\menus\views\menus_form.php 73
ERROR - 2020-04-25 17:15:09 --> Severity: Notice --> Undefined variable: datgroupmenu D:\xampp1\htdocs\medika\application\modules\menus\views\menus_form.php 73
ERROR - 2020-04-25 17:15:23 --> Severity: Notice --> Undefined variable: datgroupmenu D:\xampp1\htdocs\medika\application\modules\menus\views\menus_form.php 73
ERROR - 2020-04-25 12:15:49 --> 404 Page Not Found: ../modules/pendaftaran/controllers/Pendaftaran/list_pasienri
ERROR - 2020-04-25 12:23:02 --> Severity: Compile Error --> Cannot redeclare Pendaftaran::list_pasienrj() D:\xampp1\htdocs\medika\application\modules\pendaftaran\controllers\Pendaftaran.php 636
ERROR - 2020-04-25 17:23:36 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '.`tgl_registrasi`, `a`.`noreg`, `a`.`medrec`, `a`.`umur_th`, `a`.`umur_bln`, `a`' at line 1 - Invalid query: SELECT `SELECT` `a`.`tgl_registrasi`, `a`.`noreg`, `a`.`medrec`, `a`.`umur_th`, `a`.`umur_bln`, `a`.`id_dokter`, `a`.`no_urut`, `a`.`id_customer`, `a`.`tgl_entry`, `a`.`asal_pasien`, `a`.`kode_kelas`, `a`.`id_ruang`, `a`.`id_bed`, `a`.`status_pulang`, `b`.`nama_pasien`, `b`.`status_pasien`, `d`.`nama_dokter`, `e`.`nama_customer`, `f`.`nama_kelas`, `g`.`nama_ruang`, h.nama_bed
	           FROM rs_hdtransaksiri as a inner join rs_pasien as b ON a.medrec=b.medrec 
			   inner join rs_dokter as d ON d.id_dokter=a.id_dokter 
			   inner join rs_customer as e ON e.id_customer=a.id_customer
			   inner join rs_kelas as f ON f.kode_kelas=a.kode_kelas  
			   inner join rs_ruang as g ON g.id_ruang=a.id_ruang
			   inner join rs_bed as h ON h.id_bed=a.id_bed WHERE a.kode_kelas='' AND a.status_pulang!='2'
ERROR - 2020-04-25 17:33:22 --> Severity: error --> Exception: syntax error, unexpected ''jenis_kelamin'' (T_CONSTANT_ENCAPSED_STRING), expecting identifier (T_STRING) or variable (T_VARIABLE) or '{' or '$' D:\xampp1\htdocs\medika\application\modules\pendaftaran\views\list_pasien_ri.php 56
ERROR - 2020-04-25 17:33:58 --> Severity: error --> Exception: syntax error, unexpected ''jenis_kelamin'' (T_CONSTANT_ENCAPSED_STRING), expecting identifier (T_STRING) or variable (T_VARIABLE) or '{' or '$' D:\xampp1\htdocs\medika\application\modules\pendaftaran\views\list_pasien_ri.php 56
ERROR - 2020-04-25 17:34:01 --> Severity: error --> Exception: syntax error, unexpected ''jenis_kelamin'' (T_CONSTANT_ENCAPSED_STRING), expecting identifier (T_STRING) or variable (T_VARIABLE) or '{' or '$' D:\xampp1\htdocs\medika\application\modules\pendaftaran\views\list_pasien_ri.php 56
ERROR - 2020-04-25 17:37:05 --> Severity: error --> Exception: syntax error, unexpected ']', expecting ',' or ';' D:\xampp1\htdocs\medika\application\modules\pendaftaran\views\list_pasien_ri.php 78
ERROR - 2020-04-25 17:37:27 --> Severity: error --> Exception: syntax error, unexpected '$record' (T_VARIABLE), expecting ',' or ';' D:\xampp1\htdocs\medika\application\modules\pendaftaran\views\list_pasien_ri.php 78
ERROR - 2020-04-25 17:37:51 --> Severity: error --> Exception: syntax error, unexpected 'Th' (T_STRING), expecting ',' or ';' D:\xampp1\htdocs\medika\application\modules\pendaftaran\views\list_pasien_ri.php 79
ERROR - 2020-04-25 17:39:19 --> Severity: Warning --> A non-numeric value encountered D:\xampp1\htdocs\medika\application\modules\pendaftaran\views\list_pasien_ri.php 83
ERROR - 2020-04-25 17:39:19 --> Severity: Warning --> A non-numeric value encountered D:\xampp1\htdocs\medika\application\modules\pendaftaran\views\list_pasien_ri.php 83
ERROR - 2020-04-25 17:39:19 --> Severity: Warning --> Division by zero D:\xampp1\htdocs\medika\application\modules\pendaftaran\views\list_pasien_ri.php 83
ERROR - 2020-04-25 17:39:19 --> Severity: Warning --> Division by zero D:\xampp1\htdocs\medika\application\modules\pendaftaran\views\list_pasien_ri.php 83
ERROR - 2020-04-25 17:39:19 --> Severity: Warning --> A non-numeric value encountered D:\xampp1\htdocs\medika\application\modules\pendaftaran\views\list_pasien_ri.php 83
ERROR - 2020-04-25 17:39:19 --> Severity: Warning --> A non-numeric value encountered D:\xampp1\htdocs\medika\application\modules\pendaftaran\views\list_pasien_ri.php 83
ERROR - 2020-04-25 17:39:19 --> Severity: Warning --> Division by zero D:\xampp1\htdocs\medika\application\modules\pendaftaran\views\list_pasien_ri.php 83
ERROR - 2020-04-25 17:39:19 --> Severity: Warning --> Division by zero D:\xampp1\htdocs\medika\application\modules\pendaftaran\views\list_pasien_ri.php 83
ERROR - 2020-04-25 17:39:19 --> Severity: Warning --> A non-numeric value encountered D:\xampp1\htdocs\medika\application\modules\pendaftaran\views\list_pasien_ri.php 83
ERROR - 2020-04-25 17:39:19 --> Severity: Warning --> A non-numeric value encountered D:\xampp1\htdocs\medika\application\modules\pendaftaran\views\list_pasien_ri.php 83
ERROR - 2020-04-25 17:39:19 --> Severity: Warning --> Division by zero D:\xampp1\htdocs\medika\application\modules\pendaftaran\views\list_pasien_ri.php 83
ERROR - 2020-04-25 17:39:19 --> Severity: Warning --> Division by zero D:\xampp1\htdocs\medika\application\modules\pendaftaran\views\list_pasien_ri.php 83
ERROR - 2020-04-25 17:39:19 --> Severity: Warning --> A non-numeric value encountered D:\xampp1\htdocs\medika\application\modules\pendaftaran\views\list_pasien_ri.php 83
ERROR - 2020-04-25 17:39:19 --> Severity: Warning --> A non-numeric value encountered D:\xampp1\htdocs\medika\application\modules\pendaftaran\views\list_pasien_ri.php 83
ERROR - 2020-04-25 17:39:19 --> Severity: Warning --> Division by zero D:\xampp1\htdocs\medika\application\modules\pendaftaran\views\list_pasien_ri.php 83
ERROR - 2020-04-25 17:39:19 --> Severity: Warning --> Division by zero D:\xampp1\htdocs\medika\application\modules\pendaftaran\views\list_pasien_ri.php 83
ERROR - 2020-04-25 17:39:19 --> Severity: Warning --> A non-numeric value encountered D:\xampp1\htdocs\medika\application\modules\pendaftaran\views\list_pasien_ri.php 83
ERROR - 2020-04-25 17:39:19 --> Severity: Warning --> A non-numeric value encountered D:\xampp1\htdocs\medika\application\modules\pendaftaran\views\list_pasien_ri.php 83
ERROR - 2020-04-25 17:39:19 --> Severity: Warning --> Division by zero D:\xampp1\htdocs\medika\application\modules\pendaftaran\views\list_pasien_ri.php 83
ERROR - 2020-04-25 17:39:19 --> Severity: Warning --> Division by zero D:\xampp1\htdocs\medika\application\modules\pendaftaran\views\list_pasien_ri.php 83
