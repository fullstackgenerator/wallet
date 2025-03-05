<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'start_date',
        'dropDownIncome',
        'dropDownExpense',
    ];
    protected function startDate(): Attribute
    {
        return Attribute::get(fn($value) =>
        \Carbon\Carbon::parse($value)->locale('en')->translatedFormat('d. F Y'));
    }
}
