<style type="text/css">
    .alert {
        z-index: 99990;
        top: 100px;
        right: 18px;
        min-width: 30%;
        position: fixed;
        animation: slide 0.5s forwards;
        border-radius: 5px;
        background-color: #FFF;
        -webkit-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.75);
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.75);
    }

    .alert button {
        color: #232C3D;
    }

    .alert-success {
        color: #ffffff;
        background-color: rgba(38, 185, 154, 0.77);
        border-color: rgba(38, 185, 154, 0.77);
    }

    .alert-info {
        color: #E9EDEF;
        background-color: rgba(52, 152, 219, 0.77);
        border-color: rgba(52, 152, 219, 0.77);
    }

    .alert-warning {
        color: #232C3D;
        background-color: rgba(243, 156, 18, 0.77);
        border-color: rgba(243, 156, 18, 0.77);
    }
    /* .alert-warning {
        color: #E9EDEF;
        background-color: rgba(243, 156, 18, 0.77);
        border-color: rgba(243, 156, 18, 0.77);
    } */

    .alert-danger,
    .alert-error {
        color: #E9EDEF;
        background-color: rgba(231, 76, 60, 0.77);
        border-color: rgba(231, 76, 60, 0.77);
    }

</style>
@if ($message = Session::get('success'))
<div class="alert alert-info alert-block text-center text-dark">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <div class="py-2 px-4">
        <strong>Success&nbsp;<i class="far fa-check-circle"></i>
            <hr></strong>
        <strong>{{ $message }}</strong>
    </div>
</div>
@endif


@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block text-center text-dark">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <div class="py-2 px-4">
        <strong>Errors&nbsp;<i class="fas fa-exclamation-circle"></i>
            <hr></strong>
        <strong>{{ $message }}</strong>
    </div>
</div>
@endif


@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block text-center text-dark">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <div class="py-2 px-4">
        <strong>Warning&nbsp;<i class="fas fa-exclamation-triangle"></i>
            <hr></strong>
        <strong>{{ $message }}</strong>
    </div>
</div>
@endif


@if ($message = Session::get('info'))
<div class="alert alert-info alert-block text-center text-dark">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <div class="py-2 px-4">
        <strong>Info&nbsp;<i class="far fa-check-circle"></i>
            <hr></strong>
        <strong>{{ $message }}</strong>
    </div>
</div>
@endif


@if ($errors->any())
{{-- <div class="alert alert-danger text-center text-dark">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Whoops!
        <hr></strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div> --}}
    <div class="alert alert-warning alert-dismissible" role="alert">
    <ul class="pt-3">
        {{-- <li class="d-flex align-middle"> --}}
            {{-- <strong>Holy guacamole!</strong>  --}}
            <button type="button" class="btn-sm btn-close px-2 py-1" style="font-size: 70%" data-bs-dismiss="alert" aria-label="Close"></button>
        {{-- </li> --}}
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
  </div>
@endif

<!-- <script>
window.setTimeout(function() {
    $(".alert").fadeTo(10000, 0).slideUp(10000, function(){
        $(this).remove(); 
    });
}, 10000);
</script> -->