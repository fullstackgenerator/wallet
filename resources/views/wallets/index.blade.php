@extends('layouts.master')

@section('content')
    <div class="row py-3">

        {{--        Data Input --}}
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('wallets.store') }}" method="post">
                        @csrf
                        <div class="col-md-12 py-2">
                            <input type="number" name="amount" class="form-control" placeholder="Amount" step="0.01">

                        </div>
                        <div class="col-md-12 py-2">
                            <input type="date" name="start_date" class="form-control"/>
                        </div>
                        <div class="col-md-12 py-2">
                            <select class="form-select" name="dropDownIncome">
                                <option value="">Select income type</option>
                                <option value="Salary">Salary</option>
                                <option value="Salary bonus">Salary bonus</option>
                                <option value="Income from services">Income from services</option>
                                <option value="Income from sales commission">Income from sales commission</option>
                                <option value="Income from stocks">Income from stocks</option>
                                <option value="Income from rent">Income from rent</option>
                                <option value="Sale of goods">Sale of goods</option>
                                <option value="Tax return">Tax return</option>
                                <option value="Other income">Other</option>
                            </select>
                        </div>

                        <div class="col-md-12 py-2">
                            <select class="form-select" name="dropDownExpense">
                                <option value="">Select expense type</option>
                                <option value="Insurance insurance">Personal insurance</option>
                                <option value="Rent">Rent</option>
                                <option value="Electricity">Electricity</option>
                                <option value="Phone">Phone</option>
                                <option value="Waste collection">Waste collection</option>
                                <option value="Water">Water</option>
                                <option value="Heating">Heating</option>
                                <option value="Internet">Internet</option>
                                <option value="Fuel">Fuel</option>
                                <option value="House loan">House loan</option>
                                <option value="School loan">School loan</option>
                                <option value="Vehicle loan">Vehicle loan</option>
                                <option value="Vehicle maintenance">Vehicle maintenance</option>
                                <option value="Vehicle registration">Vehicle registration</option>
                                <option value="Vehicle insurance">Vehicle insurance</option>
                                <option value="Other expense">Other</option>
                            </select>
                        </div>

                        <div class="col-md-12 py-2">
                            <button class="btn btn-outline-primary w-100" type="submit">Confirm</button>
                        </div>
                        <div class="col-md-12 py-2">
                            <button class="btn btn-outline-cyan w-100" type="reset">Clear</button>
                        </div>
                    </form>
                    <div class="col-md-12 py-2">
                        <a href="{{ route('charts.index') }}" class="btn btn-outline-teal w-100">Chart</a>
                    </div>
                </div>
            </div>
        </div>

        {{--        Financial Overview --}}
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered text-center w-100">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Details</th>
                            <th>Transaction Type</th>
                            <th>Amount</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($wallets as $wallet)
                            <tr>
                                <td>{{ $wallet->start_date }}</td>
                                <td>
                                    @if($wallet->dropDownIncome)
                                        {{ $wallet->dropDownIncome }}
                                    @elseif($wallet->dropDownExpense)
                                        {{ $wallet->dropDownExpense }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($wallet->dropDownIncome)
                                        Income
                                    @elseif($wallet->dropDownExpense)
                                        Expense
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ number_format($wallet->amount, 2) }}€</td>
                                <td class="w-25">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('wallets.show', $wallet->id) }}"
                                           class="btn btn-outline-success">Details</a>
                                        <a href="{{ route('wallets.edit', $wallet->id) }}"
                                           class="btn btn-outline-warning">Edit</a>
                                        <form action="{{ route('wallets.destroy', $wallet->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                            <td><strong>{{ number_format($wallet_sum, 2) }}€</strong></td>
                            <td>
                                <a href="{{ route('wallets.export') }}" class="btn btn-outline-purple">Export data</a>


                            </td>
                        </tr>
                        </tfoot>
                    </table>

                    <div class="d-flex justify-content-center">
                        <div class="col-6 py-2"> {{ $wallets->links() }}</div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let incomeDropdown = document.querySelector("select[name='dropDownIncome']");
            let expenseDropdown = document.querySelector("select[name='dropDownExpense']");

            function toggleDropdowns() {
                if (incomeDropdown.value !== "") {
                    expenseDropdown.disabled = true;
                } else {
                    expenseDropdown.disabled = false;
                }

                if (expenseDropdown.value !== "") {
                    incomeDropdown.disabled = true;
                } else {
                    incomeDropdown.disabled = false;
                }
            }

            incomeDropdown.addEventListener("change", toggleDropdowns);
            expenseDropdown.addEventListener("change", toggleDropdowns);
        });
    </script>
@endsection
