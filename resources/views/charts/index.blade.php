@extends('layouts.master')

@section('content')
    <div class="row py-3">
        <div class="row-md-6">
            <div class="card">
                <div class="card-body">
                    <div id="chart-tasks-overview"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 py-2">
        <a href="{{route('wallets.index')}}" class="btn btn-outline-blue w-15">Back</a>
    </div>

    {{-- Hidden JSON Data for JavaScript --}}
    <script type="application/json" id="wallet-data">
        @json($wallets)
    </script>
@endsection

@section('js')
    <script src="{{ mix('js/chart.js') }}"></script>
@endsection
