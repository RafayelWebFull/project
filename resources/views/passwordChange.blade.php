@extends('layouts.app')

@section('main')
    <div class="container px-4 mt-4">
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Password Change</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="/profile/changePassword" method="POST">
                    @csrf
                    <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1 form-label" for="password">New password</label>
                            <input class="form-control" required id="password" name="password" type="password" placeholder="Enter new password">
                        </div>
                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="rePassword">Repeat new password</label>
                            <input class="form-control" id="rePassword" name="rePassword" required type="password" placeholder="Repeat new password">
                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="submit">Save changes</button>
                    </form>
                </div>
            </div>
@endsection
