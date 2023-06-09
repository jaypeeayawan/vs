@section('page-title')
    {{ $pageTitle }}
@endsection

<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">

                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ $pageTitle }}</h5>
                <!--end::Page Title-->

                <!--begin::Actions-->
                
                <!--end::Actions-->
            </div>
            <!--end::Info-->

            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">

            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container ">
            <!--begin::Row-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-custom">
                        <div class="card-header flex-wrap border-0 pt-6 pb-0">
                            <div class="card-title">
                                <h3 class="card-label">
                                    List of Candidates
                                </h3>
                            </div>
                            <div class="card-toolbar">
                                <!--begin::Button-->
                                <a href="#" class="btn btn-primary font-weight-bolder" id="new-record" data-toggle="modal" data-target="#new-record-modal">
                                    <span class="svg-icon svg-icon-md">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <circle fill="#000000" cx="9" cy="15" r="6"></circle>
                                                <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3"></path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>	New Record
                                </a>
                                <!--end::Button-->
                            </div>
                        </div>
                        <div class="card-body">
                            
                            <div class="row">
                                <div class="col-md-2 offset-md-5 mb-3">
                                    <select class="form-control" id="alumnus-course" wire:model="searchByPosition">
                                        <option value="">Select Position</option>
                                        @foreach($positions as $position)
                                            <option value="{{ $position->id }}">{{ $position->positionname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <select class="form-control" id="alumnus-course" wire:model="searchByForm">
                                        <option value="">Select Election Form</option>
                                        @foreach($forms as $form)
                                            <option value="{{ $form->id }}">{{ $form->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <input type="text" class="form-control" placeholder="Search..." wire:model="searchTerm">
                                </div>
                            </div>

                            <table class="table table-head-custom table-vertical-center" id="">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Election Form</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($candidates as $candidate)
                                        <tr>
                                            <td>
                                            @if ($candidate->photo)
                                                <div class="symbol symbol-80">
                                                    <img src="{{ asset('photos/photos') }}/{{ $candidate->photo }}" alt="Photo">
                                                </div>
                                            @else
                                                <div class="symbol symbol-80">
                                                    <img src="{{ asset('photos//photos/default.png') }}" alt="Photo">
                                                </div>
                                            @endif
                                        </td>
                                            <td><span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $candidate->lastname }}, {{ $candidate->firstname }} {{ $candidate->middlename }}</span></td>
                                            <td><span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $candidate->positions->positionname }}</span></td>
                                            <td><span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $candidate->electionforms->title }}</span></td>
                                            <td>
                                                <a href="#" class="update-record" wire:click="fetch({{ $candidate->candidatesid }})" data-toggle="modal" data-target="#update-record-modal">
                                                    <i class="fas fa-edit text-primary"></i>
                                                </a>
                                                <a href="#" class="delete-record" wire:click="fetch({{ $candidate->candidatesid }})" data-toggle="modal" data-target="#delete-record-modal">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </a>
                                            </td>
                                        </tr>   
                                    @endforeach
                                </tbody>
                            </table>
                            
                            {{ $candidates->links() }}

                        </div>
                    </div>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->

    <!-- Modal Create -->
    <div wire:ignore.self class="modal fade" id="new-record-modal" tabindex="-1" role="dialog" aria-labelledby="newRecord" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newRecord">Add Candidate</h5>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="store" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="photo">Photo</label>
                            <input type="file" class="input-file" wire:model="photo">
                            @if($photo)
                                <img src="{{ $photo->temporaryUrl() }}" width="120" style="margin-top: 5px;">
                            @endif
                            @error('photo')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="firstname">Firstname</label>
                            <input type="text" class="form-control" id="firstname" placeholder="Enter Firstname" wire:model="firstname">
                            @error('firstname') 
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="middlename">Middlename</label>
                            <input type="text" class="form-control" id="middlename" placeholder="Enter middlename" wire:model="middlename">
                            @error('middlename') 
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="lastname">Lastname</label>
                            <input type="text" class="form-control" id="lastname" placeholder="Enter lastname" wire:model="lastname">
                            @error('lastname') 
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="position">Position</label>
                            <select class="form-control" id="position" wire:model="positionsid">
                                <option value="">Select Position</option>
                                @foreach($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->positionname }}</option>
                                @endforeach
                            </select>
                            @error('positionsid') 
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="electionform">Election Form</label>
                            <select class="form-control" id="electionform" wire:model="electionformsid">
                                <option value="">Select Election Form</option>
                                @foreach($forms as $form)
                                    <option value="{{ $form->id }}">{{ $form->title }}</option>
                                @endforeach
                            </select>
                            @error('electionformsid') 
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary close-modal">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Update -->
    <div wire:ignore.self class="modal fade" id="update-record-modal" tabindex="-1" role="dialog" aria-labelledby="udpateRecord" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="udpateRecord">Update Candidate</h5>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="newphoto">Photo</label>
                            <input type="file" id="newphoto" class="input-file" wire:model="newphoto">
                            @if($newphoto)
                                <img src="{{ $newphoto->temporaryUrl() }}" width="120" style="margin-top: 5px;">
                                @error('newphoto')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            @else
                                <img src="{{ asset('photos/photos') }}/{{ $currentphoto }}" width="120">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="firstname">Firstname</label>
                            <input type="text" class="form-control" id="firstname" placeholder="Enter Firstname" wire:model="firstname">
                            @error('firstname') 
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="middlename">Middlename</label>
                            <input type="text" class="form-control" id="middlename" placeholder="Enter middlename" wire:model="middlename">
                            @error('middlename') 
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="lastname">Lastname</label>
                            <input type="text" class="form-control" id="lastname" placeholder="Enter lastname" wire:model="lastname">
                            @error('lastname') 
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="position">Position</label>
                            <select class="form-control" id="position" wire:model="positionsid">
                                <option value="">Select Position</option>
                                @foreach($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->positionname }}</option>
                                @endforeach
                            </select>
                            @error('positionsid') 
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="electionform">Election Form</label>
                            <select class="form-control" id="electionform" wire:model="electionformsid">
                                <option value="">Select Election Form</option>
                                @foreach($forms as $form)
                                    <option value="{{ $form->id }}">{{ $form->title }}</option>
                                @endforeach
                            </select>
                            @error('electionformsid') 
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary close-modal">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div wire:ignore.self class="modal fade" id="delete-record-modal" tabindex="-1" role="dialog" aria-labelledby="deleteRecord" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteRecord">Delete Candidate</h5>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="delete">
                        <div class="text-danger"><i class="text-danger flaticon-warning"></i> Are your sure?</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger close-modal">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script type="text/javascript">
    window.livewire.on('postStored', () => {
        $('#new-record-modal').modal('hide');
    });
    window.livewire.on('postUpdated', () => {
        $('#update-record-modal').modal('hide');
    });
    window.livewire.on('postDeleted', () => {
        $('#delete-record-modal').modal('hide');
    });
</script>
@endpush
