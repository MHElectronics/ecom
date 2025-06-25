@extends('layouts.vendor') {{-- Use a vendor layout (create one if needed) --}}

@section('content')
<div class="container-fluid mt-4">

    {{-- Summary Cards --}}
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Today Orders</h5>
                   
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Total Sales</h5>
               
                </div>
            </div>
        </div>
    </div>

    {{-- Create Post Section --}}
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Create New Product</span>
            <a href="#" class="btn btn-sm btn-primary">+ Create Post</a>
        </div>
    </div>

    {{-- Active Orders Section --}}
    <div class="card">
        <div class="card-header">Active Orders</div>
        <ul class="list-group list-group-flush">
            
        </ul>
    </div>

</div>
@endsection
