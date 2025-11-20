<?php

namespace App\Http\Controllers\Livewire;

use App\Models\ProductFaq;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductFaqController extends Controller
{

    public function create($id)
    {
        $product = Product::findOrFail($id);
        $productFaqs = ProductFaq::where('product_id', $id)->get();
        return view('livewire.product_faq.create', compact('product','productFaqs'));
    }

    public function store(Request $request, $id){
        
        $product = Product::findOrFail($id);

        $validatedData = $request->validate([
            'question' => 'required|string|max:5000',
            'answer' => 'required|string|max:5000',
        ]);

        $productFaq = new ProductFaq();
        $productFaq->user_id = auth()->user()->id;
        $productFaq->product_id = $product->id;
        $productFaq->question = $validatedData['question'];
        $productFaq->answer = $validatedData['answer'];
        $productFaq->save();

        return redirect()->back()->with('success', 'Faq added successfully!');
    }

    public function update(Request $request,$id)
    {
       
    }

    public function destroy(Request $request,$id){
        $productFaq = ProductFaq::findOrFail($id);
        $productFaq->delete();
        return redirect()->back()->with('success', 'Faq deleted successfully!');
    }
}
