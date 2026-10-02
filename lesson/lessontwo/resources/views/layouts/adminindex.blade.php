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

        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-10 col-md-9 pt-md-5 mt-ms-3 ms-auto">
                        <!-- start inner content area -->
                        <div class="row">

                            <!-- start breadcrumb -->
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Previous</a></li>
                                    <li class="breadcrumb-item active"><a href="javascript:void(0);">Current</a></li>
                                </ol>
                            </nav>
                            <!-- end breadcrumb -->

                            @yield('content')

                        </div>
                        <!-- end inner content area -->
                    </div>
                </div>
            </div>
        </section>

        

    </section>
    <!-- Page Wrapper -->


</div>
<!-- end reactjs or vue.js -->
@include('layouts.adminfooter')