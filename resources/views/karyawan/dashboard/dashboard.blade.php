@extends('base.app')

@section('content')
    <div class="header bg-gradient-teal pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body" style="padding-bottom: 100px; ">
                <div>
                    <header>
                        <h1 class="headerFont">Daftar Absensi {{$dataAbsensi[0]->name}}</h1>
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
                                    <th scope="col">Masuk</th>
                                    <th scope="col">Keluar</th>
                                    <th scope="col">Status</th>
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
                                            {{$absensi->in}}
                                        </td>
                                        <td>
                                            {{$absensi->out}}
                                        </td>
                                        <td>
                                            {{$absensi->status}}
                                        </td>
                                    </tr>

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
