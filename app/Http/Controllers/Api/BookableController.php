<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\BookableShowResource;
use App\Http\Resources\BookableIndexResource;
use App\Bookable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class BookableController extends Controller
{
    public function index() {
        return BookableIndexResource::collection(
            Bookable::all()
        );
    }

    public function show($id) {
        return new BookableShowResource(Bookable::findOrFail($id));
    }
}
