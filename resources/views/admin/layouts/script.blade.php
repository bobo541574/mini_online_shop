<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/jquery/jquery-3.2.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/select2/select2.min.js') }}"></script>

<script>

    const locale = "{{ session('locale') }}";

</script>

@yield('script')
