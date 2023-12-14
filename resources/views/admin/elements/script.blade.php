<!--    jQuery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!-- plugins:js -->
{{--<script src="../../../public/vendors/css/vendor_bundle_base.css"></script>--}}
<script src="{{asset('vendors/css/vendor_bundle_base.css')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
{{--<script src="../../../public/vendors/chart.js/Chart.min.js"></script>--}}
{{--<script src="{{asset('vendors/chart.js/Chart.min.js')}}"></script>--}}
{{--<script src="../../../public/vendors/moment/moment.min.js"></script>--}}
<script src="{{asset('vendors/moment/moment.min.js')}}"></script>
{{--<script src="../../../public/vendors/daterangepicker/daterangepicker.js"></script>--}}
<script src="{{asset('vendors/daterangepicker/daterangepicker.js')}}"></script>
{{--<script src="../../../public/vendors/chartist/chartist.min.js"></script>--}}
{{--<script src="{{asset('vendors/chartist/chartist.min.js')}}"></script>--}}
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{asset('js/off-canvas.js')}}"></script>
<script src="{{asset('js/misc.js')}}"></script>
@if(auth()->user()->hasRole('user'))
    <script>
        $(document).ready(function () {
            $('#cart-preview').mouseenter(function () {
                $('#cart-dropdown-items').show();
            })

            $('#cart-preview, #cart-dropdown-items').mouseleave(function () {
                $('#cart-dropdown-items').hide()
            })
        })
    </script>
@endif

