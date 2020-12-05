<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Resources\PersonResource;
use App\Http\Resources\PersonResouceCollection;
use App\Http\Controllers\Controller;
use App\Person;

class PersonController extends Controller
{

    /**
     * Undocumented function
     *
     * @param Person $people
     * @return void
     */
    public function show(Person $person): PersonResource
    {
        
    		return new PersonResource($person);
    }

    /**
     * 
     */

    public function index(Person $person) : PersonResouceCollection
    {
            return new PersonResouceCollection($person::paginate());
    }

    public function store(Request $request)
    {
        //create 

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'city' => 'required',

        ]);

        $person = Person::create($request->all());

        return new PersonResource($person);
    }

    public function update(Person $person,Request $request) : PersonResource
    {

        // dd($request->all());
        $person->update($request->all());
        return new PersonResource($person);
    }

    public function destroy(Person $person)
    {


        if ($person->delete()) {
            echo "data has been deleted";
            return response()->json();

        }else {
            echo "no deleted data";
        }
            return response()->json();
    }
}
