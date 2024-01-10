<!-- jQuery 3 -->



<script src="{{ asset('/assets/libs/js/jquery.min.js') }}"></script>
<script src="{{ asset('./assets/libs/js/chosen.jquery.min.js') }}"></script>
<script src="{{ asset('./assets/libs/js/init.js') }}"></script>
<script src="{{ asset('/assets/libs/js/bootstrap.min.js') }}"></script>


<script src="{{ asset('/assets/libs/js/pace.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('/assets/libs/js/toastr.min.js') }}"></script>
<!-- Validation -->
<script src="{{ asset('/assets/libs/js/jquery.validate.js') }}"></script>
<script src="{{ asset('/assets/libs/js/jquery.validate.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('/assets/libs/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/assets/libs/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/assets/libs/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('/assets/libs/js/font.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('/assets/libs/js/select2.full.min.js') }}"></script>
<script src="{{ asset('/assets/libs/js/adminlte.min.js') }}"></script> 
<script src="{{asset('js/function.js')}}"></script>

<script src="{{ asset('libs/js/sweetalert2@11.js') }}"></script>


<script>
    
var alertSou = new Audio('../assets/alert.mp3');
var worningSou = new Audio('../assets/worning.mp3');

function alertSound(){
    alertSou.play();
}
function worningSound(){
    worningSou.play();
}

var _token =  $('meta[name="csrf-token"]').attr('content')

var config = {
  '.chosen-select'           : {},
  '.chosen-select-deselect'  : { allow_single_deselect: true },
  '.chosen-select-no-single' : { disable_search_threshold: 10 },
  '.chosen-select-no-results': { no_results_text: 'Oops, nothing found!' },
  '.chosen-select-rtl'       : { rtl: true },
  '.chosen-select-width'     : { width: '95%' }
}
for (var selector in config) {
  $(selector).chosen(config[selector]);
}






</script>


