<footer class="main-footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <p>ERTE &copy; 2018</p>
            </div>
            <div class="col-sm-6 text-right">
                <p>Design by <span class="external">Yetimesht T</span></p>

            </div>
        </div>
    </div>
</footer>
</div>
</div>
</div>

</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{asset('js/jquery.min.js') }}"> </script>

<script src="{{ asset('js/select2.min.js') }}"> </script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"> </script>
<script src="{{ asset('js/dataTables.buttons.min.js') }}"> </script>
<script src="{{ asset('js/buttons.flash.min.js') }}"> </script>
<script src="{{ asset('js/jszip.min.js')}}"> </script>

<script src="{{ asset('js/buttons.html5.min.js') }}"> </script>
<script src="{{ asset('js/buttons.print.min.js') }}"> </script>
<script src="{{ asset('js/toastr.min.js') }}"> </script>

<script src="{{ asset('js/jquery.cookie.js') }}"> </script>
<script src="{{ asset('js/jquery.datetimepicker.full.js') }}"> </script>
<script src="{{ asset('js/moment.js') }}"> </script>
{{-- <!-- <script src="{{ asset('js/sweetalert2@8.js') }}"> </script> --> --}}
{{-- <!-- <script src="{{ asset('js/jquery.validate.js') }}" > </script> --}}
<script src="{{ asset('js/jquery.validate.min.js') }}"> </script> -->
<script src="{{ asset('js/custome_validation.js') }}"> </script>
<script src="{{ asset('js/Chart.min.js') }}"> </script>

<script>
    @if (Session::has('success'))
      toastr.success('{{ Session::get('success')}}');
      @endif
      @if (Session::has('info'))
      toastr.info('{{ Session::get('info')}}');
      @endif
      @if (Session::has('error'))
      toastr.error('{{ Session::get('error')}}');
      @endif
      @include('sweetalert::alert');
</script>
@yield('javascript')
</body>

</html>
