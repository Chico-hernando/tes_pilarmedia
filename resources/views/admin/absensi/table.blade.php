@extends('base.app')

@section('content')
<div class="header bg-gradient-teal pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body" style="padding-bottom: 100px; ">
            <div>
                <header>
                    <h1 class="headerFont">Daftar Absensi Pegawai</h1>
                    <br><br><br>
                </header>
                <div class="card shadow">
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

                    <div class="table-responsive">
                        <table id="main-table" class="table align-items-center card-table">
                            <thead class="table-light">
                            <tr class="align-content-center">
                                <th scope="col">No</th>
                                <th scope="col">Nama pegawai</th>
                                <th scope="col">Masuk</th>
                                <th scope="col">Keluar</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i = 0; $i < count($dataAbsensi); $i++)
                                @php
                                    $absensi = $dataAbsensi[$i];

                                @endphp

                                <tr>
                                    <th>
                                        {{$i+1}}
                                    </th>
                                    <td>
                                        {{$absensi->name}}
                                    </td>
                                    <td>
                                        {{$absensi->in}}
                                    </td>
                                    <td>
                                        {{$absensi->out}}
                                    </td>
                                    <td>
                                        {{$absensi->status}}
                                    </td>
                                    <td>
                                        @if($absensi->status_id == 4)
                                            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#absensiModal{{$absensi->id}}" href="">Approve cuti</a>
                                            <a class="btn-sm btn-danger btn" data-toggle="modal" data-target="#tolakModal{{$absensi->id}}" href="">Tolak cuti</a>
                                        @endif


                                    </td>
                                </tr>

                                <div class="modal fade" id="absensiModal{{$absensi->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                                    <div class="modal-dialog modal-primary modal-dialog-centered modal-" role="document">
                                        <div class="modal-content bg-primary">

                                            <form id="approveForm" action="{{ route('dashboard.admin.absensi.approve') }}" method="POST" class="remove-record-model">
                                                {{ method_field('post') }}
                                                {{ csrf_field() }}

                                                <div class="modal-body">

                                                    <div class="py-3 text-center">
                                                        <h4 class="heading mt-4">Apa kau yakin ingin meng-approve cuti ini?</h4>
                                                        <input type="hidden" name="id" value="{{$absensi->id}}">
                                                    </div>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn text-primary bg-white">Ya
                                                    </button>
                                                    <button type="button" class="btn text-primary bg-white ml-auto" data-dismiss="modal">Batal
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="tolakModal{{$absensi->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                                    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                        <div class="modal-content bg-danger">

                                            <form id="approveForm" action="{{ route('dashboard.admin.absensi.tolak') }}" method="POST" class="remove-record-model">
                                                {{ method_field('post') }}
                                                {{ csrf_field() }}

                                                <div class="modal-body">

                                                    <div class="py-3 text-center">
                                                        <h4 class="heading mt-4">Apa kau yakin ingin menolak cuti ini?</h4>
                                                        <input type="hidden" name="id" value="{{$absensi->id}}">
                                                    </div>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn text-danger bg-white">Ya
                                                    </button>
                                                    <button type="button" class="btn text-danger bg-white ml-auto" data-dismiss="modal">Batal
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

{{--                                <div class="modal fade" id="deleteModal{{$absensi->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">--}}
{{--                                    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">--}}
{{--                                        <div class="modal-content bg-danger">--}}

{{--                                            <form id="deleteForm" action="" method="POST" class="remove-record-model">--}}
{{--                                                {{ method_field('post') }}--}}
{{--                                                {{ csrf_field() }}--}}

{{--                                                <div class="modal-body">--}}

{{--                                                    <div class="py-3 text-center">--}}
{{--                                                        <h4 class="heading mt-4">Apa kau yakin ingin menghapus petugas ini?</h4>--}}
{{--                                                        <input type="hidden" name="id" value="{{$absensi->id}}">--}}
{{--                                                    </div>--}}

{{--                                                </div>--}}

{{--                                                <div class="modal-footer">--}}
{{--                                                    <button type="submit" class="btn text-white">Ya--}}
{{--                                                    </button>--}}
{{--                                                    <button type="button" class="btn text-white ml-auto" data-dismiss="modal">Tidak--}}
{{--                                                    </button>--}}
{{--                                                </div>--}}
{{--                                            </form>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                            @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var sel1 = document.querySelector('#sel1');
    var sel2 = document.querySelector('#sel2');
    var options2 = sel2.querySelectorAll('option');

    function giveSelection(selValue) {
        sel2.innerHTML = '';
        for (var i = 0; i < options2.length; i++) {
            if (options2[i].dataset.option === selValue) {
                sel2.appendChild(options2[i]);
            }
        }
    }

    giveSelection(sel1.value);

    //check status of all element
    let ready = (callback) => {
        if (document.readyState != "loading") callback();
        else document.addEventListener("DOMContentLoaded", callback);
    }

    ready(() => {
        $("#main-table").DataTable({
            searching: false,
            ordering: false,
            stateSave: true,
            info: false,
            //lengthChange: false,
            lengthMenu: [
                [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]
            ],
            scrollX: true,
            language: {
                paginate: {
                    previous: "<",
                    next: ">"
                },
                emptyTable: "Tidak ada data yang ditampilkan",
                lengthMenu: "Tampilkan _MENU_ Item"
            }
        });
    });
</script>
@endsection
