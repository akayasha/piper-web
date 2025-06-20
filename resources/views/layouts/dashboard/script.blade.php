<script>var hostUrl = "{{ asset('template/base-admin/dist/assets') }}";</script>
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ asset('template/base-admin/dist/assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{ asset('template/base-admin/dist/assets/js/scripts.bundle.js')}}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="{{ asset('template/base-admin/dist/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
<script src="{{ asset('template/base-admin/dist/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{ asset('template/base-admin/dist/assets/js/widgets.bundle.js')}}"></script>
<script src="{{ asset('template/base-admin/dist/assets/js/custom/widgets.js')}}"></script>
<script src="{{ asset('template/base-admin/dist/assets/js/custom/apps/chat/chat.js')}}"></script>
<script src="{{ asset('template/base-admin/dist/assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
<script src="{{ asset('template/base-admin/dist/assets/js/custom/utilities/modals/create-app.js')}}"></script>
<script src="{{ asset('template/base-admin/dist/assets/js/custom/utilities/modals/users-search.js')}}"></script>
<!--end::Page Custom Javascript-->

@yield('script')

<script>
    function getCurrentYear() {
        return new Date().getFullYear() + '©';
    }

    document.addEventListener('DOMContentLoaded', function() {
        var yearSpan = document.getElementById('currentYear');
        if (yearSpan) {
            yearSpan.textContent = getCurrentYear();
        }
    });
</script>

{{--  SCRIPT PAYMENT MIDTRANS  --}}
{{--  <script>
    document.addEventListener('DOMContentLoaded', function () {
        var payButton = document.getElementById('pay-button');
        if (payButton) {
            var snapToken = payButton.getAttribute('data-token');
            if (snapToken) {
                payButton.addEventListener('click', function () {
                    window.snap.pay(snapToken, {
                        onSuccess: function (result) {
                            console.log('Payment success:', result);
                        },
                        onPending: function (result) {
                            console.log('Payment pending:', result);
                        },
                        onError: function (result) {
                            console.log('Payment error:', result);
                        },
                        onClose: function () {
                            console.log('Payment closed');
                        }
                    });
                });
            } else {
                console.error('snapToken is required');
            }
        }
    });
</script>  --}}
