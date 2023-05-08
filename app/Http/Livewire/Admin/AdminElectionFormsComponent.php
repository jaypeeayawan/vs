<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\ElectionForms;
use Livewire\WithPagination;

class AdminElectionFormsComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $searchTerm;
    public $electionformid;
    public $title;
    public $isactive;

    protected $messages = [
        'title.required' => 'Title cannot be empty',
        'title.unique' => 'Title already exist',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'title' => 'required|unique:electionforms',
        ]);
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|unique:electionforms',
        ]);

        try{

            $this->updateFormIsActiveStatus();

            $form = new ElectionForms();
            $form->title = $this->title;
            $form->isactive = 1;
            $form->save();

            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'type' => 'success',
                'message' => "Election form has been created successfully!"
            ]);

            $this->resetInputFields();
            $this->emit('postStored');

        }catch(\Exception $e){
            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'type' => 'error',
                'message' => "Something went wrong while creating election form!"
            ]);

            $this->resetInputFields();
            $this->emit('postStored');
        }
    }

    public function fetch($id)
    {
        $form = ElectionForms::where('id', $id)->first();
        $this->electionformid = $id;
        $this->title = $form->title;
        // $this->isactive = $form->isactive;
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|unique:electionforms,title,' . $this->electionformid,
        ]);

        try{
            $form = ElectionForms::find($this->electionformid);
            $form->title = $this->title;
            $form->isactive = 1;
            $form->save();

            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'type' => 'success',
                'message' => "Election form has been updated successfully!"
            ]);

            $this->resetInputFields();
            $this->emit('postUpdated');

        }catch(\Exception $e){
            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'type' => 'error',
                'message' => "Something went wrong while updating election form!"
            ]);

            $this->resetInputFields();
            $this->emit('postStored');
        }
    }

    public function delete()
    {
        try{
            if($this->electionformid){
                ElectionForms::where('id', $this->electionformid)->delete();

                // Set Flash Message
                $this->dispatchBrowserEvent('alert',[
                    'type' => 'success',
                    'message' => "Election form has been deleted succesfully!"
                ]);
            }
    
            $this->emit('postDeleted');

        }catch(\Exception $e){
            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'type' => 'error',
                'message' => "Something went wrong while deleting election form!"
            ]);
        }
    }

    public function deactivateForm()
    {
        try{
            $this->updateFormIsActiveStatus();

            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'type' => 'success',
                'message' => "Election form has been deactivated successfully!"
            ]);

            $this->resetInputFields();
            $this->emit('postDeactivateForm');

        }catch(\Exception $e){
            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'type' => 'error',
                'message' => "Something went wrong while deactivating election form!"
            ]);

            $this->resetInputFields();
            $this->emit('postDeactivateForm');
        }
    }

    public function activateForm()
    {
        try{
            $this->updateFormIsActiveStatus();

            $form = ElectionForms::find($this->electionformid);
            $form->isactive = 1;
            $form->save();

            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'type' => 'success',
                'message' => "Election form has been activated successfully!"
            ]);

            $this->resetInputFields();
            $this->emit('postActivateForm');

        }catch(\Exception $e){
            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'type' => 'error',
                'message' => "Something went wrong while activating election form!"
            ]);

            $this->resetInputFields();
            $this->emit('postActivateForm');
        }
    }

    private function updateFormIsActiveStatus() {
        ElectionForms::query()->update(['isactive' => 0]);
    }

    private function resetInputFields(){
        $this->title = '';
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
        $pageTitle = 'Election Form Manager';
        $search = '%' .$this->searchTerm. '%';

        $forms = ElectionForms::where('title', 'LIKE', $search)
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.admin.admin-election-forms-component',
            [
                'pageTitle' => $pageTitle,
                'forms' => $forms
            ]
        )
        ->layout('layouts.admin');
    }
}
