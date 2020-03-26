<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meetup;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class MeetupController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Meetup::paginate(20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5',
            'description' => 'required',
            'location' => 'required',
            'imageUrl' => 'required|image',
            'date' => 'required',
            'user_id' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {

            //Upload Image 
            $extension = $request->imageUrl->getClientOriginalExtension();
            $filename = $request->imageUrl->getFilename() . "." . $extension;
            $request->imageUrl->move(public_path('images'), $filename);

            // Create Meetup
            $meetup = new Meetup();

            $meetup->title = $request->title;
            $meetup->description = $request->description;
            $meetup->location = $request->location;
            $meetup->date = $request->date;
            $meetup->imageUrl = "images/" . $filename;
            $meetup->user_id = $request->user_id;
            $meetup->save();
            return response()->json($meetup);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(["Loza"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Meetup::find($id);
        if($user){
            $user->delete();
        return response()->json([
            "deleted"=>true
        ]);
        }
        return response()->json([
            "deleted"=>false
        ]);

    }
}
