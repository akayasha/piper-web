<div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
    id="#kt_aside_menu" data-kt-menu="true">
    <div class="menu-item {{ request()->is('/') ? 'here show' : '' }}">
        <a class="menu-link" href="{{ route('dashboard') }}">
            <span class="menu-icon">
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
                        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2"
                            fill="black" />
                        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
                    </svg>
                </span>
            </span>
            <span class="menu-title">Dashboard</span>
        </a>
        <div class="menu-item">
            <div class="menu-content pt-8 pb-2">
                <span class="menu-section text-muted text-uppercase fs-8 ls-1">INFORMATION DATA</span>
            </div>
        </div>
        <div data-kt-menu-trigger="click"
            class="menu-item {{ request()->is('templates*', 'branchs*') ? 'here show' : '' }} menu-accordion">
            <span class="menu-link">
                <span class="menu-icon">
                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg')}}-->
                    <span class="svg-icon svg-icon-2">
                        <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->

                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <path
                                    d="M4.5,21 L21.5,21 C22.3284271,21 23,20.3284271 23,19.5 L23,8.5 C23,7.67157288 22.3284271,7 21.5,7 L11,7 L8.43933983,4.43933983 C8.15803526,4.15803526 7.77650439,4 7.37867966,4 L4.5,4 C3.67157288,4 3,4.67157288 3,5.5 L3,19.5 C3,20.3284271 3.67157288,21 4.5,21 Z"
                                    fill="black" opacity="0.3" />
                                <path
                                    d="M2.5,19 L19.5,19 C20.3284271,19 21,18.3284271 21,17.5 L21,6.5 C21,5.67157288 20.3284271,5 19.5,5 L9,5 L6.43933983,2.43933983 C6.15803526,2.15803526 5.77650439,2 5.37867966,2 L2.5,2 C1.67157288,2 1,2.67157288 1,3.5 L1,17.5 C1,18.3284271 1.67157288,19 2.5,19 Z"
                                    fill="black" />
                            </g>
                        </svg><!--end::Svg Icon-->

                        <!--end::Svg Icon-->
                    </span>
                    <!--end::Svg Icon-->
                </span>
                <span class="menu-title">Master Data</span>
                <span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion menu-active-bg">
                {{-- <div class="menu-item">
                    <a class="menu-link {{ request()->is('templates*') ? 'active' : '' }}"
                        href="{{ route('templates.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title gap-3">Template</span>
                    </a>
                </div> --}}
                {{-- {{ route('templates.index') }} --}}
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('branchs*') ? 'active' : '' }}"
                        href="{{ route('branchs.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Branch</span>
                    </a>
                </div>
            </div>
        </div>
        <div data-kt-menu-trigger="click"
            class="menu-item {{ request()->is('transactions*', 'vouchers*') ? 'here show' : '' }} menu-accordion">
            <span class="menu-link">
                <span class="menu-icon">
                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg')}}-->
                    <span class="svg-icon svg-icon-2">
                        <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->

                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" version="1.1">
                            <path opacity="0.3"
                                d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z"
                                fill="black" />
                            <path
                                d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z"
                                fill="black" />
                            <path
                                d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z"
                                fill="black" />
                        </svg>

                        <!--end::Svg Icon-->
                    </span>
                    <!--end::Svg Icon-->
                </span>
                <span class="menu-title">Order</span>
                <span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion menu-active-bg">
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('transactions*') ? 'active' : '' }}"
                        href="{{ route('transactions.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Transaction</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('vouchers*') ? 'active' : '' }}"
                        href="{{ route('vouchers.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Voucher</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('history-moments*') ? 'active' : '' }}"
                        href="{{ route('history-moments.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">History Moment</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('feedbacks*') ? 'active' : '' }}"
                        href="{{ route('feedbacks.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Feedback</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if(!auth()->user()->branch)
    <div class="menu-item">
        <div class="menu-content pt-8 pb-2">
            <span class="menu-section text-muted text-uppercase fs-8 ls-1">System Management</span>
        </div>
    </div>
    <div data-kt-menu-trigger="click"
        class="menu-item {{ request()->is('admins*') ? 'here show' : '' }} menu-accordion">
        <span class="menu-link">
            <span class="menu-icon">
                <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg')}}-->
                <span class="svg-icon svg-icon-2">
                    <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                                fill="black" />
                            <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4"
                                fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </span>
                <!--end::Svg Icon-->
            </span>
            <span class="menu-title">User Management</span>
            <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion menu-active-bg">
            <div class="menu-item">
                <a class="menu-link {{ request()->is('admins*') ? 'active' : '' }}"
                    href="{{ route('admins.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Admin</span>
                </a>
            </div>
            {{--  <div class="menu-item">
                <a class="menu-link {{ request()->is('employees*') ? 'active' : '' }}"
                    href="{{ route('employees.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Employee</span>
                </a>
            </div>  --}}
        </div>
    </div>
    @endif

    {{--  <div class="menu-item">
        <a class="menu-link" href="{{ route('dashboard') }}">
            <span class="menu-icon">
                <!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg')}}-->
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M16.95 18.9688C16.75 18.9688 16.55 18.8688 16.35 18.7688C15.85 18.4688 15.75 17.8688 16.05 17.3688L19.65 11.9688L16.05 6.56876C15.75 6.06876 15.85 5.46873 16.35 5.16873C16.85 4.86873 17.45 4.96878 17.75 5.46878L21.75 11.4688C21.95 11.7688 21.95 12.2688 21.75 12.5688L17.75 18.5688C17.55 18.7688 17.25 18.9688 16.95 18.9688ZM7.55001 18.7688C8.05001 18.4688 8.15 17.8688 7.85 17.3688L4.25001 11.9688L7.85 6.56876C8.15 6.06876 8.05001 5.46873 7.55001 5.16873C7.05001 4.86873 6.45 4.96878 6.15 5.46878L2.15 11.4688C1.95 11.7688 1.95 12.2688 2.15 12.5688L6.15 18.5688C6.35 18.8688 6.65 18.9688 6.95 18.9688C7.15 18.9688 7.35001 18.8688 7.55001 18.7688Z" fill="black" />
                        <path opacity="0.3" d="M10.45 18.9687C10.35 18.9687 10.25 18.9687 10.25 18.9687C9.75 18.8687 9.35 18.2688 9.55 17.7688L12.55 5.76878C12.65 5.26878 13.25 4.8687 13.75 5.0687C14.25 5.1687 14.65 5.76878 14.45 6.26878L11.45 18.2688C11.35 18.6688 10.85 18.9687 10.45 18.9687Z" fill="black" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </span>
            <span class="menu-title">Coming Soon...</span>
        </a>
    </div>  --}}
</div>
