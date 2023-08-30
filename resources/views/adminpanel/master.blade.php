
<!DOCTYPE html>
<html lang="en">
  @include('adminpanel.includes.head')
  <body>
    <div class="container-scroller container">

      <!-- ADMIN DASHBOARD SIDEPANEL -->
      @include('adminpanel.includes.sidebar')


      <!-- HEADER NAV-BAR -->
      @include('adminpanel.includes.navbar')

      <!--BODY CONTENTS BELOW HERE-->
        <div class="main-panel">
            <div class="content-wrapper">
            <!--
                BODY STUFF GOES HERE
            -->

            @yield('content')

            </div>


        <!-- FOOTER STUFF HERE -->
        @include('adminpanel.includes.footer')
      </div>
      <!-- page-body-wrapper ends -->
    </div>

    <!-- SCRIPTS BELOW HERE -->

    @include('adminpanel.includes.scripts')
  </body>
</html>
