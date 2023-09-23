@extends('dashboard.app')

@section('title', 'Account')

@section('contents')   
    <!-- konten modal-->
    <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header justify-content-center">
            <h4 style="color: #1b8112;"><strong> Detail Account </strong></h4>
        </div>
        <!-- body modal --> 
        <div class="modal-body">
            <table class="table table-borderless text-gray-900">
                <tr>
                    <td width="120"> Username </td>
                    <td width="20"> : </td>
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
            </table>
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

    <!-- OTP Verification Modal -->
    <div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="otpModalLabel">OTP Verification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('account.verify-otp') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="otp" class="form-label">Enter OTP:</label>
                            <input type="text" class="form-control" id="otp" name="otp" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Verify</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
