@extends('base.login')

@section('content')
    <div class="header pb-8 pt-5 pt-md-8">
        <div class="container">



            <div class="row justify-content-center mb-4">
                <h1 class="text-white">
                    LOGIN ABSENSI
                </h1>
            </div>

            <div class="row justify-content-center">
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
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card shadow bg-translucent-dark border-info" style="border-width: 4px">
                        <div class="card-body">
                            <form method="post" action="{{route('user.loginAuth')}}" autocomplete="off"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label text-white" for="input-email">Email</label>
                                    <input type="text" name="email" id="input-email"
                                           class="text-default form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Email') }}" value="{{ old('email') }}" required
                                           autofocus>

                                    {{--                                    @if ($errors->has('nama'))--}}
                                    {{--                                        <span class="invalid-feedback" role="alert">--}}
                                    {{--                                            <strong>{{ $errors->first('nama') }}</strong>--}}
                                    {{--                                        </span>--}}
                                    {{--                                    @endif--}}
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label text-white" for="input-pass">Password</label>
                                    <input type="password" name="password" id="input-pass"
                                           class="text-default form-control"
                                           placeholder="{{ __('Password') }}" value="{{ old('password') }}" required
                                           autofocus>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-outline-info mt-4">Masuk</button>
                                </div>

                            </form>

                            <div class="text-white text-center mt-3">
                                Belum memiliki akun?
                                <a href="{{route('user.register')}}">Daftar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
