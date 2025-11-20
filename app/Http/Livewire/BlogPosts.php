<?php

namespace App\Http\Livewire;

use App\Models\Blogs;
use Livewire\Component;
use Livewire\WithFileUploads;

class BlogPosts extends Component
{
    public $title;
    public $description;
    public $image;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:500',

    ];



    public function createBlog()
    {
        $this->validate();
        dd('hi');

        // Save the image if uploaded
        $imagePath = $this->image ? $this->image->store('blogs', 'public') : null;

        // Save the blog post
        Blogs::create([
            'title' => $this->title,
            'description' => $this->description,
            // 'image' => $imagePath,
        ]);

        // Reset fields
        $this->reset(['title', 'description', 'image']);

        // Optional: Close the modal and send a success message
        $this->dispatchBrowserEvent('modal-hide', ['modalId' => 'createBlogModal']);
        session()->flash('success', 'Blog created successfully!');
    }

    public function render()
    {
        return view('livewire.blogs', [
            'blogs' => Blogs::paginate(10),
        ]);
    }
}
