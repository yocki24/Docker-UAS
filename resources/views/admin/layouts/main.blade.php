@include('admin.layouts.header')
@include('admin.layouts.sidebar')

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        @include('admin.layouts.navbar')

        @yield('content')

    </div>
    <!-- End of Main Content -->
    @include('admin.layouts.footer')
