@extends('layouts.master')
@section('title','Bed Reservation Setting')
@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title text-capitalize fw-semibold">Bed Reservation Setting</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">{{config('app.name')}}</a>
                        </li>
                        <li class="breadcrumb-item active">Facility</li>
                    </ol>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end page-title-box-->
    </div><!--end col-->
</div><!--end row-->
<!-- end page title end breadcrumb -->
<div class="row">

    <div class="card">
        <div class="card-header row">
            <div class="col-md-6">
                <button type="button" class="text-capitalize btn btn-secondary btn-square btn-outline-dashed" data-bs-toggle="modal" data-bs-target="#createNewModal">
                    Create new Facility
                </button>
            </div>
            <div class="col-md-6">
                <form action="{{route('rrs.facility.index')}}" class="me-1">
                    <div class="input-group mb-3 table-search-box">
                        <input type="text" class="form-control" placeholder="Search" name="q" value="{{request()->q??''}}">
                        <button class="btn btn-secondary" title="Search" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        <a class="btn btn-danger" href="{{route('rrs.facility.index')}}" title="Reset">
                            <i class="fas fa-redo-alt"></i>
                        </a>
                    </div>
                </form>

            </div>
        </div><!--end card-header-->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered mb-0 table-centered">
                    <thead>
                        <tr class="text-bolder">
                            <th>SL.</th>
                            <th>Icon [ <a href="https://fontawesome.com/v5/search">Goto Icon Store</a> ]</th>
                            <th>Facility</th>
                            <th class="d-none">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><i class="{{$item->icon}}"></i> [{{$item->icon}}]</td>
                            <td>{{$item->name}}</td>
                            <td class="d-none">
                                <div class="d-flex justify-content-start">
                                    <button class="btn btn-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target="#editModal{{$item->id}}">Edit</button>
                                    <form action="" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure want delete this item?')">Delete</button>
                                    </form>
                                </div>
                                <div class="modal fade bd-example-modal" id="editModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title m-0" id="myLargeModalLabel">Edit existing item</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div><!--end modal-header-->
                                            <div class="modal-body">
                                                <form action="{{route('rrs.facility.update',$item->id)}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label" for="exampleInputEmail1">Icon</label>
                                                            <input type="text" class="form-control" placeholder="Enter icon class" name="icon" value="{{$item->icon??''}}">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label" for="exampleInputEmail1">Facility</label>
                                                            <input type="text" class="form-control" placeholder="Enter facility" name="name" required value="{{$item->name??''}}">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div><!--end row-->
                                                </form>

                                            </div><!--end modal-body-->
                                        </div><!--end modal-content-->
                                    </div><!--end modal-dialog-->
                                </div><!--end modal-->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table><!--end /table-->
            </div><!--end /tableresponsive-->
        </div><!--end card-body-->
    </div><!--end card-->
</div> <!-- end row -->
<!-- create new modal -->
<div class="modal fade modal-fullscreen-down" id="createNewModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="myLargeModalLabel">Create new item</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--end modal-header-->
            <div class="modal-body">
                <form action="{{route('rrs.facility.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="exampleInputEmail1">Icon</label>
                            <input type="text" class="form-control" placeholder="Enter icon class" name="icon">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="exampleInputEmail1">Facility*</label>
                            <input type="text" class="form-control" placeholder="Enter facility" name="name" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div><!--end row-->
                </form>

            </div><!--end modal-body-->
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div><!--end modal-->
@endsection