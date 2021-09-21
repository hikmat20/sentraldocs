 <!--begin::Footer-->
 <div class="footer bg-transparent py-4 d-flex flex-lg-column" id="kt_footer">
     <!--begin::Container-->
     <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
         <!--begin::Copyright-->
         <div class="text-dark order-2 order-md-1">
             <span class="text-muted font-weight-bold mr-2">Sentral Sistem© 2021</span>
             <!-- <a href="http://keenthemes.com/keen" target="_blank" class="text-dark-75 text-hover-primary">Keenthemes</a> -->
         </div>
         <!--end::Copyright-->
         <!--begin::Nav-->
         <div class="nav nav-dark order-1 order-md-2">
             <!-- <a href="http://keenthemes.com/keen" target="_blank" class="nav-link pr-3 pl-0">About</a>
             <a href="http://keenthemes.com/keen" target="_blank" class="nav-link px-3">Team</a>
             <a href="http://keenthemes.com/keen" target="_blank" class="nav-link pl-3 pr-0">Contact</a> -->
         </div>
         <!--end::Nav-->
     </div>
     <!--end::Container-->
 </div>
 <!--end::Footer-->
 </div>
 <!--end::Wrapper-->
 </div>
 <!--end::Page-->
 </div>
 <!--end::Main-->
 <!-- begin::User Panel-->
 <div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
     <!--begin::Header-->
     <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
         <h3 class="font-weight-bold m-0">Member since
             <small class="text-muted font-size-sm ml-2"><small><?= isset($userData->created_on) ? date('M Y', strtotime($userData->created_on)) : '-'; ?></small></small>
         </h3>
         <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
             <i class="ki ki-close icon-xs text-muted"></i>
         </a>
     </div>
     <!--end::Header-->
     <!--begin::Content-->
     <div class="offcanvas-content pr-5 mr-n5">
         <!--begin::Header-->
         <div class="d-flex align-items-center mt-5">
             <div class="symbol symbol-100 mr-5">
                 <div class="symbol-label" style="background-image:url(<?= (isset($userData->photo) && file_exists('assets/images/users/' . $userData->photo)) ? base_url('assets/images/users/' . $userData->photo) : base_url('assets/images/male-def.png'); ?>)"></div>
                 <i class="symbol-badge bg-success"></i>
             </div>
             <div class="d-flex flex-column">
                 <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"><?php echo isset($userData->nm_lengkap) ? ucwords($userData->nm_lengkap) : $userData->username; ?></span></a>
                 <div class="text-muted mt-1">
                     <?= isset($userData->groups) ? $userData->groups : '-'; ?>
                 </div>
                 <div class="navi mt-1">
                     <a href="#" class="navi-item">
                         <span class="navi-link p-0 pb-2">
                             <span class="navi-icon mr-1">
                                 <span class="svg-icon svg-icon-lg svg-icon-primary">
                                     <!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Communication/Mail-notification.svg-->
                                     <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                         <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                             <rect x="0" y="0" width="24" height="24" />
                                             <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
                                             <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
                                         </g>
                                     </svg>
                                     <!--end::Svg Icon-->
                                 </span>
                             </span>
                             <span class="navi-text text-muted text-hover-primary">ryan@keen.com</span>
                         </span>
                     </a>
                 </div>
             </div>
         </div>
         <!--end::Header-->
         <!--begin::Separator-->
         <div class="separator separator-dashed mt-8 mb-5"></div>
         <!--end::Separator-->
         <!--begin::Nav-->
         <div class="navi navi-spacer-x-0 p-0">
             <!--begin::Item-->
             <a href="custom/apps/user/profile-1/personal-information.html" class="navi-item">
                 <div class="navi-link">
                     <div class="symbol symbol-40 bg-light mr-3">
                         <div class="symbol-label">
                             <span class="svg-icon svg-icon-md svg-icon-danger">
                                 <!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Communication/Adress-book2.svg-->
                                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                     <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                         <rect x="0" y="0" width="24" height="24" />
                                         <path d="M18,2 L20,2 C21.6568542,2 23,3.34314575 23,5 L23,19 C23,20.6568542 21.6568542,22 20,22 L18,22 L18,2 Z" fill="#000000" opacity="0.3" />
                                         <path d="M5,2 L17,2 C18.6568542,2 20,3.34314575 20,5 L20,19 C20,20.6568542 18.6568542,22 17,22 L5,22 C4.44771525,22 4,21.5522847 4,21 L4,3 C4,2.44771525 4.44771525,2 5,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z" fill="#000000" />
                                     </g>
                                 </svg>
                                 <!--end::Svg Icon-->
                             </span>
                         </div>
                     </div>
                     <div class="navi-text">
                         <div class="font-weight-bold">My Account</div>
                         <div class="text-muted">Profile info
                             <span class="label label-light-danger label-inline font-weight-bold">update</span>
                         </div>
                     </div>
                 </div>
             </a>
             <!--end:Item-->
             <!--begin::Item-->
             <a href="custom/apps/user/profile-3.html" class="navi-item">
                 <div class="navi-link">
                     <div class="symbol symbol-40 bg-light mr-3">
                         <div class="symbol-label">
                             <span class="svg-icon svg-icon-md svg-icon-success">
                                 <!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/General/Settings-1.svg-->
                                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                     <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                         <rect x="0" y="0" width="24" height="24" />
                                         <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000" />
                                         <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3" />
                                     </g>
                                 </svg>
                                 <!--end::Svg Icon-->
                             </span>
                         </div>
                     </div>
                     <div class="navi-text">
                         <div class="font-weight-bold">My Tasks</div>
                         <div class="text-muted">Todo and tasks</div>
                     </div>
                 </div>
             </a>
             <!--end:Item-->
             <!--begin::Item-->
             <a href="custom/apps/user/profile-2.html" class="navi-item">
                 <div class="navi-link">
                     <div class="symbol symbol-40 bg-light mr-3">
                         <div class="symbol-label">
                             <span class="svg-icon svg-icon-md svg-icon-primary">
                                 <!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/General/Half-star.svg-->
                                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                     <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                         <polygon points="0 0 24 0 24 24 0 24" />
                                         <path d="M12,4.25932872 C12.1488635,4.25921584 12.3000368,4.29247316 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 L12,4.25932872 Z" fill="#000000" opacity="0.3" />
                                         <path d="M12,4.25932872 L12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.277344,4.464261 11.6315987,4.25960807 12,4.25932872 Z" fill="#000000" />
                                     </g>
                                 </svg>
                                 <!--end::Svg Icon-->
                             </span>
                         </div>
                     </div>
                     <div class="navi-text">
                         <div class="font-weight-bold">My Events</div>
                         <div class="text-muted">Logs and notifications</div>
                     </div>
                 </div>
             </a>
             <!--end:Item-->
             <!--begin::Item-->
             <a href="custom/apps/userprofile-1/overview.html" class="navi-item">
                 <div class="navi-link">
                     <div class="symbol symbol-40 bg-light mr-3">
                         <div class="symbol-label">
                             <span class="svg-icon svg-icon-md svg-icon-info">
                                 <!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Communication/Mail-opened.svg-->
                                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                     <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                         <rect x="0" y="0" width="24" height="24" />
                                         <path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M7.5,5 C7.22385763,5 7,5.22385763 7,5.5 C7,5.77614237 7.22385763,6 7.5,6 L13.5,6 C13.7761424,6 14,5.77614237 14,5.5 C14,5.22385763 13.7761424,5 13.5,5 L7.5,5 Z M7.5,7 C7.22385763,7 7,7.22385763 7,7.5 C7,7.77614237 7.22385763,8 7.5,8 L10.5,8 C10.7761424,8 11,7.77614237 11,7.5 C11,7.22385763 10.7761424,7 10.5,7 L7.5,7 Z" fill="#000000" opacity="0.3" />
                                         <path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" fill="#000000" />
                                     </g>
                                 </svg>
                                 <!--end::Svg Icon-->
                             </span>
                         </div>
                     </div>
                     <div class="navi-text">
                         <div class="font-weight-bold">My Statements</div>
                         <div class="text-muted">latest tasks and projects</div>
                     </div>
                 </div>
             </a>
             <!--end:Item-->
         </div>
         <!--end::Nav-->
     </div>
     <!--end::Content-->
 </div>
 <!-- end::User Panel-->

 <!--begin::Scrolltop-->
 <div id="kt_scrolltop" class="scrolltop">
     <span class="svg-icon">
         <!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Navigation/Up-2.svg-->
         <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
             <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                 <polygon points="0 0 24 0 24 24 0 24" />
                 <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                 <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
             </g>
         </svg>
         <!--end::Svg Icon-->
     </span>
 </div>
 <!--end::Scrolltop-->
 <div id="Processing"></div>
 <div id="ajaxFailed"></div>
 <!-- REQUIRED JS SCRIPTS -->
 <script>
     var KTAppSettings = {
         "breakpoints": {
             "sm": 576,
             "md": 768,
             "lg": 992,
             "xl": 1200,
             "xxl": 1200
         },
         "colors": {
             "theme": {
                 "base": {
                     "white": "#ffffff",
                     "primary": "#0BB783",
                     "secondary": "#E5EAEE",
                     "success": "#1BC5BD",
                     "info": "#8950FC",
                     "warning": "#FFA800",
                     "danger": "#F64E60",
                     "light": "#F3F6F9",
                     "dark": "#212121"
                 },
                 "light": {
                     "white": "#ffffff",
                     "primary": "#D7F9EF",
                     "secondary": "#ECF0F3",
                     "success": "#C9F7F5",
                     "info": "#EEE5FF",
                     "warning": "#FFF4DE",
                     "danger": "#FFE2E5",
                     "light": "#F3F6F9",
                     "dark": "#D6D6E0"
                 },
                 "inverse": {
                     "white": "#ffffff",
                     "primary": "#ffffff",
                     "secondary": "#212121",
                     "success": "#ffffff",
                     "info": "#ffffff",
                     "warning": "#ffffff",
                     "danger": "#ffffff",
                     "light": "#464E5F",
                     "dark": "#ffffff"
                 }
             },
             "gray": {
                 "gray-100": "#F3F6F9",
                 "gray-200": "#ECF0F3",
                 "gray-300": "#E5EAEE",
                 "gray-400": "#D6D6E0",
                 "gray-500": "#B5B5C3",
                 "gray-600": "#80808F",
                 "gray-700": "#464E5F",
                 "gray-800": "#1B283F",
                 "gray-900": "#212121"
             }
         },
         "font-family": "Poppins"
     };
 </script>
 <script src="<?= base_url('assets/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>
 <script src="<?= base_url(); ?>themes/dashboard/assets/plugins/global/plugins.bundle1036.js?v=2.1.1"></script>
 <script src="<?= base_url(); ?>themes/dashboard/assets/plugins/custom/prismjs/prismjs.bundle1036.js?v=2.1.1"></script>
 <script src="<?= base_url(); ?>themes/dashboard/assets/js/scripts.bundle1036.js?v=2.1.1"></script>
 <script src="<?= base_url(); ?>themes/dashboard/assets/plugins/custom/fullcalendar/fullcalendar.bundle1036.js?v=2.1.1"></script>
 <script src="<?= base_url(); ?>themes/dashboard/assets/js/pages/widgets1036.js?v=2.1.1"></script>
 <script src="<?= base_url('assets/plugins/select2/select2.full.min.js'); ?>"></script>
 <script src="<?= base_url(); ?>themes/dashboard/assets/plugins/custom/datatables/datatables.bundle1036.js"></script>
 <script>
     $(document).ready(function() {})

     function loading_spinner() {
         Swal.fire({
             title: 'Please wait...!',
             allowOutsideClick: false,
             didOpen: () => {
                 Swal.showLoading()
             }
         })
     }
 </script>
 </body>

 </html>