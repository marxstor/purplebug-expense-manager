<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $table = "expenses";

    protected $fillable = [
        'expense_categories_id',
        'user_id',
        'amount',
        'entry_date',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function expense_category() {
        return $this->belongsTo(ExpenseCategory::class, 'expense_categories_id');
    }

}
