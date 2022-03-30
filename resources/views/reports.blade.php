@extends('layouts.app')

@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>load</th>
                        <th>broker rate</th>
                        <th>percent</th>
                        <th>driven rate</th>
                        <th>rate balance</th>
                        <th>rate minus percent</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reports as $report)
                        <tr>
                            <th>{{$report->load}}</th>
                            <th>{{$report->broker_rate}}</th>
                            <th>{{$report->percent}}</th>
                            <th>{{$report->driven_rate}}</th>
                            <th>{{$report->rate_balance}}</th>
                            <th>{{$report->rate_minus_percent}}</th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                <h1>{{$count_rent}}</h1>
            </div>
        </div>
    </div>
@endsection
