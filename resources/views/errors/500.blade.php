@include('master.head')
@include('master.topnav')
<!-- Side Navbar -->
{{-- @if (Auth::check()) --}}
@include('master.sidenav')
{{-- @endif --}}

<div class="content-inner">

    <section class="dashboard-counts no-padding-bottom">
        <div class="container-fluid">
            <div class="row bg-white has-shadow">

                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <h1>OOPS, Page not found!</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('master.footer')
    @section('javascript')

    @endsection
