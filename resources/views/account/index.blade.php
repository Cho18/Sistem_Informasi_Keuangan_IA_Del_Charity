@extends('dashboard.app')

@section('title', 'Account')

@section('contents')

    @if (session()->has('success'))
    <div class="alert alert-primary alert-dismissible fade show col-md-6" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session()->has('update'))
        <div class="alert alert-success alert-dismissible fade show col-md-6" role="alert">
            {{ session('update') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show col-md-6" role="alert">
            {{ session('delete') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show col-md-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="modal-content">
    <!-- heading modal -->
        <div class="modal-header justify-content-center">
            <h4 style="color: #1b8112;"><strong> Detail Account </strong></h4>
        </div>
        <div class="container bootstrap snippets bootdey mt-5">
            <div class="panel-body inf-content">
                <div class="row">
                    <div class="col-md-3 d-flex justify-content-center align-items-center mt-2 mb-2">
                        <img class="img-circle rounded-circle" src="{{ asset('storage/' . Auth::user()->profile) }}" style="height: 150px; width: 150px;">
                    </div>
                    <div class="col-md-8 mt-3 d-flex align-items-center">
                        <table class="table table-user-information text-gray-900 table-center">
                            <tbody>
                                <tr>
                                    <td width="80"> Username </td>
                                    <td width="2"> : </td>
                                    <td> {{ Auth::user()->name }} </td>
                                </tr>
                                <tr>
                                    <td> Email </td>
                                    <td> : </td>
                                    <td> {{ Auth::user()->email }} </td>
                                </tr>
                                <tr>
                                    <td> Role </td>
                                    <td> : </td>
                                    <td> {{ Auth::user()->role->role_name }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- footer modal -->
            <div class="modal-footer">
                @if (Session::has('otp'))
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#otpModal">
                        Verify Account
                    </button>
                @else
                    <a href="/account/{{ $id }}/edit" type="button" class="btn btn-warning"> Edit Akun </a>
                @endif
            </div>
        </div>
    </div>
@endsection
