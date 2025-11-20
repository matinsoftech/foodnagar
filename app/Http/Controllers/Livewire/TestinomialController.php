<?php

namespace App\Http\Controllers\Livewire;

use App\Models\Testinomial;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TestinomialController extends Controller
{
    public function index(){
        $testinomials = Testinomial::paginate(10);


        return view('livewire.testinomial.index',compact('testinomials'));
    }
    public function create(){
        return view('livewire.testinomial.create');
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|string',
            'designation' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        DB::beginTransaction(); // Start the transaction

        try {
            // Create the Testinomial record
            $testinomial = Testinomial::create([
                'name' => $validatedData['name'],
                'designation' => $validatedData['designation'],
                'description' => $validatedData['description'],
                'slug' => Str::slug($validatedData['name']),
                'is_active' => $request->is_published ? 1 : 0,
            ]);


            // Handle image upload using Spatie Media Library
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Store the image and associate it with the blog post in the 'images' media collection
            $testinomial->addMedia($image)
                ->toMediaCollection('images');
        }

            DB::commit(); // Commit the transaction

            return redirect()->route('testinomial.index')->with('success', 'Testinomial created successfully!');

        } catch (\Exception $e) {
            DB::rollBack(); // Rollback the transaction in case of an error

            return response()->json([
                'message' => 'Failed to create testinomial.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id){
        $testinomial = Testinomial::find($id);

        return view('livewire.testinomial.show',compact('testinomial'));
    }

    public function edit($id){
        $testinomial = Testinomial::find($id);
        return view('livewire.testinomial.edit',compact('testinomial'));
    }

    public function update(Request $request,$id)
    {
       // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'designation' => 'required|string',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        // Find the blog and update
        $testinomial = Testinomial::findOrFail($id);
        $testinomial->update([
            'name' => $validatedData['name'],
            'designation' => $validatedData['designation'],
            'description' => $validatedData['description'],
            'slug' => Str::slug($validatedData['name']),
            'is_active' => $request->is_published  ? 1 : 0,
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            // Clear the old images from the media collection
            $testinomial->clearMediaCollection('images');  // This removes all images in the 'images' collection

            // Add the new image to the media collection
            $testinomial->addMedia($request->file('image'))->toMediaCollection('images');
        }
        // Redirect with success message
        return redirect()->route('testinomial.index')->with('success', 'Testinomial updated successfully!');
    }

    public function destroy($id){
        $testinomial = Testinomial::findOrFail($id);
        $testinomial->delete();
        return redirect()->back()->with('success', 'Testinomial Deleted successfully!');
    }
}
