@extends('layouts.master')

@section('content')
    <div class="row w-50 mx-auto text-center">

        <div class="card col-md-6 mx-auto p-3">
            <div class="card-body">
                <form action="{{ route('wallets.update', $wallet->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="col-md-12 py-2">
                        <input type="number" name="amount"  class="form-control"
                               value="{{ $wallet->amount }}" placeholder="Amount">
                    </div>

                    <div class="col-md-12 py-2">
                        <input type="date" name="start_date" class="form-control"
                               value="{{ $wallet->start_date }}">
                    </div>

                    <div class="col-md-12 py-2">
                        <button class="btn btn-outline-success w-100" type="submit">Confirm</button>
                    </div>
                    <div class="col-md-12 py-2">
                        <a href="{{ route('wallets.index') }}" class="btn btn-outline-secondary w-100">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
