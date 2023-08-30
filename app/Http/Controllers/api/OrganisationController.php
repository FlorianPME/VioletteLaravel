<?php

namespace App\Http\Controllers\api;

use App\Http\Resources\OrganisationResource;
use App\Http\Controllers\Controller;
use App\Models\Organisation;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Http\Request;
use App\Http\Pipes\Organisations\SearchFilter;
use App\Models\Person;

class OrganisationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organisations = app(Pipeline::class)
            ->send(Organisation::query())
            ->through([
                SearchFilter::class
            ])
            ->thenReturn()
            ->with(['sector', 'people'])
            ->orderBy('organisation_name', 'ASC')
            ->get();
        return OrganisationResource::make($organisations);
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(Request $request)
    {
            $request->validate([
                'organisation_name' => 'required',
                'postal_code' => 'required',
                'city' => 'required',
                'chiffre_affaires' => 'required',
                'sector_id' => 'required',
            ]);

            $organisation = Organisation::create([
                'organisation_name'=>$request['organisation_name'],
                'postal_code'=>$request['postal_code'],
                'city'=>$request['city'],
                'chiffre_affaires'=>$request['chiffre_affaires'],
                'sector_id'=>$request['sector_id'],
            ]);

            foreach ($request->people as $person) {
                $i = Person::where('id', $person)->first();
                $i->organisation_id = $organisation->id;
                $i->save();      
            }

            return $organisation;
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $organisation = Organisation::where('id',$id)->with(['sector', 'people'])->first();
        return OrganisationResource::make($organisation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Organisation $organisation)
    {
        $request->validate([
            'organisation_name' => 'required',
            'city' => 'required',
            'chiffre_affaires' => 'required',
            'postal_code' => 'required',
            'sector_id' => 'required',
        ]);

        $organisation->update($request->all());

        return $organisation;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organisation $organisation)
    {
        $organisation->delete();
        
        return response()->json(['message' => 'Entreprise supprimée de la base de sonnée.']);
    }
}
