    @extends('layouts.app')

@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add new Report</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/report" method="POST">
                            @csrf
                            <div class="container">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Load Number</label>
                                    <input required type="number" class="form-control" name="loadNumber" id="exampleInputEmail1"
                                           aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Broker Rate</label>
                                    <input required name="brokerRate" type="number" class="form-control" id="exampleInputEmail1"
                                           aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Percent</label>
                                    <select class="form-select" required name="percent" aria-label="Default select example">
                                        <option selected disabled value="">Select Percent</option>
                                        <option value="3.5">3.5 %</option>
                                        <option value="3">3%</option>
                                        <option value="2.5">2.5 %</option>
                                        <option value="2">2 %</option>
                                        <option value="0">0 %</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Driven Rate</label>
                                    <input required type="number" class="form-control" name="drivenRate" id="exampleInputEmail1">
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-5">
                <h2>Reports</h2>
                <div class="justify-content-between d-flex">
                <form action="/reports/search" id="selectName" method="POST">
                @csrf
                <select onchange="search(event)" class="form-select me-3 w-75" id="usersName" required name="username">
                    <option @if(!isset($key)) selected  @endif value="" >All</option>
                    @foreach($usersName as $userName)
                        <option @if(isset($key) && $key ==  $userName->name) selected @endif value="{{$userName->name}}">{{$userName->name}}</option>
                    @endforeach
                </select>
                </form>
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add new report
                    </button>
                </div>
                </div>
            </div>
            <div class="border">
                <table class="table">
                    <thead class="text-center">
                    <tr>
                        <th>Created at</th>
                        <th>Load Number</th>
                        <th>Broker rate</th>
                        <th>User name</th>
                        <th>Percent</th>
                        <th>Driven rate</th>
                        <th>Rate balance</th>
                        <th>Rate minus percent</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    @foreach($reports as $report)
                        <tr>
                            <td>{{$report->created_at}}</td>
                            <td>{{$report->load}}</td>
                            <td>{{$report->broker_rate}}</td>
                            <td>{{$report->user->name}}</td>
                            <td>{{$report->percent}}</td>
                            <td>{{$report->driven_rate}}</td>
                            <td>{{$report->rate_balance}}</td>
                            <td>{{$report->rate_minus_percent}}</td>
                            <td class="d-flex justify-content-around">
                                <div>
                                <a href="{{ route('report.edit', $report->id) }}" class="btn btn-warning">Edit</a>
                                </div>
                                <form action="{{ route('report.destroy', $report->id) }}" method="POST">
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
        {{$reports->links()}}
    </div>
@endsection
    @section('script')
        <script>
            function search(event) {
                if(event.target.value == "") {
                    location.href = '/reports'
                } else {
                    document.getElementById('selectName').submit();
                }
            }
        </script>
    @endsection
