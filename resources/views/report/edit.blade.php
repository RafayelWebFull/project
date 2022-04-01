@extends('layouts.app')

@section('main')
    <div class="container">
        <div class="row justify-content-center">
                <div>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Report</h5>
                        </div>
                        <form action="{{ route('report.update', $data->id) }}" method="POST">
                            @method("PUT")
                            @csrf
                            <div class="container">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Load Number</label>
                                    <input required type="number" class="form-control" value="{{$data->load}}" name="loadNumber" id="exampleInputEmail1"
                                           aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Broker Rate</label>
                                    <input required name="brokerRate" type="number" value="{{$data->broker_rate}}" class="form-control" id="exampleInputEmail1"
                                           aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Percent</label>
                                    <select class="form-select" required name="percent" aria-label="Default select example">
                                        <option disabled value="">Select Percent</option>
                                        <option @if($data->percent === 3.5 ) selected @endif value="3.5">3.5 %</option>
                                        <option @if($data->percent === 3 ) selected @endif value="3">3%</option>
                                        <option @if($data->percent === 2.5 ) selected @endif value="2.5">2.5 %</option>
                                        <option @if($data->percent === 2 ) selected @endif value="2">2 %</option>
                                        <option @if($data->percent === 0.0 ) selected @endif value="0">0 %</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Driven Rate</label>
                                    <input required type="number" class="form-control" value="{{$data->driven_rate}}" name="drivenRate" id="exampleInputEmail1">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
