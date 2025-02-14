
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('translation.users'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?>
Users
<?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?>
Users List
<?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>

<div class="row">
    <div class="col-xxl-4 col-sm-4">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="fw-medium text-muted mb-0">Total Users</p>
                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="<?php echo e($total); ?>">0</span></h2>
                    </div>
                    <div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-info-subtle text-info rounded-circle fs-4">
                                <i class="ri-ticket-2-line"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div><!-- end card body -->
        </div> <!-- end card-->
    </div>
    <!--end col-->
    <div class="col-xxl-4 col-sm-4">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="fw-medium text-muted mb-0">Presented</p>
                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="<?php echo e($present); ?>">0</span></h2>
                    </div>
                    <div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-success-subtle text-success rounded-circle fs-4">
                                <i class="mdi mdi-account"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div><!-- end card body -->
        </div>
    </div>
    <!--end col-->
    <div class="col-xxl-4 col-sm-4">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="fw-medium text-muted mb-0">Not Present</p>
                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="<?php echo e($not_present); ?>">0</span></h2>
                    </div>
                    <div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-danger-subtle text-danger rounded-circle fs-4">
                                <i class="mdi mdi-timer-sand"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div><!-- end card body -->
        </div>
    </div>
    <!--end col-->
    
</div>
<!--end row-->

<div class="row">
    <div class="col-lg-12">
        <div class="card" id="ticketsList">
            <div class="card-header border-0">
                <div class="d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1">Users</h5>
                    <div class="flex-shrink-0">
                        <div class="d-flex flex-wrap gap-2">
                            <button class="btn btn-danger add-btn" data-bs-toggle="modal" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add User</button>
                            <button class="btn btn-success" id="remove-actions" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body border border-dashed border-end-0 border-start-0">
                <form>
                    <div class="row g-3">
                        <div class="col-xxl-8 col-sm-12">
                            <div class="search-box">
                                <input type="text" class="form-control search bg-light border-light" placeholder="Search for ticket details or something...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <!--end col-->

                        <div class="col-xxl-3 col-sm-4" style="display: none">
                            <input type="text" class="form-control bg-light border-light" data-provider="flatpickr" data-date-format="d M, Y" data-range-date="true" id="demo-datepicker" placeholder="Select date range">
                        </div>
                        <!--end col-->

                        <div class="col-xxl-3 col-sm-12">
                            <div class="input-light">
                                <select class="form-control" data-choices data-choices-search-false name="choices-single-default" id="idStatus">
                                    <option value="" disabled>Status</option>
                                    <option value="all" selected>All</option>
                                    <option value="present">Present</option>
                                    <option value="not present">Not Present</option>
                                </select>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-xxl-1 col-sm-4">
                            <button type="button" class="btn btn-primary w-100" onclick="SearchData();"> <i class="ri-equalizer-fill me-1 align-bottom"></i>
                                Filters
                            </button>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </form>
            </div>
            <!--end card-body-->
            <div class="card-body">
                <div class="table-responsive table-card mb-4">
                    <table class="table align-middle table-nowrap mb-0" id="ticketTable">
                        <thead>
                            <tr>
                                <th class="sort text-center" data-sort="num">Number</th>
                                <th class="sort" data-sort="name">Name</th>
                                <th class="sort" data-sort="city">City</th>
                                <th class="sort" data-sort="phone">Phone</th>
                                <th class="sort" data-sort="status">Status</th>
                                <th class="sort" data-sort="priority">Priority</th>
                                <th class="sort" data-sort="action">Action</th>
                            </tr>
                        </thead>
                        <tbody class="list form-check-all" id="ticket-list-data">
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="id text-center"><a href="javascript:void(0);" onclick="ViewTickets(this)" data-id="<?php echo e($user->invitation_number); ?>" class="fw-medium link-primary"><?php echo e($user->invitation_number); ?></a></td>
                                <td class="name"><?php echo e($user->name); ?></td>
                                <td class="city"><?php echo e($user->city); ?></td>
                                <td class="phone"><?php echo e($user->phone); ?></td>
                                <?php if($user->invitation_status==0): ?>
                                    <td class="status"><span class="badge bg-danger-subtle text-danger text-uppercase">not present</span></td>
                                    <?php else: ?>
                                    <td class="status"><span class="badge bg-success-subtle text-success text-uppercase">present</span></td>
                                        <?php endif; ?>
                                <?php if($user->invitation_type=='VIP'): ?>
                                    <td class="priority"><span class="badge bg-warning text-uppercase"><?php echo e($user->invitation_type); ?></span>
                                    <?php else: ?>
                                    <td class="priority"><span class="badge bg-info text-uppercase"><?php echo e($user->invitation_type); ?></span>
                                        <?php endif; ?>
                                </td>
                                <td>
                                    <button class="btn btn-soft-secondary" type="button" href="#qrcode<?php echo e($user->id); ?>" data-bs-toggle="modal">
                                        <i class="ri-qr-code-line align-middle"></i>
                                    </button>
                                    <button class="btn btn-soft-secondary" type="button" href="#show<?php echo e($user->id); ?>" data-bs-toggle="modal">
                                        <i class="ri-eye-fill align-middle"></i>
                                    </button>
                                    <button class="btn btn-soft-danger" type="button" data-bs-toggle="modal" href="#delete<?php echo e($user->id); ?>">
                                        <i class="ri-delete-bin-fill align-middle"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="modal fade" id="qrcode<?php echo e($user->id); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-5">
                            
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card card-height-100">
                                            <div class="card-body">
                                                <div class="mx-auto" style="max-width: 400px">
                                                    <div class="p-4 rounded-3 mb-3" style="background: url('<?php echo e(asset('build/images/bg-ungu-emas.jpg')); ?>') no-repeat center center; background-size: cover;">
                                                        <div class="d-flex">
                                                            <div class="flex-grow-1 text-light text-center">
                                                                <h4 class="text-warning mb-0">Kemilau KeEmasan45</h4>
                                                                <h5 class="text-light mb-2">Menuju Indonesia Emas</h5>
                                                                <img src="<?php echo e(asset('build/images/logo-keemasan.png')); ?>" width="100" class="mb-2">
                                                            </div>
                                                            <div class="flex-shrink-0 text-light">
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="card-number fs-20 text-light mt-4 text-center" id="card-num-elem">
                                                            <?php echo e(strtoupper($user->name)); ?>

                                                        </div>
                                                        <div class="card-number fs-16 text-light mt-0 text-center" id="card-num-elem">
                                                            <?php echo e(strtoupper($user->city)); ?>

                                                        </div>
                            
                                                        <div class="mt-4"></div>
                                                        <div class="row mt-4 mb-1">
                                                            <div class="col-8">
                                                                <div>
                                                                    <div id="cvc-elem" class="fw-medium fs-14 text-light">
                                                                        Hotel Preanger<br>
                                                                        15 Februari 2025<br>
                                                                        Jam 18.30 s/d selesai
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div>
                                                                    <img src="<?php echo e(Storage::url('invitation/'.$user->invitation_qr)); ?>" width="75">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end card div elem -->
                                                </div>
                            
                                                <a href="https://api.whatsapp.com/send?text=*Kemilau KeEmasan45 Menuju Indonesia Emas.*
                                                Link ini adalah Undangan khusus untuk Anda.
                                                <?php echo e($user->invitation_link); ?>

                                                 Klik dan tunjukan kepada petugas penerima tamu kami ketika menghadiri acara tersebut.
                                                 Terima Kasih." class="btn btn-success w-100 mt-3" type="submit"><i class="ri-whatsapp-line me-1 align-middle"></i> Share</a>
                                                <!-- end card form elem -->
                                            </div>
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!-- end col -->
                            
                                </div>
                                <!-- end row-->
                                <div class="mt-4">
                                    <div class="hstack gap-2 justify-content-center">
                                        <a href="javascript:void(0);" class="btn btn-danger shadow-none" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                                        <a href="<?php echo e($user->invitation_link); ?>" target="_blank" class="btn btn-info"><i class="ri-external-link-line me-1 align-middle"></i> Go to Link</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="modal fade" id="delete<?php echo e($user->id); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            
                            <div class="modal-body p-5 text-center">
                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px">
                                </lord-icon>
                                <div class="mt-4 text-center">
                                    <h4>Delete user: <?php echo e($user->name); ?>?</h4>
                                    <p class="text-muted fs-14 mb-4">Deleting user will remove all of
                                        user information from our database.</p>
                                    <div class="hstack gap-2 justify-content-center remove">
                                        <button class="btn btn-link link-success fw-medium text-decoration-none" data-bs-dismiss="modal" d="deleteRecord-close"><i class="ri-close-line me-1 align-middle"></i>
                                            Close</button>
                                            <form method="POST" action="<?php echo e(route('users.destroy',$user->id)); ?>" id="delete-form">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <input type="hidden" name="id" value="<?php echo e($user->id); ?>">
                                                <button type="submit" class="btn btn-danger">Yes, Delete It</button>
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            <form method="POST" action="<?php echo e(route('users.store')); ?>" id="create-form">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-4">
                            <div>
                                <label class="form-label">Number</label>
                                <input type="text" class="form-control" name="invitation_number" placeholder="1-200" required />
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
                                <option value="0" selected>NO</option>
                                <option value="1" disabled>YES</option>
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

<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="show<?php echo e($user->id); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-info-subtle">
                <h5 class="modal-title">Update User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form method="POST" action="<?php echo e(route('users.update',$user->id)); ?>" id="update-form">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <input type="hidden" name="id" value="<?php echo e($user->id); ?>">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-4">
                            <div>
                                <label class="form-label">Number</label>
                                <input type="text" class="form-control" name="invitation_number" value="<?php echo e($user->invitation_number); ?>" readonly />
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div>
                                <label for="tasksTitle-field" class="form-label">Name</label>
                                <input type="text" id="tasksTitle-field" class="form-control" name="name" value="<?php echo e($user->name); ?>" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="client_nameName-field" class="form-label">Email</label>
                                <input type="text" id="client_nameName-field" class="form-control" name="email" value="<?php echo e($user->email); ?>" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="assignedtoName-field" class="form-label">Phone</label>
                                <input type="text" id="assignedtoName-field" class="form-control" name="phone" value="<?php echo e($user->phone); ?>" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="assignedtoName-field" class="form-label">City</label>
                                <input type="text" id="assignedtoName-field" class="form-control" name="city" value="<?php echo e($user->city); ?>" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="priority-field" class="form-label">Priority</label>
                            <select class="form-control" data-plugin="choices" name="invitation_type" id="priority-field">
                                <?php if($user->invitation_type=='REGULER'): ?>
                                <option value="REGULER" selected>REGULER</option>
                                <option value="VIP">VIP</option>
                                <?php else: ?>
                                <option value="REGULER">REGULER</option>
                                <option value="VIP" selected>VIP</option>
                                <?php endif; ?>
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
                                <option value="0" selected>NO</option>
                                <option value="1" disabled>YES</option>
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
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('build/libs/list.js/list.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/list.pagination.js/list.pagination.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/pages/ticketlist.init.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\undangan\resources\views/admin/users.blade.php ENDPATH**/ ?>