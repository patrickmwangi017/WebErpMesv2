<?php

namespace App\Models\Workflow;

use App\Models\Planning\Task;
use App\Models\Workflow\Quotes;
use App\Models\Products\Products;
use App\Models\Methods\MethodsUnits;
use Illuminate\Database\Eloquent\Model;
use App\Models\Accounting\AccountingVat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuoteLines extends Model
{
    use HasFactory;
    
    protected $fillable = ['quotes_id', 
                            'ordre', 
                            'code',
                            'product_id',
                            'label',
                            'qty',
                            'methods_units_id',
                            'selling_price',
                            'discount',
                            'accounting_vats_id',
                            'delivery_date',
                            'statu'
                        ];

    public function quote()
    {
        return $this->belongsTo(Quotes::class, 'quotes_id');
    }

    public function Product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function Unit()
    {
        return $this->belongsTo(MethodsUnits::class, 'methods_units_id');
    }
    public function VAT()
    {
        return $this->belongsTo(AccountingVat::class, 'accounting_vats_id');
    }

    public function Task()
    {
        return $this->hasMany(Task::class, 'quote_lines_id')->orderBy('ordre');
    }

    public function getTaskCountAttribute()
    {
        return $this->Task()->count();
    }

    public function TechnicalCut()
    {
        return $this->hasMany(Task::class, 'quote_lines_id')
                    ->where(function (Builder $query) {
                        return $query->where('type', 1)
                                    ->orWhere('type', 7);
                    })
                    ->orderBy('ordre');
    }

    public function BOM()
    {
        return $this->hasMany(Task::class, 'quote_lines_id')
                    ->where(function (Builder $query) {
                        return $query->where('type', 3)
                                    ->orWhere('type','=', 4)
                                    ->orWhere('type','=', 5)
                                    ->orWhere('type','=', 6)
                                    ->orWhere('type','=', 8);
                    })
                    ->orderBy('ordre');
    }

    public function GetPrettyCreatedAttribute()
    {
        return date('d F Y', strtotime($this->created_at));
    }
}
