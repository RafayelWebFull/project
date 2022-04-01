@extends('layouts.app')

@section('main')
    <div class="container">
        <div class="row">
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add new User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/user" method="POST">
                            @csrf
                            <div class="container">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input required type="text" class="form-control" name="name" id="name">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">E-Mail</label>
                                    <input required name="email" type="email" class="form-control" id="email">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Role</label>
                                    <select class="form-select" required name="roleId"
                                            aria-label="Default select example">
                                        <option selected disabled value="">Select Role</option>
                                        <option value="1">Admin</option>
                                        <option value="3">Broker</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input required type="password" class="form-control" name="password" id="password">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-5 mb-2">
                <h2>Users</h2>
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add new user
                    </button>
                </div>
            </div>
            <div class="border">
                <table class="table">
                    <thead class="text-center">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>action</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    @foreach($data as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{ $user->role_id == 1 ? 'Admin' : 'Broker' }}</td>
                            <td class="d-flex justify-content-around">
                                <div>
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                                </div>
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

