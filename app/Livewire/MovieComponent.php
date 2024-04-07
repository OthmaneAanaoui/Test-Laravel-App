<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Movie;

class MovieComponent extends Component
{
    use WithPagination;

    // Reset pagination after search
    protected $paginationTheme = 'tailwind';


    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Fetch movies with pagination
    public $search;
    public $isOpen = false;
    public $title;
    public $name;
    public $selectedMovie;

    protected $rules = [
        'title' => 'required',
        'name' => 'required',
    ];

    // Fetch movies with pagination and search
    public function render()
    {
        $movies = Movie::query()
            ->where('title', 'like', '%' . $this->search . '%')
            ->orWhere('name', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.movie-component', [
            'movies' => $movies
        ]);
    }


    // Open the modal for creating a new movie
    public function create()
    {
        $this->resetValidation();
        $this->reset();
        $this->openModal();
    }

    // Store a new movie in the database
    public function store()
    {
        $this->validate();

        Movie::create([
            'title' => $this->title,
            'name' => $this->name,
        ]);

        session()->flash('message', 'Movie created successfully.');

        $this->closeModal();
    }

    // Open the modal for editing a movie
    public function edit($id)
    {
        $this->resetValidation();
        $this->reset();
        $this->selectedMovie = Movie::findOrFail($id);
        $this->title = $this->selectedMovie->title;
        $this->name = $this->selectedMovie->name;
        $this->openModal();
    }

    // Update the selected movie in the database
    public function update()
    {
        $this->validate();

        $this->selectedMovie->update([
            'title' => $this->title,
            'name' => $this->name,
        ]);

        session()->flash('message', 'Movie updated successfully.');

        $this->closeModal();
    }

    // Delete the selected movie from the database
    public function delete($id)
    {
        Movie::findOrFail($id)->delete();

        session()->flash('message', 'Movie deleted successfully.');
    }

    // Open the modal
    public function openModal()
    {
        $this->isOpen = true;
    }

    // Close the modal
    public function closeModal()
    {
        $this->isOpen = false;
    }
}
