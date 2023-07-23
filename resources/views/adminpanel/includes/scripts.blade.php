<!-- ===============================================-->
<!--    JavaScripts from dashboard-->
<!-- ===============================================-->

<script src="{{ asset('adminassets/assets/jquery/dist/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('adminassets/assets/jquery-validation/dist/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('adminassets/assets/toastr/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('adminassets/assets/datatables.net/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('adminassets/assets/datatables.net/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('adminassets/assets/datatables.net/js/dataTables.buttons.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('adminassets/assets/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('adminassets/vendors/popper/popper.min.js') }}"></script>
<script src="{{ asset('adminassets/vendors/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('adminassets/vendors/anchorjs/anchor.min.js') }}"></script>
<script src="{{ asset('adminassets/vendors/is/is.min.js') }}"></script>
<script src="{{ asset('adminassets/vendors/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('adminassets/vendors/fontawesome/all.min.js') }}"></script>
<script src="{{ asset('adminassets/vendors/lodash/lodash.min.js') }}"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
<script src="{{ asset('adminassets/vendors/list.js/list.min.js') }}"></script>
<script src="{{ asset('adminassets/assets/js/theme.js') }}"></script>
<script src="{{ asset('adminassets/wwwroot/assets/nepali.datepicker.v3.7/js/nepali.datepicker.v3.7.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('adminassets/assets/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('adminassets/assets/jquery-mask/dist/jquery.mask.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('adminassets/scripts/language.js') }}"></script>
<script src="{{ asset('adminassets/scripts/common.js') }}"></script>
<script src="{{ asset('adminassets/assets/js/flatpickr.js') }}"></script>


<script type="text/javascript">
    InitializeUnicodeNepali();
</script>

<script src="{{ asset('summernote/summernote-lite.min.js') }}"></script>

<script>
        $('#summernote').summernote({
        placeholder: 'Your Content Here..',
        tabsize: 2,
        height: 100,
      });
      
</script>

<script>
    $(function(){
        var current = location.pathname;
        $('.navbar .nav-item .nav-link ').each(function(){
            var $this = $(this);
            // if the current path is like this link, make it active
            if($this.attr('href').indexOf(current) !== -1){
                $this.closest("nav-link.dropdown-indicator.collapsed").removeClass('collapsed');
                $this.closest(".nav.false.collapse").addClass('show');
                $this.addClass('active');
            }
        })
    })
</script>

<!-- Add jQuery library -->
<script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>

<script src="{{ asset('dist/venobox.min.js') }}"></script>


<script>
    new VenoBox({
        selector: '.venobox',
        numeration: true,
        infinigall: true,
        share: true,
        spinner: 'rotating-plane'
    });

</script>
