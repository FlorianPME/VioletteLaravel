<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PersonResource;
use App\Models\Person;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Http\Request;
use App\Http\Pipes\People\SearchFilter;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $people = app(Pipeline::class)
            ->send(Person::query())
            ->through([
                SearchFilter::class
            ])
            ->thenReturn()
            ->with(['civility'])
            ->orderBy('last_name', 'ASC')
            ->get();
        return PersonResource::make($people);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate([
                'civility_id' => 'required',
                'last_name' => 'required',
                'first_name' => 'required',
                'email' => 'required',
                'phone' => 'required',
            ]);

            

            $person = Person::create([
                'civility_id'=>$request['civility_id'],
                'last_name'=>$request['last_name'],
                'first_name'=>$request['first_name'],
                'email'=>$request['email'],
                'phone'=>$request['phone'],
                'organisation_id'=>$request['organisation_id'],
            ]);


            $location = $request['locations'];
            $person->locations()->sync($location);

            return $person;
            
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $person = Person::where('id',$id)->first();
        // $person = Person::find($id);



        $person = Person::with(['locations', 'civility', 'organisation'])->where('id', $id)->first();
        return PersonResource::make($person);
    }

    // return PersonResource::collection(Person::all());
    //  return PersonResource::collection(Person::with(['organisation'])->get());

    // $people = Person::with('organisation_id')->get();

    //     foreach ($people as $person) {
    //         echo $person->organisation_id->organisation_name;
    //     }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Person $person)
    {
        $request->validate([
            'civility_id' => 'required',
            'last_name' => 'required',
            'first_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'organisation_id' => '',
        ]);

        $person->update($request->all());
        $location = $request['location'];
        $person->locations()->sync($location);

        return $person;
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person)
    {
        $person->locations()->detach();
        $person->delete();
        return response()->json(['message' => 'Personne supprimée de la base de donnée.']);
    }
}
