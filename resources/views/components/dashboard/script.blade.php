<!--begin::Javascript-->
<script>
    var hostUrl = "assets/";
</script>
<script src="{{ asset('plugin/jquery-3.6.0.min.js') }}" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
{{-- <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script> --}}
<script src="{{ asset('assets/highchart12/code/highcharts.js') }}"></script>
<script src="{{ asset('assets/highchart12/code/highcharts-3d.js') }}"></script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.js') }}"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ asset('plugin/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugin/jszip.min.js') }}"></script>
<script src="{{ asset('js/toastify.js') }}"></script>
<script src="{{ asset('js/select2.js') }}"></script>
<script src="{{ asset('plugin/moment/moment.js') }}"></script>
<script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
<script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>
<script src="{{ asset('js/app/plugin.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/app/method.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/app/highchart.js') }}?v={{ time() }}"></script>
{{-- Main JS --}}
<script>
    $('#kt_app_sidebar_toggle').on('click', function() {
        if ($(this).hasClass('active')) {
            $('#text-logo').attr('hidden', false)
        } else {
            $('#text-logo').attr('hidden', true)
        }
    });
</script>
<!-- custom JS -->
@stack('script')
@stack('script_processing')

<!--end::Custom Javascript-->
<!--end::Javascript-->
