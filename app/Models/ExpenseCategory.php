<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    use HasFactory;

    protected $table = 'expense_categories';

    protected $fillable = [ 
        'category_name',
        'description',
    ];

    public function expense() {
        return $this->hasOne(Expense::class, 'expense_categories_id');
    }
}
