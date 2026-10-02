@include('layouts.adminheader')
<!-- start reactjs or vue.js -->
<div id="app">

    <!-- Start Site Setting  -->
    <div id="sitesettings" class="sitesettings">
        <div class="sitesettings-item"><a href="javascript:void(0);" id="sitetoggle" class="sitetoggle"><i class="fas fa-cog ani-rotates"></i></a></div>
    </div>
    <!-- End Site Setting  -->

    <!-- Start Left Sidebar -->
    @include('layouts.adminleftsidebar')
    <!-- End Left Sidebar -->

    <!-- Page Wrapper -->
    <section>

        <!-- start breadcrumb -->
        <!-- end breadcrumb -->

        @yield('content')

    </section>
    <!-- Page Wrapper -->


</div>
<!-- end reactjs or vue.js -->
@include('layouts.adminfooter')