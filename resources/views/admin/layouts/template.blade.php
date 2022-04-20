<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title>@yield('title')</title>

        <!-- General CSS Files -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <!-- CSS Libraries -->

        <!-- Template CSS -->
        <link rel="stylesheet" href="{{asset('assets/admin/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('assets/admin/css/components.css')}}">
        <link href="{{asset('assets/admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
        {{-- @livewireStyles --}}
      </head>
<body>
  <div id="app">

    <div class="main-wrapper">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
          <form class="form-inline mr-auto">
            <ul class="navbar-nav mr-3">
              <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            </ul>
          </form>
          <ul class="navbar-nav navbar-right">

            <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="#" class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block">Hi, </div></a>
              <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Logged in 5 min ago</div>
                <a href="" class="dropdown-item has-icon">
                  <i class="far fa-user"></i> Profile
                </a>
                {{-- <a href="features-activities.html" class="dropdown-item has-icon">
                  <i class="fas fa-bolt"></i> Activities
                </a>
                <a href="features-settings.html" class="dropdown-item has-icon">
                  <i class="fas fa-cog"></i> Settings
                </a> --}}
                <div class="dropdown-divider"></div>

                {{-- <form action="" method="POST">
                    <button type="submit" class="dropdown-item has-icon text-danger">Logout</button>
                </form> --}}
                <form action="" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item has-icon text-danger">Logout</button>
                </form>


              </div>
            </li>
          </ul>
        </nav>


        <div class="main-sidebar">
            <aside id="sidebar-wrapper">
              <div class="sidebar-brand">
                <a href="{{route('dashboard')}}">Monza</a>
              </div>
              <div class="sidebar-brand sidebar-brand-sm">
                <a href="{{route('dashboard')}}">MZ</a>
              </div>
              <ul class="sidebar-menu">
                  <li class="menu-header active">Dashboard</li>
                  <li class="nav-item {{ set_active('dashboard')}}">
                    <a href="{{route('dashboard')}}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                  </li>


                  {{-- @can('manage_users')
                  <li class="{{set_active(['user.index','user.trash'])}} dropdown">
                      <a href="" class="nav-link has-dropdown"><i class="fas fa-address-book"></i><span>User</span></a>
                      <ul class="dropdown-menu">
                          <li class="{{set_active('user.index')}}"><a class="nav-link" href="{{route('user.index')}}">User</a></li>
                          @role('SuperAdmin')
                          <li class="{{set_active('user.trash')}}"><a class="nav-link" href="{{route('user.trash')}}">Deleted User</a></li>
                          @endrole
                      </ul>
                  </li>
                  @endcan --}}

                <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                  <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                    <i class="fas fa-rocket"></i> Documentation
                  </a>
                </div>
            </aside>
          </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            @yield('title-page')
          </div>
          @yield('content')
          {{isset($slot) ? $slot : null}}
          <div class="section-body">
          </div>
        </section>
      </div>

      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2018 <div class="bullet"></div> Development By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
        </div>
        <div class="footer-right">
          2.3.0
        </div>
      </footer>
    </div>
    </div>




<!-- General JS Scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
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

    //tinyMCE5

    // $("#content").tinymce({
    // relative_urls: false,
    // height:"500",
    // language: "en",
    // plugins: [
    //     "advlist autolink lists link image charmap print preview hr anchor pagebreak",
    //     "searchreplace wordcount visualblocks visualchars code fullscreen",
    //     "insertdatetime media nonbreaking save table directionality",
    //     "emoticons template paste textpattern",
    // ],
    // toolbar1: " preview",
    // toolbar2:
    //     "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    //     file_picker_callback: function(callback, value, meta) {
    //     let x = window.innerWidth || document.documentElement.clientWidth || document
    //         .getElementsByTagName('body')[0].clientWidth;
    //     let y = window.innerHeight || document.documentElement.clientHeight || document
    //         .getElementsByTagName('body')[0].clientHeight;

    //     let cmsURL = "" + '?editor=' + meta.fieldname;
    //     if (meta.filetype == 'image') {
    //         cmsURL = cmsURL + "&type=Images";
    //     } else {
    //         cmsURL = cmsURL + "&type=Files";
    //     }

    //     tinyMCE.activeEditor.windowManager.openUrl({
    //         url: cmsURL,
    //         title: 'Filemanager',
    //         width: x * 0.8,
    //         height: y * 0.8,
    //         resizable: "yes",
    //         close_previous: "no",
    //         onMessage: (api, message) => {
    //             callback(message.content);
    //         }
    //     });
    //     }
    // });
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
  <!-- Page Specific JS File -->
  @include('sweetalert::alert')
  {{-- @livewireScripts --}}
</body>
</html>


