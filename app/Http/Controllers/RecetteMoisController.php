<?php

namespace App\Http\Controllers;

use App\Models\RecetteMois;
use Illuminate\Http\Request;

class RecetteMoisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(RecetteMois::all());
    }
}
