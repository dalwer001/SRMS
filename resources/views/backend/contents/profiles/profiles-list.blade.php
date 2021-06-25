@extends('backend.main')
@section('content')
    <link href="/css/profile.css" rel="stylesheet">


    @if (session()->has('success-message'))
        <div class="alert alert-success d-flex justify-content-between m-2">
            {{ session()->get('success-message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('error-message'))
        <div class="alert alert-danger d-flex justify-content-between m-2">
            {{ session()->get('error-message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger d-flex justify-content-between m-2">{{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
    @endif

    <div class="container">
        <div class="main-body">
            <h2 class="h2 border-bottom title mt-3">{{ $title }}</h2>
            <!-- /Breadcrumb -->

            <div class="row gutters-sm mt-3">
                <div class="col-md-4 mb-3 ">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{ url('/files/employee/' . $employees->image) }}" alt="Admin"
                                    class="rounded-circle" style="width:150px;height:150px">
                                <div class="mt-3">
                                    <h4>{{ $users->name }}</h4>
                                    <p class="text-muted font-size-sm">{{ $employees->address }},
                                        {{ $employees->contact_no }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-light mt-3 p-3 d-flex justify-content-center">
                        <button class="btn change-password m-1 fw-bolder" href="" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Change Password</button>
                    </div>

                </div>

                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body bg-light ">
                            <div class="row">
                                <div class="table-header p-2">
                                    <h2 class="fw-bold fs-3">Personal Details</h2>
                                </div>
                                <hr>
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $users->name }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $users->email }}
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
                                    {{ date("Y-M-d",strtotime($employees->created_at)) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-5">
            <table class="table  table-bordered ">
                <thead class="text-center table-header">
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Comission</th>
                    </tr>
                </thead>
                @foreach ($commission as $key => $data)
                <tbody class="bg-light">
                    <tr>
                        <td class="text-center">{{date("Y-M-d",strtotime($data->task->start_date) )}} - {{date("Y-M-d",strtotime($data->task->end_date))}}</td>
                        <td class="text-center"> {{$data->commission}}</td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>

    </div>


    {{-- modal --}}

    <form method="post" action="{{ route('employee.profileUpdate', $employees['id']) }}">
        @csrf
        <div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content ">
                    <div class="modal-header">
                    <h5 class="modal-title fw-bold">Change Password</h5>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Enter Current Password:</label>
                            <input type="password" required name="current_password" class="form-control" placeholder="*****"
                                id="">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Enter New Password:</label>
                            <input type="password" required name="new_password" class="form-control" placeholder="*****" id="">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Confirm Password:</label>
                            <input type="password" required name="confirm_password" class="form-control" placeholder="*****"
                                id="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn modal-cancel text-white fw-bolder" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn modal-submit text-white fw-bolder">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </form>





@endsection
