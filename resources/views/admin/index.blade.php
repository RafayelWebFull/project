@extends('admin.layouts.app')

@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Amount</th>
                        <th>Amount With %</th>
                        <th>Amount the spended</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>100$</td>
                        <td>80$</td>
                        <td>60$</td>
                        <td>10$</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
