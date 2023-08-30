<?php

namespace App\Http\Pipes\Organisations;

class SearchFilter {
    public function handle ($query, \Closure $next){

    $query->when(request()->has('search'), function($query){
        $query->where('organisation_name', 'like', '%'.request('search').'%');
    });
    return $next($query);
}
}