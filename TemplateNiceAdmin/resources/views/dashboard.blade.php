@extends('layouts.layout')

@section('content')

<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
            <div class="row">

                <!-- Sales Card -->
                @yield('sales-card')
                <!-- End Sales Card -->

                <!-- Revenue Card -->
                @yield('revenue-card')
                <!-- End Revenue Card -->

                <!-- Customers Card -->
                @yield('customer-card')
                <!-- End Customers Card -->

                <!-- Reports -->
                @yield('report-card')
                <!-- End Reports -->

                <!-- Recent Sales -->
                @yield('recent-sales')
                <!-- End Recent Sales -->

                <!-- Top Selling -->
                @yield('top-selling')
                <!-- End Top Selling -->

            </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

            <!-- Recent Activity -->
            @yield('recent-activity')
            <!-- End Recent Activity -->

            <!-- Budget Report -->
            @yield('budge-report')
            <!-- End Budget Report -->

            <!-- Website Traffic -->
            @yield('website-traffic')
            <!-- End Website Traffic -->

            <!-- News & Updates Traffic -->
            @yield('update-traffic')
            <!-- End News & Updates -->

        </div><!-- End Right side columns -->

    </div>
</section>
@endsection