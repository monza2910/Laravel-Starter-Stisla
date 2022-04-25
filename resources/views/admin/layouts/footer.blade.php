


<!-- General JS Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script src="{{asset('assets/admin/js/stisla.js')}}"></script>
{{-- <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script> --}}
<script src="{{asset('assets/admin/vendor/tinymce5/jquery.tinymce.min.js')}}"></script>
<script src="{{asset('assets/admin/vendor/tinymce5/tinymce.min.js')}}"></script>
<script src="{{asset('vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
@stack('scripts')
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#category-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    //viewimage
    $("#cat_image").change(function(){
        readURL(this);
    });



    //multipleselect
    $('select-box').selectpicker();

  </script>
  <!-- Plugin Libraies -->

  <!-- Template JS File -->
  <script src="{{asset('assets/admin/js/scripts.js')}}"></script>
  <script src="{{asset('assets/admin/js/custom.js')}}"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('assets/admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <script src="{{asset('assets/admin/js/demo/datatables-demo.js')}}"></script>
  <script src="{{asset('assets/admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('assets/admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  {{-- dropzone js --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>

  @stack('script-internal')
  <!-- Page Specific JS File -->
  @include('sweetalert::alert')
  {{-- @livewireScripts --}}
</body>
</html>

