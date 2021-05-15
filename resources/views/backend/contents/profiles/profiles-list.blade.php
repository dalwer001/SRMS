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
            <h2 class="fw-bolder border-bottom">{{$title}}</h2>
            <!-- /Breadcrumb -->

            <div class="row gutters-sm mt-3">
                <div class="col-md-4 mb-3 ">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{ url('/files/employee/' . $employees->image) }}" alt="Admin"
                                    class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h4>{{ $users->name }}</h4>
                                    <p class="text-muted font-size-sm">{{ $employees->address }},
                                        {{ $employees->contact_no }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-light mt-3 p-3 d-flex justify-content-center">
                        <a class="btn btn-info m-1" href="#">Profile picture update</a>

                        <button class="btn btn-warning m-1" href="" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Change Password</button>
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
                                    {{ $employees->join_date }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="p-5">
        <table class="table table-success table-bordered table-striped">
            <thead class="text-center">
                <tr>
                    
                    <th scope="col">Date</th>
                    <th scope="col">Comission</th>
                </tr>
            </thead>
            {{-- @foreach ($categories as $key => $data) --}}
            <tbody>
                <tr>
                
                    <td class="text-center">date</td>
                    <td class="text-center"> 250BDT </td>
                </tr>
            </tbody>
            {{-- @endforeach --}}
        </table>
    </div>

    {{-- modal --}}

    <form method="post" action="{{ route('employee.profileUpdate', $employees['id']) }}">
        @csrf
        <div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog  bg-danger">
                <div class="modal-content">

                    <h2 class="m-3">Change Password</h2>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Enter Current Password:</label>
                            <input type="password" required name="current_password" class="form-control" placeholder="**"
                                id="">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Enter New Password:</label>
                            <input type="password" required name="new_password" class="form-control" placeholder="**" id="">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Confirm Password:</label>
                            <input type="password" required name="confirm_password" class="form-control" placeholder="*"
                                id="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </form>





@endsection
