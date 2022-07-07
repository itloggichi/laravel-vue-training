<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Booking;

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
        return 0 !== $this->bookings()->betweenDates($from, $to)->count();
        // in udemy, when availability is 0, it returns true (that it is available,
        // but i got confused because if there is 0 availability, shouldn't it return false? but for this case I changed it
        // so i wouldn't get an availability where there is no availability.
    }
}
