@extends('backend.main')
@section('content')
    <link href="/css/profile.css" rel="stylesheet">


    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    <div class="container">
        <div class="main-body">
            <!-- /Breadcrumb -->
            <a href="{{route('employees.list')}}" class="btn btn-success mt-2">Back</a>
            <div class="row gutters-sm mt-3">
                <div class="col-md-4 mb-3 ">
                    <div class="card" style="height:31rem;">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{ url('/files/employee/' . $employees->image) }}" alt="Admin"
                                    class="rounded img-thumbnail "  width="250px" height="250px">
                                <div class="mt-3">
                                    <h4>{{ $employees->employeeDetail->name }}</h4>
                                    <p class="text-muted font-size-sm">{{ $employees->address }},
                                        {{ $employees->contact_no }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body bg-light shadow">
                            <div class="row">
                                <div class="bg-success">
                                    <h2 class="fw-bold fs-3">Personal Details</h2>
                                </div>
                                <hr>
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $employees->employeeDetail->name }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $employees->employeeDetail->email }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Mobile</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $employees->contact_no }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Gender</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $employees->gender }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Address</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $employees->address }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Salary</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $employees->salary }} BDT
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Birthday Date</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $employees->birth_date }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Join Date</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $employees->join_date }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="p-5 container">
        <table class="table table-success table-bordered table-striped">
            <thead class="text-center">
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Comission</th>
                </tr>
            </thead>
            
            @foreach ($sales as $key => $data)
            <tbody>
                <tr>
                
                    <td class="text-center">{{date("Y-M-d",strtotime($data->task->start_date) )}} - {{date("Y-M-d",strtotime($data->task->end_date))}}</td>
                    <td class="text-center">{{$data->commission}}</td>
                    
                </tr>
            </tbody>
            @endforeach
            
        </table>
    </div>


@endsection
