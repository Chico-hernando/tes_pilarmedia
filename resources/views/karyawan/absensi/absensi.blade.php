@extends('base.app')

@section('content')
    <div class="header bg-gradient-teal pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body" style="padding-bottom: 100px; ">
                <div>
                    <header>
                        <h1 class="headerFont">Absen</h1>
                        <br><h1 class="headerFont" id="jam"></h1><br><br>
                    </header>
                </div>
            </div>
            @if (session('true'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('true') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif (session('false'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('false') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="pb-2">
                <a type="button" class="btn-primary btn btn-lg text-white" href="{{route('dashboard.absensi.masuk')}}">Absen Masuk</a>
                <a type="button" class="btn-primary btn btn-lg text-white" href="{{route('dashboard.absensi.keluar')}}">Absen Keluar</a>
            </div>
            <br>
            <div class="py-2 card shadow bg-primary">
                <h2 class="text-white px-3">Izin</h2>
                <form id="buatIzin" action="{{route('dashboard.absensi.izin')}}" method="POST" autocomplete="off">
                    {{ method_field('post') }}
                    {{ csrf_field() }}

                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="form-control-label text-white"
                                       for="input-nama">{{ __('Tanggal izin cuti/sakit') }}</label>
                                <input type="date" class="form-control text-default" name="tgl">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadioInline1" name="izin" class="custom-control-input" value="cuti">
                                <label class="custom-control-label text-white" for="customRadioInline1">Cuti</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadioInline2" name="izin" class="custom-control-input" value="sakit">
                                <label class="custom-control-label text-white" for="customRadioInline2">Sakit</label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn  text-primary bg-white">Buat izin
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function startTime() {
            const today = new Date();
            let h = today.getHours();
            let m = today.getMinutes();
            let s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('jam').innerHTML =  h + ":" + m + ":" + s;
            setTimeout(startTime, 1000);
        }

        function checkTime(i) {
            if (i < 10) {i = "0" + i}  // add zero in front of numbers < 10
            return i;
        }
    </script>
@endsection
