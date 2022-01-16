<script type="text/javascript" src="{{ asset('assets/jquery/jquery-3.2.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/select2/select2.min.js') }}"></script>

<script>
    window.setTimeout(function () {
        $(".alert").fadeTo(10000, 0).slideUp(10000, function () {
            $(this).remove();
        });
    }, 5000);
    /* csrf torken */
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    /* localization */
    let locale = '{{ session('locale') }}';

    /* production mode */
    function isProduction() {
        let is_production = '{{ config('app.env') === 'production' }}';
        return (is_production == "") ? false : true;
    }

    const lang = {
        'mm': [
            "၀",
            "၁",
            "၂",
            "၃",
            "၄",
            "၅",
            "၆",
            "၇",
            "၈",
            "၉",
            "၁၀",
        ],
        'en': [
            "0",
            "1",
            "2",
            "3",
            "4",
            "5",
            "6",
            "7",
            "8",
            "9",
            "10",
        ],
    };

    function trans(data) {
        return lang[locale][data];
    }

</script>

@yield('script')
