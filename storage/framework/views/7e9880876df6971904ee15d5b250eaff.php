
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('Verify User Invitation'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

        <div class="auth-page-wrapper pt-5">
            <!-- auth page bg -->
            <div class="auth-one-bg-position auth-one-bg"  id="auth-particles">
                <div class="bg-overlay"></div>

                <div class="shape">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                        <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                    </svg>
                </div>
            </div>

            <!-- auth page content -->
            <div class="auth-page-content">
                <div class="container">
                    
                    <!-- end row -->
                    <?php if(auth()->guard()->check()): ?>
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <div class="card mt-4">

                                <div class="card-body p-4">
                                    <?php if($user->invitation_status==0): ?>
                                    <div class="mb-4">
                                        <div class="avatar-lg mx-auto">
                                            <div class="avatar-title bg-danger-subtle text-primary display-5 rounded-circle">
                                                <i class="ri-mail-line"></i>
                                            </div>
                                        </div>
                                        <h2 class="text-center mt-1">NOT PRESENT</h2>
                                    </div>
                                    <?php else: ?>
                                    <div class="mb-4">
                                        <div class="avatar-lg mx-auto">
                                            <div class="avatar-title bg-success-subtle text-primary display-5 rounded-circle">
                                                <i class="ri-mail-line"></i>
                                            </div>
                                        </div>
                                        <h2 class="text-center mt-1">PRESENT</h2>
                                    </div>
                                    <?php endif; ?>

                                    <div class="p-2 mt-4">
                                        <div class="text-muted text-center mb-4 mx-lg-3">
                                            <h4 class="">Verify User as Present</h4>
                                        </div>

                                        <form action="<?php echo e(route('invitation.update',$user->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <div class="row g-1">
                                                <div class="col-lg-4 mb-2">
                                                    <div>
                                                        <label class="form-label">Number</label>
                                                        <input type="text" class="form-control" value="<?php echo e($user->invitation_number); ?>" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div>
                                                        <label for="tasksTitle-field" class="form-label">Name</label>
                                                        <input type="text" class="form-control" value="<?php echo e($user->name); ?>" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-2">
                                                    <div>
                                                        <label for="client_nameName-field" class="form-label">Email</label>
                                                        <input type="text" class="form-control" value="<?php echo e($user->email); ?>" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label for="assignedtoName-field" class="form-label">Phone</label>
                                                        <input type="text" class="form-control" value="<?php echo e($user->phone); ?>" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-2">
                                                    <div>
                                                        <label for="assignedtoName-field" class="form-label">City</label>
                                                        <input type="text" class="form-control" value="<?php echo e($user->city); ?>" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="priority-field" class="form-label">Priority</label>
                                                    <input type="text" class="form-control" value="<?php echo e($user->invitation_type); ?>" readonly />
                                                </div>
                                            </div>

                                        <div class="mt-3">
                                            <?php if($user->invitation_status==0): ?>
                                            <button type="submit" class="btn btn-success w-100">Confirm</button>
                                            <?php else: ?>
                                            <button type="button" class="btn btn-danger w-100" disabled>Already Confirmed</button>
                                            <?php endif; ?>
                                        </div>
                                    </form>
                                    <!-- end form -->
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->

                            

                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if(auth()->guard()->guest()): ?>
                    <div class="row justify-content-center">
                        <div class="col-12 col-xxl-6">
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
                                                <div class="col-4 text-end">
                                                    <div>
                                                        <img src="<?php echo e(Storage::url('invitation/'.$user->invitation_qr)); ?>" width="75">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card div elem -->
                                    </div>
                                    <span class="text-muted">* tunjukan undangan ini kepada petugas kami untuk masuk ke acara.</span>
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
                    <?php endif; ?>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>
            <!-- end auth page content -->

            <!-- footer -->
            <footer class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->
        </div>
        <!-- end auth-page-wrapper -->


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('build/libs/particles.js/particles.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/js/pages/particles.app.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/js/pages/two-step-verification.init.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master-without-nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\undangan\resources\views/admin/invitation.blade.php ENDPATH**/ ?>