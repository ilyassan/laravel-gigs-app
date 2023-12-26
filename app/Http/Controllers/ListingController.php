<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;


class ListingController extends Controller
{
    // Show all listings
    public function index(){
        return view('listings.index', [
            'listings' =>  Listing::latest()->filter(request(['tag', 'search']))->paginate(4)
        ]);
    }

    // Show single listing
    public function show(Listing $listing){
        return view('listings.show', [
            'listing' =>  $listing
        ]);
    }

    // Show Create Form
    public function create(){
        return view('listings.create');
    }

    // Store Listing Data
    public function store(Request $request){
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);
        
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return redirect('/')->with('message',  'Listing created succesfully!');
    }

    
    // Show Edit Form
    public function edit(Listing $listing){
        // Check if is the owner
        if($listing && $listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }

        return view('listings.edit', ['listing' => $listing]);
    }

    // Update Listing
    public function update(Request $request, Listing $listing){
        // Check if is the owner
        if($listing && $listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => $request->company == $listing->company
                        ?'required':['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');

            // Delete old logo from storage
            if (Storage::disk('public')->exists($listing->logo)) {
                Storage::disk('public')->delete($listing->logo);
            }
        }

        $listing->update($formFields);

        return redirect('/listings/'. $listing->id)->with('message',  'Listing updated succesfully!');
    }


    // Delete Listing
    public function delete(Listing $listing){
        // Check if is the owner
        if($listing && $listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }

        $listing->delete();

        return redirect('/')->with('message',  'Listing deleted succesfully!');
    }

    // Manage Listings
    public function manage(){
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
