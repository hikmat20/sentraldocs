<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-06-07 07:01:22 --> Severity: Notice --> Undefined variable: nama_program D:\xampp5635\htdocs\mom\application\modules\users\views\login_animate.php 6
ERROR - 2021-06-07 12:01:42 --> Severity: Notice --> Undefined variable: datgroupmenu D:\xampp5635\htdocs\mom\application\modules\menus\views\menus_form.php 73
ERROR - 2021-06-07 07:02:56 --> Severity: Notice --> Undefined variable: nama_program D:\xampp5635\htdocs\mom\application\modules\users\views\login_animate.php 6
ERROR - 2021-06-07 11:18:42 --> Severity: Notice --> Undefined variable: nama_program D:\xampp5635\htdocs\mom\application\modules\users\views\login_animate.php 6
ERROR - 2021-06-07 11:57:08 --> Severity: Notice --> Undefined variable: nama_program D:\xampp5635\htdocs\mom\application\modules\users\views\login_animate.php 6
ERROR - 2021-06-07 12:01:34 --> Severity: Parsing Error --> syntax error, unexpected '"</div>"' (T_CONSTANT_ENCAPSED_STRING) D:\xampp5635\htdocs\mom\application\modules\meeting\controllers\Meeting.php 570
ERROR - 2021-06-07 12:37:24 --> Severity: Notice --> Undefined variable: nama_program D:\xampp5635\htdocs\mom\application\modules\users\views\login_animate.php 6
ERROR - 2021-06-07 12:37:30 --> Query error: Unknown column 'Syamsudin' in 'where clause' - Invalid query: SELECT *
            FROM
            tbl_meeting_detail
            WHERE nama_pic=Syamsudin AND
            status=0
ERROR - 2021-06-07 12:42:22 --> Severity: Notice --> Undefined variable: nama_program D:\xampp5635\htdocs\mom\application\modules\users\views\login_animate.php 6
ERROR - 2021-06-07 12:53:00 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No connection could be made because the target machine actively refused it.
 D:\xampp5635\htdocs\mom\system\database\drivers\mysqli\mysqli_driver.php 202
ERROR - 2021-06-07 12:53:00 --> Unable to connect to the database
ERROR - 2021-06-07 19:02:59 --> Query error: FUNCTION a.DATE does not exist. Check the 'Function Name Parsing and Resolution' section in the Reference Manual - Invalid query: SELECT a.*, b.subject, b.sub_subject, b.description FROM tbl_meeting_detail a
			INNER JOIN tbl_meeting b ON b.kd_meeting=a.kd_meeting
			WHERE
			(a.due_date < a.done_date OR (a.status=0 AND a.due_date < a.DATE(NOW)))  AND 
		    (
			a.tgl_detail LIKE '%%'
			OR
			a.problem LIKE '%%'
			OR
			a.action_plan LIKE '%%'
			OR
			b.subject LIKE '%%'
			OR
			b.sub_subject LIKE '%%'
			
			)
ERROR - 2021-06-07 19:03:02 --> Query error: FUNCTION a.DATE does not exist. Check the 'Function Name Parsing and Resolution' section in the Reference Manual - Invalid query: SELECT a.*, b.subject, b.sub_subject, b.description FROM tbl_meeting_detail a
			INNER JOIN tbl_meeting b ON b.kd_meeting=a.kd_meeting
			WHERE
			(a.due_date < a.done_date OR (a.status=0 AND a.due_date < a.DATE(NOW)))  AND 
		    (
			a.tgl_detail LIKE '%%'
			OR
			a.problem LIKE '%%'
			OR
			a.action_plan LIKE '%%'
			OR
			b.subject LIKE '%%'
			OR
			b.sub_subject LIKE '%%'
			
			)
ERROR - 2021-06-07 19:03:35 --> Query error: FUNCTION a.DATE does not exist. Check the 'Function Name Parsing and Resolution' section in the Reference Manual - Invalid query: SELECT a.*, b.subject, b.sub_subject, b.description FROM tbl_meeting_detail a
			INNER JOIN tbl_meeting b ON b.kd_meeting=a.kd_meeting
			WHERE
			(a.due_date < a.done_date OR (a.status=0 AND a.due_date < a.DATE(NOW)))  AND 
		    (
			a.tgl_detail LIKE '%%'
			OR
			a.problem LIKE '%%'
			OR
			a.action_plan LIKE '%%'
			OR
			b.subject LIKE '%%'
			OR
			b.sub_subject LIKE '%%'
			
			)
ERROR - 2021-06-07 14:12:25 --> Severity: Notice --> Undefined variable: nama_program D:\xampp5635\htdocs\mom\application\modules\users\views\login_animate.php 6
