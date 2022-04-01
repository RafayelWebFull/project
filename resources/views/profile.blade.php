@extends('layouts.app')

@section('main')
    <div class="container px-4 mt-4">
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                    <form action="profile/update" method="POST">
                        @csrf
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1 form-label" for="name">FullName</label>
                            <input class="form-control" required id="name" name="name" type="text" placeholder="Enter your username" value="{{Auth::user()->name}}">
                        </div>
                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email address</label>
                            <input class="form-control" id="inputEmailAddress" name="email" required type="email" placeholder="Enter your email address" value="{{Auth::user()->email}}">
                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="submit">Save changes</button>
                    </form>
                </div>
            </div>
@endsection
