@extends('layouts.master')

@section('content')
    <div class="row w-100 my-6 text-center">

        <div class="card col-md-6 mx-auto p-3">
            <div class="card-body">
                <h3 class="card-title">Transaction Details</h3>
                <table class="table table-bordered">
                    <tr>
                        <th>Date</th>
                        <td>{{ $wallet->start_date }}</td>
                    </tr>
                    <tr>
                        <th>Details</th>
                        <td>
                            @if($wallet->dropDownIncome)
                                {{ $wallet->dropDownIncome }}
                            @elseif($wallet->dropDownExpense)
                                {{ $wallet->dropDownExpense }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Transaction Type</th>
                        <td class="align-middle">
                            @if($wallet->dropDownIncome)
                                Income
                            @else
                                Expense
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Amount</th>
                        <td>{{ number_format($wallet->amount, 2) }}€</td>
                    </tr>
                </table>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('wallets.index') }}" class="btn btn-outline-secondary">Back</a>
                    <a href="{{ route('wallets.edit', $wallet->id) }}" class="btn btn-outline-warning">Edit</a>
                </div>
            </div>
        </div>

    </div>
@endsection
