<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Item extends Model
{
    //
    protected $guarded = [];

    public function deliveries(){
        return $this->hasMany(DeliveryItem::class);
    }

    public function itemCategory(){
        return $this->belongsTo(ItemCategory::class);
    }

    public function priceMonitoringRecords(){
        return $this->hasMany(PriceMonitoringRecord::class);
    }

    public function defaultUnit(){
        return $this->belongsTo(Unit::class);
    }

    public function getUnitsAttribute(){
        return Unit::whereHas("itemTaxRate", function ($q){
            return $q->where("item_id", $this->id);
        })->get();
    }

    public function getUpdatedPricesAttribute(){
        return $this->hasMany(PriceMonitoringRecord::class)
        ->orderBy('unit_id')
        ->orderByDesc('date')
        ->get()
        ->unique('unit_id')
        ->values();
    }

    public function delivery_items()
    {
        return $this->hasMany(DeliveryItem::class);
    }
    public function deliveryItems()
    {
        return $this->hasMany(DeliveryItem::class);
    }
    
    public static function getAverageMinPrice(string $frequency, string $date, int $item_id)
    {
        if(!$date){
            return 0;
        }
        $baseDate = Carbon::parse($date);

        switch ($frequency) {
            case 'Daily':
                $from = $baseDate->copy()->startOfDay();
                $to   = $baseDate->copy()->endOfDay();
                break;

            case 'Weekly':
                $from = $baseDate->copy()->startOfWeek(); // Monday by default
                $to   = $baseDate->copy()->endOfWeek();
                break;

            case 'Monthly':
                $from = $baseDate->copy()->startOfMonth();
                $to   = $baseDate->copy()->endOfMonth();
                break;

            default:
                throw new \InvalidArgumentException('Invalid frequency');
        }

        return PriceMonitoringRecord::where('item_id', $item_id)
            ->whereBetween('date', [$from, $to])
            ->avg('price');
    }

    public static function getAverageMaxPrice(string $frequency, string $date, int $item_id)
    {
        if(!$date){
            return 0;
        }
        $baseDate = Carbon::parse($date);

        switch ($frequency) {
            case 'Daily':
                $from = $baseDate->copy()->startOfDay();
                $to   = $baseDate->copy()->endOfDay();
                break;

            case 'Weekly':
                $from = $baseDate->copy()->startOfWeek(); // Monday by default
                $to   = $baseDate->copy()->endOfWeek();
                break;

            case 'Monthly':
                $from = $baseDate->copy()->startOfMonth();
                $to   = $baseDate->copy()->endOfMonth();
                break;

            default:
                throw new \InvalidArgumentException('Invalid frequency');
        }

        return PriceMonitoringRecord::where('item_id', $item_id)
            ->whereBetween('date', [$from, $to])
            ->avg('price_max');
    }

    public function itemTaxRates(){
        return $this->hasMany(ItemTaxRate::class);
    }

}
