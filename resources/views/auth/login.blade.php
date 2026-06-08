@extends('layouts.index')

@section('title', 'Login SIPENA')

@section('content')

<div class="page page-center">

    <div class="container container-tight py-4">

        <div class="text-center mb-4">

            <h1 class="text-primary">

                SIPENA

            </h1>

            <div class="text-secondary">

                Sistem Informasi Pegawai

            </div>

        </div>


        <div class="card card-md">

            <div class="card-body">

                <h2 class="h2 text-center mb-4">

                    Login

                </h2>


                {{-- ERROR --}}
                @if(session('error'))

                    <div class="alert alert-danger">

                        {{ session('error') }}

                    </div>

                @endif


                <form action="/proses-login"
                      method="POST">

                    @csrf

                    {{-- USERNAME --}}
                    <div class="mb-3">

                        <label class="form-label">

                            Username

                        </label>

                        <input type="text"
                               name="username"
                               class="form-control"
                               placeholder="Masukkan username">

                    </div>


                    {{-- PASSWORD --}}
                    <div class="mb-3">

                        <label class="form-label">

                            Password

                        </label>

                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="Masukkan password">

                    </div>


                    {{-- BUTTON --}}
                    <div class="form-footer">

                        <button class="btn btn-primary w-100">

                            Login

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection