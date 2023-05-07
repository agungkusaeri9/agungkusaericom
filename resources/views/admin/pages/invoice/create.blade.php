@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Buat Invoice</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.invoices.index') }}">Data Invoice</a></div>
                <div class="breadcrumb-item">Buat Invoice</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('admin.invoices.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Nama</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name') }}" id="name">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="phone_number">Nomor HP</label>
                                            <input type="text"
                                                class="form-control @error('phone_number') is-invalid @enderror"
                                                name="phone_number" value="{{ old('phone_number') }}" id="phone_number">
                                            @error('phone_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class='form-group mb-3'>
                                            <label for='address' class='mb-2'>Alamat</label>
                                            <textarea name='address' id='address' cols='30' rows='3'
                                                class='form-control @error('address') is-invalid @enderror'>{{ old('address') }}</textarea>
                                            @error('address')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class='form-group mb-3'>
                                            <label for='discount' class='mb-2'>Diskon (Rp)</label>
                                            <input type='number' name='discount'
                                                class='form-control @error('discount') is-invalid @enderror'
                                                value='{{ old('discount') }}'>
                                            @error('discount')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="payment_id">Metode Pembayaran</label>
                                            <select name="payment_id" required
                                                class="form-control @error('payment_id') is-invalid @enderror">
                                                <option value="" selected disabled>Pilih Metode Pembayaran</option>
                                                @foreach ($payments as $payment)
                                                    <option value="{{ $payment->id }}">
                                                        {{ $payment->name . ' | ' . $payment->number }}</option>
                                                @endforeach
                                            </select>
                                            @error('payment_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="status"
                                                class="form-control @error('status') is-invalid @enderror">
                                                <option value="" selected disabled>Pilih Status</option>
                                                <option @if (old('status') == 1) selected @endif value="1">
                                                    Paid</option>
                                                <option @if (old('status') === '0') selected @endif value="0">
                                                    Unpaid
                                                </option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class='form-group mb-3 f-paid-time d-none'>
                                            <label for='paid_time' class='mb-2'>Tanggal Dibayarkan</label>
                                            <input type='datetime-local' name='paid_time'
                                                class='form-control @error('paid_time') is-invalid @enderror'
                                                value='{{ old('paid_time') }}' id="paid_time">
                                            @error('paid_time')
                                                <div class='invalid-feedback'>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-block btn-primary"><i class="fas fa-plus"></i>
                                                Buat</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class='form-group mb-3'>
                                                    <label for='item_description' class='mb-2'>Item Description</label>
                                                    <textarea name='item_description[]' cols='30' rows='3' required
                                                        class='form-control @error('item_description') is-invalid @enderror'></textarea>
                                                    @error('item_description')
                                                        <div class='invalid-feedback'>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class='form-group mb-3'>
                                                    <label for='item_price' class='mb-2'>Harga</label>
                                                    <input type='number' name='item_price[]' required
                                                        class='form-control @error('item_price') is-invalid @enderror'
                                                        value=''>
                                                    @error('item_price')
                                                        <div class='invalid-feedback'>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class='form-group mb-3'>
                                                    <label for='item_qty' class='mb-2'>Qty</label>
                                                    <input type='number' required name='item_qty[]'
                                                        class='form-control @error('item_qty') is-invalid @enderror'
                                                        value=''>
                                                    @error('item_qty')
                                                        <div class='invalid-feedback'>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md align-self-end mb-3">
                                                <button type="button" class="btn py-2 rowAdd btn-success"><i
                                                        class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                        <div class="newInput"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(function() {
            $(".rowAdd").click(function() {
                let newRow = `
                <div class="row" id="row">
                    <div class="col-md-4">
                        <div class='form-group mb-3'>
                            <label for='item_description' class='mb-2'>Item</label>
                            <textarea name='item_description[]' id='item_description' cols='30' rows='3' required
                                class='form-control @error('item_description') is-invalid @enderror'></textarea>
                            @error('item_description')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class='form-group mb-3'>
                            <label for='item_price' class='mb-2'>Harga</label>
                            <input type='number' required name='item_price[]'
                                class='form-control @error('item_price') is-invalid @enderror'
                                value=''>
                            @error('item_price')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class='form-group mb-3'>
                            <label for='item_qty' class='mb-2'>Qty</label>
                            <input type='number' required name='item_qty[]'
                                class='form-control @error('item_qty') is-invalid @enderror'
                                value=''>
                            @error('item_qty')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md align-self-end mb-3">
                        <button type="button" class="btn py-2 rowDelete btn-danger"><i
                                class="fas fa-minus"></i></button>
                    </div>
                </div>
            `;
                $('.newInput').append(newRow);
            });

            $("body").on("click", ".rowDelete", function() {
                $(this).parents("#row").remove();
            })

            $('#status').on('change', function() {
                let status = $(this).val();
                if(status == 1)
                {
                    $('.f-paid-time').removeClass('d-none');
                }else{
                    $('.f-paid-time').addClass('d-none');
                    $('#paid_time').val('');
                }

            })
        })
    </script>
@endpush
