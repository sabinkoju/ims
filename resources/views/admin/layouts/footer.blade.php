
<div class="page-footer">
    <div class="page-footer-inner"> <?php echo date('Y'); ?> &copy; Institute Management System (IMS) By
        <a href="javascript:" target="_blank" class="makerCss">Green Computing Nepal</a>
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- end footer -->
</div>
<!-- start js include path -->
<script src="{{ asset('adminAssets/assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminAssets/assets/plugins/popper/popper.js') }}"></script>
<script src="{{ asset('adminAssets/assets/plugins/jquery-blockui/jquery.blockui.min.js') }}"></script>
<script src="{{ asset('adminAssets/assets/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
<!-- bootstrap -->
<script src="{{ asset('adminAssets/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('adminAssets/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('adminAssets/assets/plugins/sparkline/jquery.sparkline.js') }}"></script>
<script src="http://radixtouch.in/templates/admin/smart/source/assets/js/pages/sparkline/sparkline-data.js"></script>
<!-- Common js-->
<script src="{{ asset('adminAssets/assets/js/app.js') }}"></script>
<script src="{{ asset('adminAssets/assets/js/layout.js') }}"></script>
<script src="{{ asset('adminAssets/assets/js/theme-color.js') }}"></script>
<!-- material -->
<script src="{{ asset('adminAssets/assets/plugins/material/material.min.js') }}"></script>
<!-- chart js -->
<script src="http://radixtouch.in/templates/admin/smart/source/assets/plugins/chart-js/Chart.bundle.js"></script>
<script src="{{ asset('adminAssets/assets/plugins/chart-js/utils.js') }}"></script>
<!-- summernote -->

<!-- end js include path -->

<script>
    $(".deleteRecord").click(function () {
        var id = $(this).attr('rel');
        var deleteFunction = $(this).attr('rel1');
        swal({
                title: "Are You Sure? ",
                text: "You will not be able to recover this record again",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, Delete it!"
            },
            function () {

                window.location.href = "http://127.0.0.1:8000/" + deleteFunction + "/" + id;
            });
    });

</script>

@yield('scripts')

</body>

</html>
