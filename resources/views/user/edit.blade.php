@extends('layouts.app')

@section('main')
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    </div>
                    <form action="/user/{{$data['id']}}" method="POST">
                        @method("PUT")
                        @csrf
                        <div class="container">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input required type="text" class="form-control" name="name" value="{{$data['name']}}" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">E-Mail</label>
                                <input required name="email" type="email" class="form-control" value="{{$data['email']}}" id="email">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Role</label>
                                <select class="form-select" required name="roleId" aria-label="Default select example">
                                    <option selected disabled value="">Select Role</option>
                                    <option @if($data->role_id === 1 ) selected @endif value="1">Admin</option>
                                    <option @if($data->role_id === 3 ) selected @endif value="3">Broker</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="/users" class="btn btn-secondary">Close</a>
                            <button type="submit" class="btn btn-primary">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
