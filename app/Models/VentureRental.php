<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VentureRental extends Model
{
    protected $table = 'venture_rentals';

    protected $fillable = ['venture_id','date_rent_collected','rent_due','amount_collected','rent_past_due','fees_and_other_income','management_fee','repairs_and_other_expenses','net_income'];

    public function venture()
    {
        return $this->hasOne('App\Models\Venture','id','venture_id');
    }
}