<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Movie;

class MovieComponent extends Component
{
    use WithPagination;

    public $title, $description, $selectedMovie, $isOpen, $search;

    // Reset pagination after search
    protected $paginationTheme = 'bootstrap';

    // Fetch movies with pagination
    public function render()
    {
        $movies = Movie::where('name', 'like', '%' . $this->search . '%')
            ->paginate(10);
        return view('livewire.movie-component', [
            'movies' => $movies
        ]);
    }

    // Open the modal for creating a new movie
    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    // Store a new movie in the database
    public function store()
    {
        $validatedData = $this->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        Movie::create($validatedData);

        session()->flash('message', 'Movie created successfully.');

        $this->resetInputFields();
        $this->closeModal();
    }

    // Open the modal for editing a movie
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        $this->selectedMovie = $movie;
        $this->title = $movie->title;
        $this->description = $movie->description;

        $this->openModal();
    }

    // Update the selected movie in the database
    public function update()
    {
        $validatedData = $this->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $this->selectedMovie->update($validatedData);

        session()->flash('message', 'Movie updated successfully.');

        $this->resetInputFields();
        $this->closeModal();
    }

    // Delete the selected movie from the database
    public function delete($id)
    {
        Movie::find($id)->delete();

        session()->flash('message', 'Movie deleted successfully.');
    }

    // Reset input fields
    private function resetInputFields()
    {
        $this->title = '';
        $this->description = '';
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
