<script type="text/javascript" src="{{ asset('assets/jquery/jquery-3.2.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('assets/select2/select2.min.js') }}"></script>

<script>
    /* csrf torken */
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    /* localization */
    let locale = "{{ session('locale') }}";

    /* app url */
    let app_url = "{{ config('app.url') }}/";

    /* app url */
    let storage_url = "{{ config('app.url') }}/storage";

</script>

@yield('script')
