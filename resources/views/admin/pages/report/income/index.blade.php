@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Laporan Pendapatan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Laporan Pendapatan</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Filter</h5>
                            <form action="{{ route('admin.report.income.export') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class='form-group'>
                                            <label for='month'>Bulan</label>
                                            <select name='month' id='month'
                                                class='form-control @error('month') is-invalid @enderror'>
                                                <option value='' selected disabled>Pilih Bulan</option>
                                                @foreach ($months as $month)
                                                    <option @selected($month['no'] == old('month')) value='{{ $month['no'] }}'>
                                                        {{ $month['name'] }}</option>
                                                @endforeach
                                            </select>
                                            @error('month')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class='form-group'>
                                            <label for='year'>Tahun</label>
                                            <select name='year' id='year'
                                                class='form-control @error('year') is-invalid @enderror'>
                                                <option value='' selected disabled>Pilih Tahun</option>
                                                @foreach ($years as $year)
                                                    <option @selected($year == old('year')) value='{{ $year }}'>
                                                        {{ $year }}</option>
                                                @endforeach
                                            </select>
                                            @error('year')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2 align-self-center">
                                        <button class="btn btn-sm px-4 btn-danger py-2 btnFilter"><i
                                                class="fas fa-file-pdf"></i>
                                            Print</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<x-Admin.Sweetalert />
