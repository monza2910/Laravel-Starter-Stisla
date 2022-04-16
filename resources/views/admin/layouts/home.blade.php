
    
      @include('admin.layouts.head')
      @include('admin.layouts.navbar')
      
      @include('admin.layouts.sidebar')

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

      @include('admin.layouts.footer')