@extends('layouts.master')
@section('menu')
@extends('sidebar.staff_activity_log')
@endsection
@section('content')
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Staff Activity Audit</h3>
                    <p class="text-subtitle text-muted">For user audit trigger in staff list</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Staff Activity Audit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    Log Datatable
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>A jour par</th>
                                <th>Staff name</th>
                                <th>staff Department</th>
                                <th>staff Salary</th>
                                <th>Modify</th>
                                <th>Date de changement</th>
                            </tr>    
                        </thead>
                        <tbody>
                            @foreach ($staffactivityLog as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->user_name }}</td>
                                    <td>{{ $item->staff_name }}</td>
                                    <td>{{ $item->department }}</td>
                                    <td>{{ $item->salary }}</td>
                                    <td>{{ $item->modify_user }}</td>
                                    <td>{{ $item->date_time }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    
</div>
@endsection
