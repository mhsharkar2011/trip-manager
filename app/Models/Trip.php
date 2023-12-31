<?php

namespace App\Models;

use App\Devpanel\Models\baseModel;
use Illuminate\Database\Eloquent\Model;
use Nette\Schema\Expect;
use PhpParser\Node\Expr\FuncCall;

class Trip extends baseModel
{

    
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'trips';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    //protected $fillable = ['user_id', 'vehicle_id', 'from_area', 'to_area', 'mileages', 'rate'];

    protected $guarded = [
        'id'
    ];    
    

    protected static function validation_rules() {
        return [
            // 'booking_id' => 'required|unique:trips,booking_id',
        ];
    }

    protected static function validation_messages() {
        return [
            // 'booking_id.unique' => 'This booking ID is already taken.',
        ];
    } 

    protected static function validation_rules_for_update() {
        return self::validation_rules();
    }

    protected static function validation_messages_for_update() {
        return self::validation_messages();
    }           

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class,'driver_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class,'vehicle_id');
    }

    // Mileages
    public function mileage()
    {
        return $this->belongsTo(Mileage::class,'vehicle_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class,'package_id');
    }

    public function fuel()
    {
        return $this->hasOne(Fuel::class,'trip_id');
    }
    
    public function expense()
    {
        return $this->hasOne(Expense::class,'trip_id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($trip){
            $fuel = new Fuel();
            $fuel->trip_id = $trip->id;
            $fuel->fuel_name = $trip->fuel_name;
            $fuel->fuel_amount = $trip->fuel_amount;
            $fuel->save();

            $expense = new Expense();
            $expense->trip_id = $trip->id;
            $expense->item_name = $trip->item_name;
            $expense->amount = $trip->amount;
            $expense->save(); 
        });
    }
}
