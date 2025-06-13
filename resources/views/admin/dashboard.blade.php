@extends('layouts.admin')
@section('title')
{{ 'Dashboard' }}
@endsection
@section('content')
<style>
    .dashboard-card {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        text-decoration: none; /* Remove underline */
        color: inherit; /* Keep text color */
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.15);
    }

    /* Card Icon */
    .card-icon {
        font-size: 30px;
        background: #f0f0f0;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        margin-right: 15px;
    }

    .card-icon i {
        color: #007bff;
    }

    /* Card Content */
    .card-content h4 {
        font-size: 24px;
        margin: 0;
        font-weight: bold;
    }

    .card-content p {
        margin: 0;
        font-size: 14px;
        color: #666;
    }

</style>
<h4 class="mb-sm-0 font-size-18 py-4">Dashboard</h4>

<!-- end row -->

<div class="row">
    

</div>


@endsection