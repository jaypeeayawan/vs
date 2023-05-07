<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Positions;
use Livewire\WithPagination;

class AdminPositionsComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $searchTerm;
    public $positionid;
    public $positionname;
    public $order;

    protected $messages = [
        'positionname.required' => 'Description cannot be empty',
        'positionname.unique' => 'Description already exist',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'positionname' => 'required|unique:positions',
        ]);
    }

    public function store()
    {
        $this->validate([
            'positionname' => 'required|unique:positions',
        ]);

        try{
            $position = new Positions();
            $position->positionname = $this->positionname;
            $position->order = 1;
            $position->save();

            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'type' => 'success',
                'message' => "Position has been created successfully!"
            ]);

            $this->resetInputFields();
            $this->emit('postStored');

        }catch(\Exception $e){
            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'type' => 'error',
                'message' => "Something went wrong while creating department!"
            ]);

            $this->resetInputFields();
            $this->emit('postStored');
        }
    }

    public function fetch($id)
    {
        $position = Positions::where('id', $id)->first();
        $this->positionid = $id;
        $this->positionname = $position->positionname;
        // $this->order = $position->order;
    }

    public function update()
    {
        $this->validate([
            'positionname' => 'required|unique:positions,positionname,' . $this->positionid,
        ]);

        try{
            $position = Positions::find($this->positionid);
            $position->positionname = $this->positionname;
            $position->order = 1;
            $position->save();

            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'type' => 'success',
                'message' => "Position has been updated successfully!"
            ]);

            $this->resetInputFields();
            $this->emit('postUpdated');

        }catch(\Exception $e){
            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'type' => 'error',
                'message' => "Something went wrong while updating department!"
            ]);

            $this->resetInputFields();
            $this->emit('postStored');
        }
    }

    public function delete()
    {
        try{
            if($this->positionid){
                Positions::where('id', $this->positionid)->delete();

                // Set Flash Message
                $this->dispatchBrowserEvent('alert',[
                    'type' => 'success',
                    'message' => "Position has been deleted succesfully!"
                ]);
            }
    
            $this->emit('postDeleted');

        }catch(\Exception $e){
            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'type' => 'error',
                'message' => "Something went wrong while deleting department!"
            ]);
        }
    }

    private function resetInputFields(){
        $this->positionname = '';
    }

    public function cancel()
    {
        // this will remove input validation on modal close
        $this->resetErrorBag(); 
        // this will reset/remove input value on modal close
        $this->resetInputFields(); 
    }

    public function render()
    {
        $pageTitle = 'Position Manager';
        $search = '%' .$this->searchTerm. '%';

        $positions = Positions::where('positionname', 'LIKE', $search)
            ->orderBy('order', 'asc')
            ->paginate(10);

        return view('livewire.admin.admin-positions-component',
            [
                'pageTitle' => $pageTitle,
                'positions' => $positions
            ]
        )
        ->layout('layouts.admin');
    }
}
