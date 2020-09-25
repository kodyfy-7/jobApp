<?php

namespace App\Http\Controllers\Users\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Client;
use App\ClientProfile;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:client');
    }


    public function index()
    {
        return view('client.profile');
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
        $this->validate($request, [
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'linkedin' => 'required',
            'facebook' => 'required',
            'twitter' => 'required',
            'logo' => 'required|image|max:1999'
        ]);
        //Handle file upload
        if($request->hasFile('logo')){
            // Get filename with the extension
            $filenameWithExt = $request->file('logo')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('logo')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('logo')->storeAs('public/company_logos', $fileNameToStore);
        }

        //Create Profile
        $profile = new ClientProfile;
        $profile->logo = $fileNameToStore;
        $profile->client_id = auth()->user()->id;
        $profile->linkedin_link = $request->input('linkedin');
        $profile->twitter_link = $request->input('twitter');
        $profile->facebook_link = $request->input('facebook');
        $profile->save();

        $form_data = array(
            'profile_status'        =>  1,
            'address'        =>  $request->input('address'),
            'city'        =>  $request->input('city'),
            'state'        =>  $request->input('state'),
            'logo' => $fileNameToStore,
            'client_id' => auth()->user()->id,
            'linkedin_link' => $request->input('linkedin'),
            'twitter_link' => $request->input('twitter'),
            'facebook_link' => $request->input('facebook'),

        );

        Client::whereId(auth()->user()->id)->update($form_data);

        return redirect()->back()->with('success', 'Profile Saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        if(auth()->user()->profile_status > 0)
        {
            $this->validate($request, [
                'address' => 'required',
                'city' => 'required',
                'state' => 'required',
                'linkedin' => 'required',
                'facebook' => 'required',
                'twitter' => 'required',
            ]);
        } else 
        {
            $this->validate($request, [
                'address' => 'required',
                'city' => 'required',
                'state' => 'required',
                'linkedin' => 'required',
                'facebook' => 'required',
                'twitter' => 'required',
                'logo' => 'required|image|max:1999'
            ]);
        }
        
        //Handle file upload
        if($request->hasFile('logo')){
            // Get filename with the extension
            $filenameWithExt = $request->file('logo')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('logo')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('logo')->storeAs('public/company_logos', $fileNameToStore);
        }

        $form_data = array(
            'address'        =>  $request->input('address'),
            'city'        =>  $request->input('city'),
            'state'        =>  $request->input('state'),
            'linkedin_link' => $request->input('linkedin'),
            'twitter_link' => $request->input('twitter'),
            'facebook_link' => $request->input('facebook'),

        );

        Client::whereId(auth()->user()->id)->update($form_data);

        //Update Profile
        if($request->hasFile('logo')){
            $form_data = array(
                'logo' => $fileNameToStore,
            );
            Client::whereId(auth()->user()->id)->update($form_data);
        }
        
        return redirect()->back()->with('success', 'Profile Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
