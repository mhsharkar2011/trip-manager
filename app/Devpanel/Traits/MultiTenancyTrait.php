<?php
namespace App\Devpanel\Traits;

use App\Devpanel\Models\Tenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait MultiTenancyTrait {

    public function tenant() {
        return $this->belongsTo(Tenant::class);
    }

    protected static function booted()
    {       
        $tenant_id_column = 'tenant_id';
        $tenant_id_header_key = 'x-tenant-id';

        parent::boot();

        if (request()->header($tenant_id_header_key)) {
            static::addGlobalScope('tenancy', function (Builder $builder) use ($tenant_id_column, $tenant_id_header_key) {
                $builder->where(
                    $builder->getModel()->getTable() . '.' . $tenant_id_column, 
                    (int) request()->header($tenant_id_header_key)
                );
            });        
        }

        if (request()->header($tenant_id_header_key)) {
            static::creating(function ($model) use ($tenant_id_header_key) {
                $model->tenant_id = (int) request()->header($tenant_id_header_key);
            });
        }
    }

}