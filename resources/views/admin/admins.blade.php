@extends('layouts.master')
@section('title')
@lang('translation.users')
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1')
Users
@endslot
@slot('title')
Admin List
@endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card" id="ticketsList">
            <div class="card-header border-0">
                <div class="d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1">Admins</h5>
                    <div class="flex-shrink-0">
                        <div class="d-flex flex-wrap gap-2">
                            <button class="btn btn-danger add-btn" data-bs-toggle="modal" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add User</button>
                            <button class="btn btn-success" id="remove-actions" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body border border-dashed border-end-0 border-start-0">
                
            </div>
            <!--end card-body-->
            <div class="card-body">
                <div class="table-responsive table-card mb-4">
                    <table class="table align-middle table-nowrap mb-0" id="ticketTable">
                        <thead>
                            <tr>
                                <th class="sort" data-sort="name">Name</th>
                                <th class="sort" data-sort="email">Email</th>
                                <th class="sort" data-sort="phone">Phone</th>
                                <th class="sort" data-sort="action">Action</th>
                            </tr>
                        </thead>
                        <tbody class="list form-check-all" id="ticket-list-data">
                            @foreach($users as $key => $user)
                            <tr>
                                <td class="name">{{ $user->name }}</td>
                                <td class="email">{{ $user->email }}</td>
                                <td class="phone">{{ $user->phone }}</td>
                                <td>
                                    <button class="btn btn-soft-secondary" type="button" href="#show{{ $user->id }}" data-bs-toggle="modal">
                                        <i class="ri-eye-fill align-middle"></i>
                                    </button>
                                    <button class="btn btn-soft-danger" type="button" data-bs-toggle="modal" href="#delete{{ $user->id }}">
                                        <i class="ri-delete-bin-fill align-middle"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="noresult" style="display: none">
                        <div class="text-center">
                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                            </lord-icon>
                            <h5 class="mt-2">Sorry! No Result Found</h5>
                            <p class="text-muted mb-0">We've searched and We did not find any
                                User for you search.</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-2">
                    <div class="pagination-wrap hstack gap-2">
                        <a class="page-item pagination-prev disabled" href="#">
                            Previous
                        </a>
                        <ul class="pagination listjs-pagination mb-0"></ul>
                        <a class="page-item pagination-next" href="#">
                            Next
                        </a>
                    </div>
                </div>

                <!-- Modal -->
                

                @foreach($users as $key => $user)
                <div class="modal fade" id="delete{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            
                            <div class="modal-body p-5 text-center">
                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px">
                                </lord-icon>
                                <div class="mt-4 text-center">
                                    <h4>Delete user: {{ $user->name }}?</h4>
                                    <p class="text-muted fs-14 mb-4">Deleting user will remove all of
                                        user information from our database.</p>
                                    <div class="hstack gap-2 justify-content-center remove">
                                        <button class="btn btn-link link-success fw-medium text-decoration-none" data-bs-dismiss="modal" d="deleteRecord-close"><i class="ri-close-line me-1 align-middle"></i>
                                            Close</button>
                                            <form method="POST" action="{{ route('users.destroy',$user->id) }}" id="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                <button type="submit" class="btn btn-danger">Yes, Delete It</button>
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!--end modal -->
            </div>
            <!--end card-body-->
        </div>
        <!--end card-->
    </div>
    <!--end col-->
</div>
<!--end row-->

<div class="modal fade" id="showModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createNewUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-info-subtle">
                <h5 class="modal-title">Create New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form method="POST" action="{{ route('users.store') }}" id="create-form">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-4">
                            <div>
                                <label class="form-label">Number</label>
                                <input type="text" class="form-control" name="invitation_number" value="0" required readonly/>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div>
                                <label for="tasksTitle-field" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="client_nameName-field" class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="assignedtoName-field" class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="assignedtoName-field" class="form-label">City</label>
                                <input type="text" class="form-control" name="city" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="priority-field" class="form-label">Priority</label>
                            <select class="form-control" data-plugin="choices" name="invitation_type">
                                <option value="REGULER" selected>REGULER</option>
                                <option value="VIP">VIP</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label for="ticket-status" class="form-label">Status</label>
                            <select class="form-control" data-plugin="choices" name="invitation_status">
                                <option value="0">Not Present</option>
                                <option value="1">Present</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label for="ticket-status" class="form-label">Is Admin</label>
                            <select class="form-control" data-plugin="choices" name="is_admin">
                                <option value="0" disabled>NO</option>
                                <option value="1" selected>YES</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($users as $key => $user)
<div class="modal fade" id="show{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-info-subtle">
                <h5 class="modal-title">Update User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form method="POST" action="{{ route('users.update',$user->id) }}" id="update-form">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $user->id }}">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-4">
                            <div>
                                <label class="form-label">Number</label>
                                <input type="text" class="form-control" name="invitation_number" value="{{ $user->invitation_number }}" readonly />
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div>
                                <label for="tasksTitle-field" class="form-label">Name</label>
                                <input type="text" id="tasksTitle-field" class="form-control" name="name" value="{{ $user->name }}" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="client_nameName-field" class="form-label">Email</label>
                                <input type="text" id="client_nameName-field" class="form-control" name="email" value="{{ $user->email }}" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="assignedtoName-field" class="form-label">Phone</label>
                                <input type="text" id="assignedtoName-field" class="form-control" name="phone" value="{{ $user->phone }}" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="assignedtoName-field" class="form-label">City</label>
                                <input type="text" id="assignedtoName-field" class="form-control" name="city" value="{{ $user->city }}" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="priority-field" class="form-label">Priority</label>
                            <select class="form-control" data-plugin="choices" name="invitation_type" id="priority-field">
                                @if($user->invitation_type=='REGULER')
                                <option value="REGULER" selected>REGULER</option>
                                <option value="VIP">VIP</option>
                                @else
                                <option value="REGULER">REGULER</option>
                                <option value="VIP" selected>VIP</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label for="ticket-status" class="form-label">Status</label>
                            <select class="form-control" data-plugin="choices" name="invitation_status" id="ticket-status">
                                <option value="0">Not Present</option>
                                <option value="1">Present</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label for="ticket-status" class="form-label">Is Admin</label>
                            <select class="form-control" data-plugin="choices" name="is_admin">
                                @if($user->is_admin==0)
                                <option value="0" selected>NO</option>
                                <option value="1">YES</option>
                                @else
                                <option value="0">NO</option>
                                <option value="1" selected>YES</option>
                                @endif
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" onclick="event.preventDefault(); document.getElementById('update-form').submit();">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
@section('script')
<script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/list.pagination.js/list.pagination.min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/ticketlist.init.js') }}"></script>
<script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
