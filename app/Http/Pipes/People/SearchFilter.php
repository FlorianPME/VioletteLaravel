<?php

namespace App\Http\Pipes\People;
use Illuminate\Support\Facades\DB; 

class SearchFilter {
    public function handle ($query, \Closure $next){

    $query->when(request()->has('search'), function($query){
        $query->where(DB::raw("CONCAT_WS(' ', last_name, first_name)"), 'like', '%'.request('search').'%')
        ->orWhere(DB::raw("CONCAT_WS(' ', first_name, last_name)"), 'like', '%'.request('search').'%');
    });
    return $next($query);
}
}