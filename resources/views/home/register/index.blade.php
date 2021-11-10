@extends('base.register')

@section('content')

    <div class="header pb-8 pt-5 pt-md-8">
        <div class="container">

            <div class="row justify-content-center mb-4">
                <h1 class="text-white">
                    REGISTER ABSENSI
                </h1>
            </div>

            <div class="row justify-content-center">
                @if (session('false'))
                    <div class="col-lg-7">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{--            lorem ipsum--}}
                            {{ session('false') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card shadow bg-translucent-dark border-info" style="border-width: 4px">
                        <div class="card-body">
                            <form method="post" action="{{route('user.registerAuth')}}" autocomplete="off"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('post')

                                <div>
                                    <label class="form-control-label text-white" for="input-nama">Nama</label>
                                    <input type="text" name="nama" id="input-nama"
                                           class="text-default form-control"
                                           placeholder="{{ __('Nama') }}" value="{{ old('nama') }}" required autofocus>
                                </div>

                                <div>
                                    <label class="form-control-label text-white" for="input-email">Email</label>
                                    <input type="text" name="email" id="input-email"
                                           class="text-default form-control"
                                           placeholder="{{ __('Email') }}" value="{{ old('email') }}" required
                                           autofocus>
                                </div>

                                <div>
                                    <label class="form-control-label text-white" for="input-pass">Password</label>
                                    <input type="password" name="password" id="input-pass"
                                           class="text-default form-control"
                                           placeholder="{{ __('Password') }}" value="{{ old('password') }}" required
                                           autofocus>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-outline-info mt-4">Daftar</button>
                                </div>

                            </form>
                            <div class="text-white text-center mt-3">
                                Sudah mempunyai akun?
                                <a href="{{route('user.login')}}">Masuk</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
