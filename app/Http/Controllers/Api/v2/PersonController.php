<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Resources\v2\PersonResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\PersonResouceCollection;
use Illuminate\Http\Request;
use App\PersonV2;
use App\Person;


class PersonController extends Controller
{

    public function index() : PersonResouceCollection
    {
        return new PersonResouceCollection(PersonV2::paginate());
        
    }

    public function show(PersonV2 $person)
    {
        return new PersonResource($person);
    }


    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'mobile' => 'required'
        ]);

        $person = Person::create($request->all());
        
        return new PersonResource($person);
    }
}
