<?php

namespace App\Http\Controllers\Livewire;

use App\Models\Partner;
use App\Models\AppModule;
use App\Models\VendorType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OurPartnerController extends Controller
{
    public function index(Request $request){
        $query = Partner::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('restaurant_name', 'like', "%{$search}%")
                ->orWhere('owner_name', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%");
        }

        $partners = $query->latest()->paginate(10);
        return view('livewire.partners.index',compact('partners'));
    }

    public function destroy($id){
        $blog = Partner::findOrFail($id);
        $blog->delete();
        return redirect()->back()->with('success', 'Partner Deleted successfully!');
    }
}
