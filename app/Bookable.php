<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Booking;
use Illuminate\Support\Carbon;

class Bookable extends Model
{
    public function bookings() {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function availableFor($from, $to): bool
    {

        return 0 === $this->bookings()->betweenDates($from, $to)->count();
        // fix: I misunderstood the count of bookings, in this case the count refers to the number of bookings within a period, therefore the user cannot book on those dates.
    }
    
    public function pricefor($from, $to): array
    {
        $days = (new Carbon($from))->diffInDays(new Carbon($to)) + 1;
        $price = $days * $this->price;

        return [
            'total' => $price,
            'breakdown' => [
                $this->price => $days
            ]
        ];
    }
}
