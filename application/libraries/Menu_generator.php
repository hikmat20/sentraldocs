<?php defined('BASEPATH') || exit('No direct script access allowed');

class Menu_generator
{
	protected $ci;
	protected $x; //Db Prefix
	protected $uri; //Current uri string
	protected $user_id;
	protected $is_admin;

	public function __construct()
	{
		$this->ci = &get_instance();

		$this->x = $this->ci->db->dbprefix;
		$this->uri = '/' . $this->ci->uri->uri_string() . '/';

		$this->ci->load->helper('app');
		//$this->ci->load->model('menus/users_model');
		$this->ci->load->library('users/auth');
		$this->user_id 	= $this->ci->auth->user_id();
		$this->is_admin = $this->ci->auth->is_admin();
	}

	public function build_menus($type = 1)
	{
		$auth = $this->get_auth_permission($this->user_id);
		if (!$auth) {
			$auth = array(NULL);
		}

		if ($type == 1) {
			$menu = $this->ci->db->select("t1.*")
				->from("{$this->x}menus as t1")
				->join("{$this->x}menus as t2", "t1.id = t2.parent_id", "left")
				//->join("{$this->x}menus as t3","t2.id = t3.parent_id","left")
				->where("t1.parent_id", 0)
				->where("t1.group_menu", $type)
				->where("t1.status", 1)
				->group_by("t1.id")
				->order_by("t1.order", "ASC")
				->get()
				->result();

			$html = "<ul class='sidebar-menu'>
							<li class='header'></li>
	                        <li class='" . check_class('dashboard', TRUE) . "'>
	                            <a href='" . site_url() . "'>
	                                <i class='fa fa-dashboard'></i> <span>Dashboard</span>
	                            </a>
	                        </li>";

			if (is_array($menu) && count($menu)) {
				foreach ($menu as $rw) {
					$id 		= $rw->id;
					$title 		= $rw->title;
					$link 		= $rw->link;
					$icon 		= $rw->icon;
					$target 	= $rw->target;
					$submenu = $this->ci->db->select("t1.*")
						->from("{$this->x}menus as t1")
						->where("t1.parent_id", $id)
						->where("t1.group_menu", $type)
						->where("t1.status", 1);
					if (!$this->is_admin) {
						$submenu = $submenu->where_in("t1.permission_id", $auth);
					}
					$submenu = $submenu->group_by("t1.id")
						->group_by("t1.id")
						->order_by("t1.order", "ASC")
						->get()
						->result();
					//Jump to end_for point
					if (count($submenu) == 0) {
						if ($link != "#") {
							if (!in_array($rw->permission_id, $auth) && $this->is_admin == FALSE) {
								goto end_for;
							}
							$active = "";
							if (strpos($this->uri, '/' . $link . '/') !== FALSE) {
								$active = "active";
							}
							$html .= "<li class='{$active}'><a href='" . ($link == '#' ? '#' : site_url($link)) . "' " . ($target == '_blank' ? "target='_blank'" : "") . ">
							<i class='{$icon}'></i> &nbsp;&nbsp;&nbsp;<span>" . ucwords($title) . "
							</span></a></li>";
						}
						goto end_for;
					}
					$active = "";
					foreach ($submenu as $sub) {
						if (strpos($this->uri, '/' . $sub->link . '/') !== FALSE) {
							$active = "active";
							break;
						}
					}
					$html .= "
            			  <li class='treeview {$active}'>
                      <a href='#'>
                        <i class='" . $icon . "'></i>
                        <span>" . ucwords($title) . "</span>
                        <span class='pull-right-container'>
						            	<i class='fa fa-angle-left pull-right'></i>
						          	</span>
                      </a>
                      <ul class='treeview-menu'>";

					//Make Sub Menu
					foreach ($submenu as $sub) {
						$subid 		= $sub->id;
						$subtitle 	= $sub->title;
						$sublink 	= $sub->link;
						$subicon 	= $sub->icon;
						$subtarget 	= $sub->target;
						$subtarget = "";
						if ($subtarget == '_blank') {
							$subtarget = "target='_blank'";
						}


						//Check current link
						if (strpos($this->uri, '/' . $sublink . '/') !== FALSE) {
							$active = "active";
						} else {
							$active = "";
						}
						$html .= "
						<li class='" . $active . "'>
							<a href='" . ($sublink == '#' ? '#' : site_url($sublink)) . "'" . " " . $subtarget . ">
							<i class='" . $subicon . "'></i>&nbsp;&nbsp;&nbsp;" . ucwords($subtitle) . "
							</a>
						</li>";
					}
					$html .= "
						</ul>
					</li>";

					//Jump Point
					end_for:;
					//END FOREACH MENU
				}
				$html .= "
					</ul>";
			}
		} else {
			//other menu
		}

		return $html;
	}

