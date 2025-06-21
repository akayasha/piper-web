@extends('layouts.dashboard.app')
@section('title', 'Dashboard')
@section('subtitle', 'Analitik Dashboard')
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <!--begin::Row-->
            <div class="row gy-5 g-xl-8">
                <!--begin::Col-->
                <div class="col-xl-12">
                    <!--begin::Mixed Widget 2-->
                    <div class="card card-xl-stretch">
                        <!--begin::Header-->
                        <div class="card-header border-0" style="background: #191d38">
                            <h3 class="card-title fw-bolder text-white">Transaction Statistics</h3>
                            <div class="card-toolbar">
                                <!--begin::Menu-->
                                <button type="button" style="background: #fff! important; color: #191d38"
                                    class="btn btn-sm btn-icon  btn-active-color- border-0 me-n3"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg')}}-->
                                    <span class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="5" y="5" width="5" height="5" rx="1"
                                                    fill="#000000" />
                                                <rect x="14" y="5" width="5" height="5" rx="1"
                                                    fill="#000000" opacity="0.3" />
                                                <rect x="5" y="14" width="5" height="5" rx="1"
                                                    fill="#000000" opacity="0.3" />
                                                <rect x="14" y="14" width="5" height="5" rx="1"
                                                    fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </button>
                                <!--begin::Menu 3-->

                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3"
                                    data-kt-menu="true">
                                    <!--begin::Heading-->
                                    <div class="menu-item menu-item-counter px-3">
                                        <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Filter</div>
                                    </div>

                                    <!-- Year Filter -->
                                    <div class="menu-item menu-item-counter px-3" data-kt-menu-trigger="hover"
                                        data-kt-menu-placement="right-end">
                                        <a href="#" class="menu-link px-3">
                                            <span class="menu-title">Year</span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <!--begin::Menu sub-->
                                        <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                            <?php
                                            $currentYear = date('Y');
                                            $previousYear = $currentYear - 1;
                                            $nextYear = $currentYear + 1;
                                            ?>
                                            <div class="menu-item menu-item-counter px-3">
                                                <a href="#" class="menu-link px-3 filter-year"
                                                    data-value="<?= $nextYear ?>"><?= $nextYear ?></a>
                                            </div>
                                            <div class="menu-item menu-item-counter px-3">
                                                <a href="#" class="menu-link px-3 filter-year"
                                                    data-value="<?= $currentYear ?>"><?= $currentYear ?></a>
                                            </div>
                                            <div class="menu-item menu-item-counter px-3">
                                                <a href="#" class="menu-link px-3 filter-year"
                                                    data-value="<?= $previousYear ?>"><?= $previousYear ?></a>
                                            </div>
                                        </div>
                                        <!--end::Menu sub-->
                                    </div>

                                    <!-- Month Filter -->
                                    <div class="menu-item menu-item-counter px-3" data-kt-menu-trigger="hover"
                                        data-kt-menu-placement="right-end">
                                        <a href="#" class="menu-link px-3">
                                            <span class="menu-title">Month</span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        @php
                                            $months = [
                                                'January',
                                                'February',
                                                'March',
                                                'April',
                                                'May',
                                                'June',
                                                'July',
                                                'August',
                                                'September',
                                                'October',
                                                'November',
                                                'December',
                                            ];
                                        @endphp
                                        <div class="menu-sub menu-sub-dropdown w-175px py-4" id="monthDropdown"
                                            style="display: none;">
                                            @foreach ($months as $month)
                                                <div class="menu-item menu-item-counter px-3">
                                                    <a href="#"
                                                        class="menu-link px-3 filter-month">{{ $month }}</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Last 7 Days Filter -->
                                    <div class="menu-item menu-item-counter px-3 my-1">
                                        <a href="#" class="menu-link px-3 filter-last-7-days"
                                            data-value="Last 7 Days">Last 7 Days</a>
                                    </div>

                                    <!-- Today Filter -->
                                    <div class="menu-item menu-item-counter px-3 my-1">
                                        <a href="#" class="menu-link px-3 filter-today" data-value="Today">Today</a>
                                    </div>

                                    <!-- Apply Button -->
                                    <div class="menu-item menu-item-counter px-3 my-1">
                                        <a href="#" id="applyFilter"
                                            class="menu-link btn justify-content-center text-center btn-primary text-white text-bold px-3">Apply</a>
                                    </div>
                                </div>

                                <!--end::Menu 3-->
                                <!--end::Menu-->
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body p-0">
                            <!--begin::Chart-->
                            {{-- <div class="mixed-widget-2-chart card-rounded-bottom bg-" data-kt-color="primary"
                                style="height: 200px"></div> --}}
                            <!--end::Chart-->
                            <!--begin::Stats-->
                            <div class="card">
                                <!--begin::Row-->
                                <div class="row g-0">
                                    <!--begin::Col-->
                                    <div class="col-xl-4 px-6 py-6">
                                        <div
                                            class="bg-light-primary px-6 py-8 rounded-2 d-flex justify-content-between align-items-center">
                                            <div>
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg')}}-->
                                                <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3"
                                                            d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z"
                                                            fill="black" />
                                                        <path
                                                            d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z"
                                                            fill="black" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                <h1 href="#" class="text-primary fw-bold fs-6">Admin</h1>
                                            </div>
                                            <div>
                                                <h2 class="text-bold text-primary fs-1 mb-0" id="counter-admin">
                                                    {{ isset($datas['super_admin']) ? $datas['super_admin']->count() : 0 }}
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-xl-4 px-6 py-6">
                                        <div
                                            class="bg-light-primary px-6 py-8 rounded-2 d-flex justify-content-between align-items-center">
                                            <div>
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg')}}-->
                                                <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3"
                                                            d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z"
                                                            fill="black" />
                                                        <path
                                                            d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z"
                                                            fill="black" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                <h1 href="#" class="text-primary fw-bold fs-6">Admin Branch</h1>
                                            </div>
                                            <div>
                                                <h2 class="text-bold text-primary fs-1 mb-0" id="counter-admin-branch">
                                                    {{ isset($datas['admin_branch']) ? $datas['admin_branch']->count() : 0 }}
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-xl-4 px-6 py-6">
                                        <div
                                            class="bg-light-primary px-6 py-8 rounded-2 d-flex justify-content-between align-items-center">
                                            <div>
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg')}}-->
                                                <span
                                                    class="svg-icon svg-icon-primary svg-icon-2x mb-3"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Shopping/Cart1.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <title>Stockholm-icons / Shopping / Cart1</title>
                                                        <desc>Created with Sketch.</desc>
                                                        <defs />
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path
                                                                d="M18.1446364,11.84388 L17.4471627,16.0287218 C17.4463569,16.0335568 17.4455155,16.0383857 17.4446387,16.0432083 C17.345843,16.5865846 16.8252597,16.9469884 16.2818833,16.8481927 L4.91303792,14.7811299 C4.53842737,14.7130189 4.23500006,14.4380834 4.13039941,14.0719812 L2.30560137,7.68518803 C2.28007524,7.59584656 2.26712532,7.50338343 2.26712532,7.4104669 C2.26712532,6.85818215 2.71484057,6.4104669 3.26712532,6.4104669 L16.9929851,6.4104669 L17.606173,3.78251876 C17.7307772,3.24850086 18.2068633,2.87071314 18.7552257,2.87071314 L20.8200821,2.87071314 C21.4717328,2.87071314 22,3.39898039 22,4.05063106 C22,4.70228173 21.4717328,5.23054898 20.8200821,5.23054898 L19.6915238,5.23054898 L18.1446364,11.84388 Z"
                                                                fill="#000000" opacity="0.3" />
                                                            <path
                                                                d="M6.5,21 C5.67157288,21 5,20.3284271 5,19.5 C5,18.6715729 5.67157288,18 6.5,18 C7.32842712,18 8,18.6715729 8,19.5 C8,20.3284271 7.32842712,21 6.5,21 Z M15.5,21 C14.6715729,21 14,20.3284271 14,19.5 C14,18.6715729 14.6715729,18 15.5,18 C16.3284271,18 17,18.6715729 17,19.5 C17,20.3284271 16.3284271,21 15.5,21 Z"
                                                                fill="#000000" />
                                                        </g>
                                                    </svg><!--end::Svg Icon--></span>
                                                <!--end::Svg Icon-->
                                                <h1 href="#" class="text-primary fw-bold fs-6 mt-3">Transaction</h1>
                                            </div>
                                            <div>
                                                <h2 class="text-bold text-primary fs-1 mb-0" id="counter-transaction">
                                                    {{ isset($datas['transaction']) ? $datas['transaction']->count() : 0 }}
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->

                                <!--begin::Row-->
                                <div class="row g-0">
                                    <!--begin::Col-->
                                    <div class="col-xl-4 px-6 py-6">
                                        <div
                                            class="bg-light-primary px-6 py-8 rounded-2 d-flex justify-content-between align-items-center">
                                            <div>
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg')}}-->
                                                <span
                                                    class="svg-icon svg-icon-primary svg-icon-2x mb-3"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Shopping/Sale2.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <title>Stockholm-icons / Shopping / Sale2</title>
                                                        <desc>Created with Sketch.</desc>
                                                        <defs />
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <polygon fill="#000000" opacity="0.3"
                                                                points="12 20.0218549 8.47346039 21.7286168 6.86905972 18.1543453 3.07048824 17.1949849 4.13894342 13.4256452 1.84573388 10.2490577 5.08710286 8.04836581 5.3722735 4.14091196 9.2698837 4.53859595 12 1.72861679 14.7301163 4.53859595 18.6277265 4.14091196 18.9128971 8.04836581 22.1542661 10.2490577 19.8610566 13.4256452 20.9295118 17.1949849 17.1309403 18.1543453 15.5265396 21.7286168" />
                                                            <polygon fill="#000000"
                                                                points="14.0890818 8.60255815 8.36079737 14.7014391 9.70868621 16.049328 15.4369707 9.950447" />
                                                            <path
                                                                d="M10.8543431,9.1753866 C10.8543431,10.1252593 10.085524,10.8938719 9.13585777,10.8938719 C8.18793881,10.8938719 7.41737243,10.1252593 7.41737243,9.1753866 C7.41737243,8.22551387 8.18793881,7.45690126 9.13585777,7.45690126 C10.085524,7.45690126 10.8543431,8.22551387 10.8543431,9.1753866"
                                                                fill="#000000" opacity="0.3" />
                                                            <path
                                                                d="M14.8641422,16.6221564 C13.9162233,16.6221564 13.1456569,15.8535438 13.1456569,14.9036711 C13.1456569,13.9520555 13.9162233,13.1851857 14.8641422,13.1851857 C15.8138085,13.1851857 16.5826276,13.9520555 16.5826276,14.9036711 C16.5826276,15.8535438 15.8138085,16.6221564 14.8641422,16.6221564 Z"
                                                                fill="#000000" opacity="0.3" />
                                                        </g>
                                                    </svg><!--end::Svg Icon--></span>
                                                <!--end::Svg Icon-->
                                                <h1 href="#" class="text-primary fw-bold fs-6 mt-3">Voucher</h1>
                                            </div>
                                            <div>
                                                <h2 class="text-bold text-primary fs-1 mb-0" id="counter-voucher">
                                                    {{ isset($datas['voucher']) ? $datas['voucher']->count() : 0 }}
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-xl-4 px-6 py-6">
                                        <div
                                            class="bg-light-primary px-6 py-8 rounded-2 d-flex justify-content-between align-items-center">
                                            <div>
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg')}}-->
                                                <span
                                                    class="svg-icon svg-icon-primary svg-icon-2x mb-3"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Design/Image.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <title>Stockholm-icons / Design / Image</title>
                                                        <desc>Created with Sketch.</desc>
                                                        <defs />
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24" />
                                                            <path
                                                                d="M6,5 L18,5 C19.6568542,5 21,6.34314575 21,8 L21,17 C21,18.6568542 19.6568542,20 18,20 L6,20 C4.34314575,20 3,18.6568542 3,17 L3,8 C3,6.34314575 4.34314575,5 6,5 Z M5,17 L14,17 L9.5,11 L5,17 Z M16,14 C17.6568542,14 19,12.6568542 19,11 C19,9.34314575 17.6568542,8 16,8 C14.3431458,8 13,9.34314575 13,11 C13,12.6568542 14.3431458,14 16,14 Z"
                                                                fill="#000000" />
                                                        </g>
                                                    </svg><!--end::Svg Icon--></span>
                                                <!--end::Svg Icon-->
                                                <h1 href="#" class="text-primary fw-bold fs-6 mt-3">Template</h1>
                                            </div>
                                            <div>
                                                <h2 class="text-bold text-primary fs-1 mb-0" id="counter-template">
                                                    {{ isset($datas['template']) ? $datas['template']->count() : 0 }}
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-xl-4 px-6 py-6">
                                        <div
                                            class="bg-light-primary px-6 py-8 rounded-2 d-flex justify-content-between align-items-center">
                                            <div>
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg')}}-->
                                                <span
                                                    class="svg-icon svg-icon-primary svg-icon-2x mb-3"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Shopping/Ticket.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <title>Stockholm-icons / Shopping / Ticket</title>
                                                        <desc>Created with Sketch.</desc>
                                                        <defs />
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path
                                                                d="M3,10.0500091 L3,8 C3,7.44771525 3.44771525,7 4,7 L9,7 L9,9 C9,9.55228475 9.44771525,10 10,10 C10.5522847,10 11,9.55228475 11,9 L11,7 L21,7 C21.5522847,7 22,7.44771525 22,8 L22,10.0500091 C20.8588798,10.2816442 20,11.290521 20,12.5 C20,13.709479 20.8588798,14.7183558 22,14.9499909 L22,17 C22,17.5522847 21.5522847,18 21,18 L11,18 L11,16 C11,15.4477153 10.5522847,15 10,15 C9.44771525,15 9,15.4477153 9,16 L9,18 L4,18 C3.44771525,18 3,17.5522847 3,17 L3,14.9499909 C4.14112016,14.7183558 5,13.709479 5,12.5 C5,11.290521 4.14112016,10.2816442 3,10.0500091 Z M10,11 C9.44771525,11 9,11.4477153 9,12 L9,13 C9,13.5522847 9.44771525,14 10,14 C10.5522847,14 11,13.5522847 11,13 L11,12 C11,11.4477153 10.5522847,11 10,11 Z"
                                                                fill="#000000" opacity="0.3"
                                                                transform="translate(12.500000, 12.500000) rotate(-45.000000) translate(-12.500000, -12.500000) " />
                                                        </g>
                                                    </svg><!--end::Svg Icon--></span>
                                                <!--end::Svg Icon-->
                                                <h1 href="#" class="text-primary fw-bold fs-6 mt-3">Available
                                                    Voucher
                                                </h1>
                                            </div>
                                            <div>
                                                <h2 class="text-bold text-primary fs-1 mb-0"
                                                    id="counter-available-voucher">
                                                    {{ isset($datas['available_voucher']) ? $datas['available_voucher']->count() : 0 }}
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->

                                <!--begin::Row-->
                                <div class="row g-0">
                                    <!--begin::Col-->
                                    <div class="col-xl-4 px-6 py-6">
                                        <div
                                            class="bg-light-primary px-6 py-8 rounded-2 d-flex justify-content-between align-items-center">
                                            <div>
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg')}}-->
                                                <span
                                                    class="svg-icon svg-icon-primary svg-icon-2x mb-3"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Code/Git3.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <title>Stockholm-icons / Code / Git3</title>
                                                        <desc>Created with Sketch.</desc>
                                                        <defs />
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path
                                                                d="M7,11 L15,11 C16.1045695,11 17,10.1045695 17,9 L17,8 L19,8 L19,9 C19,11.209139 17.209139,13 15,13 L7,13 L7,15 C7,15.5522847 6.55228475,16 6,16 C5.44771525,16 5,15.5522847 5,15 L5,9 C5,8.44771525 5.44771525,8 6,8 C6.55228475,8 7,8.44771525 7,9 L7,11 Z"
                                                                fill="#000000" opacity="0.3" />
                                                            <path
                                                                d="M6,21 C7.1045695,21 8,20.1045695 8,19 C8,17.8954305 7.1045695,17 6,17 C4.8954305,17 4,17.8954305 4,19 C4,20.1045695 4.8954305,21 6,21 Z M6,23 C3.790861,23 2,21.209139 2,19 C2,16.790861 3.790861,15 6,15 C8.209139,15 10,16.790861 10,19 C10,21.209139 8.209139,23 6,23 Z"
                                                                fill="#000000" fill-rule="nonzero" />
                                                            <path
                                                                d="M18,7 C19.1045695,7 20,6.1045695 20,5 C20,3.8954305 19.1045695,3 18,3 C16.8954305,3 16,3.8954305 16,5 C16,6.1045695 16.8954305,7 18,7 Z M18,9 C15.790861,9 14,7.209139 14,5 C14,2.790861 15.790861,1 18,1 C20.209139,1 22,2.790861 22,5 C22,7.209139 20.209139,9 18,9 Z"
                                                                fill="#000000" fill-rule="nonzero" />
                                                            <path
                                                                d="M6,7 C7.1045695,7 8,6.1045695 8,5 C8,3.8954305 7.1045695,3 6,3 C4.8954305,3 4,3.8954305 4,5 C4,6.1045695 4.8954305,7 6,7 Z M6,9 C3.790861,9 2,7.209139 2,5 C2,2.790861 3.790861,1 6,1 C8.209139,1 10,2.790861 10,5 C10,7.209139 8.209139,9 6,9 Z"
                                                                fill="#000000" fill-rule="nonzero" />
                                                        </g>
                                                    </svg><!--end::Svg Icon--></span>
                                                <!--end::Svg Icon-->
                                                <h1 href="#" class="text-primary fw-bold fs-6 mt-3">Branch</h1>
                                            </div>
                                            <div>
                                                <h2 class="text-bold text-primary fs-1 mb-0" id="counter-branch">
                                                    {{ isset($datas['branch']) ? $datas['branch']->count() : 0 }}
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-xl-4 px-6 py-6">
                                        <div
                                            class="bg-light-primary px-6 py-8 rounded-2 d-flex justify-content-between align-items-center">
                                            <div>
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg')}}-->
                                                <span
                                                    class="svg-icon svg-icon-primary svg-icon-2x mb-3"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Shopping/Chart-line1.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <title>Stockholm-icons / Shopping / Chart-line1</title>
                                                        <desc>Created with Sketch.</desc>
                                                        <defs />
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path
                                                                d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z"
                                                                fill="#000000" fill-rule="nonzero" />
                                                            <path
                                                                d="M8.7295372,14.6839411 C8.35180695,15.0868534 7.71897114,15.1072675 7.31605887,14.7295372 C6.9131466,14.3518069 6.89273254,13.7189711 7.2704628,13.3160589 L11.0204628,9.31605887 C11.3857725,8.92639521 11.9928179,8.89260288 12.3991193,9.23931335 L15.358855,11.7649545 L19.2151172,6.88035571 C19.5573373,6.44687693 20.1861655,6.37289714 20.6196443,6.71511723 C21.0531231,7.05733733 21.1271029,7.68616551 20.7848828,8.11964429 L16.2848828,13.8196443 C15.9333973,14.2648593 15.2823707,14.3288915 14.8508807,13.9606866 L11.8268294,11.3801628 L8.7295372,14.6839411 Z"
                                                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                        </g>
                                                    </svg><!--end::Svg Icon--></span>
                                                <!--end::Svg Icon-->
                                                <h1 href="#" class="text-primary fw-bold fs-6 mt-3">Total Profit
                                                </h1>
                                            </div>
                                            <div>
                                                <h2 class="text-bold text-primary fs-1 mb-0" id="counter-profit">
                                                    @php
                                                        $totalPrize = collect($datas['transaction'])->sum('price');
                                                    @endphp
                                                    {{ isset($datas['transaction']) ? 'Rp ' . number_format($totalPrize, 2, ',', '.') : 'Rp 0,00' }}
                                                </h2>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-4 px-6 py-6">
                                        <div
                                            class="bg-light-primary px-6 py-8 rounded-2 d-flex justify-content-between align-items-center">
                                            <div>
                                                <h1 href="#" class="text-primary fw-bold fs-6">Filter By</h1>
                                                <h2 class="text-bold text-primary fs-1 mb-0" id="filter-result">-</h2>
                                            </div>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Mixed Widget 2-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const filterYearOptions = document.querySelectorAll('.filter-year');
        const filterMonthOptions = document.querySelectorAll('.filter-month');
        const filterLast7DaysOption = document.querySelector('.filter-last-7-days');
        const filterTodayOption = document.querySelector('.filter-today');
        const applyButton = document.getElementById('applyFilter');
        const monthDropdown = document.getElementById('monthDropdown');

        let selectedYear = null;
        let selectedMonth = null;
        let selectedTimeframe = null;

        filterYearOptions.forEach(option => {
            option.addEventListener('click', (event) => {
                event.preventDefault();
                selectedYear = option.dataset.value;
                filterYearOptions.forEach(opt => opt.classList.remove('active'));
                option.classList.add('active');
                selectedMonth = null;

                filterTodayOption.classList.remove('active');
                filterLast7DaysOption.classList.remove('active');
                selectedTimeframe = null;
            });
        });

        // Handle Month Filter
        filterMonthOptions.forEach(option => {
            option.addEventListener('click', (event) => {
                event.preventDefault();
                if (selectedYear !== null) {
                    selectedMonth = option.textContent.trim();
                    filterMonthOptions.forEach(opt => opt.classList.remove('active'));
                    option.classList.add('active');

                    filterTodayOption.classList.remove('active');
                    filterLast7DaysOption.classList.remove('active');
                    selectedTimeframe = null;
                }
            });
        });

        // Handle Last 7 Days Filter
        if (filterLast7DaysOption) {
            filterLast7DaysOption.addEventListener('click', (event) => {
                event.preventDefault();
                selectedTimeframe = filterLast7DaysOption.dataset.value;
                filterTodayOption.classList.remove('active');

                filterLast7DaysOption.classList.add('active');
                filterYearOptions.forEach(opt => opt.classList.remove('active'));
                filterMonthOptions.forEach(opt => opt.classList.remove('active'));

                selectedMonth = null;
                selectedYear = null;
            });
        }

        // Handle Today Filter
        if (filterTodayOption) {
            filterTodayOption.addEventListener('click', (event) => {
                event.preventDefault();
                selectedTimeframe = filterTodayOption.dataset.value;

                filterYearOptions.forEach(opt => opt.classList.remove('active'));
                filterMonthOptions.forEach(opt => opt.classList.remove('active'));
                filterLast7DaysOption.classList.remove('active');
                filterTodayOption.classList.add('active');

                selectedMonth = null;
                selectedYear = null;
            });
        }

        const menuItems = document.querySelectorAll('.menu-item-counter');
        menuItems.forEach(item => {
            item.addEventListener('click', (event) => {
                event.stopPropagation();
            });
        });

        applyButton.addEventListener('click', () => {
            fetch('/filter-data', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                    },
                    body: JSON.stringify({
                        year: selectedYear,
                        month: selectedMonth,
                        timeframe: selectedTimeframe,
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success == true) {
                        var filterpayload = data.filter_by;
                        var year = data.filter_by.year;
                        var month = data.filter_by.month;
                        var timeframe = data.filter_by.timeframe;

                        var monthNames = [
                            "January", "February", "March", "April", "May", "June",
                            "July", "August", "September", "October", "November", "December"
                        ];

                        if (year && month) {
                            toastr.success(`Filter berhasil diterapkan: ${month}, ${year}`, 'Berhasil');
                            updateInfoFilter(filterpayload);
                            updateUIWithData(data);
                        } else if (timeframe) {
                            if (timeframe === "Last 7 Days") {
                                toastr.success('Filter berhasil diterapkan: 7 hari terakhir', 'Berhasil');
                            } else if (timeframe === "Today") {
                                var today = new Date();
                                var formattedDate =
                                    `${today.getDate()} ${monthNames[today.getMonth()]}, ${today.getFullYear()}`;
                                toastr.success(`Filter berhasil diterapkan: ${formattedDate}`, 'Berhasil');
                            } else {
                                toastr.success(`Filter berhasil diterapkan: ${timeframe}`, 'Berhasil');
                            }
                            updateUIWithData(data);
                            updateInfoFilter(filterpayload);
                        } else {
                            toastr.warning('Filter gagal diterapkan: Data tidak lengkap', 'Kesalahan');
                        }
                    } else {
                        toastr.warning('Filter gagal diterapkan!', 'Kesalahan');
                    }

                })
                .catch(error => {
                    console.error('Error:', error);
                    toastr.error('Filter gagal diterapkan!', 'Kesalahan');
                });
        });

        function updateUIWithData(data) {
            if (data.success) {
                const totalPrize = data?.transaction && data.transaction.length > 0 ?
                    data.transaction.reduce((sum, transaction) => sum + (parseFloat(transaction.price) || 0), 0) : 0;

                const formattedTotalPrize = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }).format(totalPrize);

                document.getElementById('counter-profit').textContent = `${formattedTotalPrize}`;
                document.getElementById('counter-branch').textContent = data.branch?.length || 0;
                document.getElementById('counter-available-voucher').textContent = data.available_voucher?.length || 0;
                document.getElementById('counter-template').textContent = data.template?.length || 0;
                document.getElementById('counter-voucher').textContent = data.voucher?.length || 0;
                document.getElementById('counter-transaction').textContent = data.transaction?.length || 0;
                document.getElementById('counter-admin-branch').textContent = data.admin_branch?.length || 0;
                document.getElementById('counter-admin').textContent = data.super_admin?.length || 0;
            } else {
                console.error('Failed to update UI: Data fetch unsuccessful.');
            }
        }

        function updateInfoFilter(filters) {
            var filterElement = document.getElementById('filter-result');
            var year = filters.year;
            var month = filters.month;
            var timeframe = filters.timeframe;
            var monthNames = [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];
            var resultText = '';
            if (year && month) {
                resultText = `${month}, ${year}`;
            } else if (timeframe) {
                if (timeframe === "Last 7 Days") {
                    resultText = '7 hari terakhir';
                } else if (timeframe === "Today") {
                    var today = new Date();
                    resultText = `${today.getDate()} ${monthNames[today.getMonth()]}, ${today.getFullYear()}`;
                } else {
                    resultText = timeframe;
                }
            } else {
                resultText = 'Data tidak lengkap';
            }
            filterElement.textContent = resultText;
        }
    </script>
@endsection