	public function show_menus($type = 1)
	{
		$html = '';
		$auth = $this->get_auth_permission($this->user_id);
		if (!$auth) {
			$auth = array(NULL);
		}

		if ($type == 1) {
			$menu = $this->ci->db->select("t1.*")
				->from("{$this->x}menus as t1")
				->join("{$this->x}menus as t2", "t1.id = t2.parent_id", "left")
				//->join("{$this->x}menus as t3","t2.id = t3.parent_id","left")
				->where("t1.parent_id", 0)
				->where("t1.group_menu", $type)
				->where("t1.status", 1)
				->group_by("t1.id")
				->order_by("t1.order", "ASC")
				->get()
				->result();
			$active_dash = (check_class('dashboard', TRUE)) ? 'menu-item-active' : '';
			$html = "<ul class='menu-nav'>
						<li class='menu-item " . $active_dash . "' aria-haspopup='true'>
							<a href='" . site_url() . "' class='menu-link'>
								<span class='svg-icon menu-icon'>
								<svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='24px' height='24px' viewBox='0 0 24 24' version='1.1'>
								<g stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'>
									<polygon points='0 0 24 0 24 24 0 24' />
									<path d='M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z' fill='#000000' fill-rule='nonzero' />
									<path d='M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z' fill='#000000' opacity='0.3' />
								</g>
								</svg>
							</span>
							<span class='menu-text'>
								<h6 class='m-0'>Dashboard</h6>
							</span>
							</a>
						</li>";

			if (is_array($menu) && count($menu)) {
				foreach ($menu as $rw) {
					$id 		= $rw->id;
					$title 		= $rw->title;
					$link 		= $rw->link;
					$icon 		= $rw->icon;
					$target 	= $rw->target;
					$submenu = $this->ci->db->select("t1.*")
						->from("{$this->x}menus as t1")
						->where("t1.parent_id", $id)
						->where("t1.group_menu", $type)
						->where("t1.status", 1);
					if (!$this->is_admin) {
						$submenu = $submenu->where_in("t1.permission_id", $auth);
					}
					$submenu = $submenu->group_by("t1.id")
						->group_by("t1.id")
						->order_by("t1.order", "ASC")
						->get()
						->result();
					//Jump to end_for point
					if (count($submenu) == 0) {
						if ($link != "#") {
							if (!in_array($rw->permission_id, $auth) && $this->is_admin == FALSE) {
								goto end_for;
							}
							$active = "";
							if (strpos($this->uri, '/' . $link . '/') !== FALSE) {
								$active = "menu-item-active";
							}
							$html .= "
							<li class='menu-item {$active}' aria-haspopup='true'>
							<a href='" . ($link == '#' ? '#' : site_url($link)) . "' " . ($target == '_blank' ? "target='_blank'" : "") . "' class='menu-link'>
								<span class='svg-icon menu-icon'>
									<i class='{$icon} mr-3'></i> 
								</span>
								<span class='menu-text'>
									<h6 class='m-0'>
									" . ucwords($title) . "
									</h6>
								</span>
							</a>
						</li>";
						}
						goto end_for;
					}
					$active = "";
					foreach ($submenu as $sub) {
						if (strpos($this->uri, '/' . $sub->link . '/') !== FALSE) {
							$active = "menu-item-active";
							break;
						}
					}
					$html .= "
            			<li class='menu-item menu-item-submenu " . $active . "' aria-haspopup='true' data-menu-toggle='hover'>
						  	<a href='#' class='menu-link menu-toggle'>
                        		<span class='svg-icon menu-icon'>
									<i class='" . $icon . " mr-3'></i>
								</span>
                        		<span class='menu-text'><h6 class='m-0'>" . ucwords($title) . "</h6></span>
								<i class='menu-arrow'></i>
                			</a>
							<div class='menu-submenu'>
								<i class='menu-arrow'></i>
								<ul class='menu-subnav'>";
					//Make Sub Menu
					foreach ($submenu as $sub) {
						$subid 		= $sub->id;
						$subtitle 	= $sub->title;
						$sublink 	= $sub->link;
						$subicon 	= $sub->icon;
						$subtarget 	= $sub->target;
						$subtarget = "";
						if ($subtarget == '_blank') {
							$subtarget = "target='_blank'";
						}


						//Check current link
						if (strpos($this->uri, '/' . $sublink . '/') !== FALSE) {
							$active = "menu-item-active";
						} else {
							$active = "";
						}
						$html .= "
						<li class='menu-item " . $active . "' aria-haspopup='true'>
							<a href='" . ($sublink == '#' ? '#' : site_url($sublink)) . "'" . " " . $subtarget . " class='menu-link'>
								<i class='menu-bullet mr-3 " . (($subicon) ? $subicon : 'menu-bullet-dot') . "'>
									<span></span>
								</i>
								 <span class='menu-text'>" . ucwords($subtitle) . "</span>
							</a>
						</li>";
					}
					$html .= "
						</ul>
					</li>";

					//Jump Point
					end_for:;
					//END FOREACH MENU
				}
				$html .= "
					</ul>";
			}
		} else {
			//other menu
		}

		return $html;
	}

	protected function get_auth_permission($user_id = 0)
	{
		$role_permissions = $this->ci->users_model->select("permissions.id_permission")
			->join("user_groups", "users.id_user = user_groups.id_user")
			->join("group_permissions", "user_groups.id_group = group_permissions.id_group")
			->join("permissions", "group_permissions.id_permission = permissions.id_permission")
			->where("users.id_user", $user_id)
			->find_all();

		$user_permissions = $this->ci->users_model->select("permissions.id_permission")
			->join("user_permissions", "users.id_user = user_permissions.id_user")
			->join("permissions", "user_permissions.id_permission = permissions.id_permission")
			->where("users.id_user", $user_id)
			->find_all();

		$merge = array();
		if ($role_permissions) {
			foreach ($role_permissions as $key => $rp) {
				if (!in_array($rp->id_permission, $merge)) {
					$merge[] = $rp->id_permission;
				}
			}
		}

		if ($user_permissions) {
			foreach ($user_permissions as $key => $up) {
				if (!in_array($up->id_permission, $merge)) {
					$merge[] = $up->id_permission;
				}
			}
		}

		return $merge;
	}
}
