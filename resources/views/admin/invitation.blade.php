@extends('layouts.master-without-nav')
@section('title')
@lang('Verify User Invitation')
@endsection
@section('content')

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
                    {{-- <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center mt-sm-5 mb-4 text-white-50">
                                <div>
                                    <a href="index" class="d-inline-block auth-logo">
                                        <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="20">
                                    </a>
                                </div>
                                <p class="mt-3 fs-15 fw-medium">Premium Admin & Dashboard Template</p>
                            </div>
                        </div>
                    </div> --}}
                    <!-- end row -->
                    @auth
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <div class="card mt-4">

                                <div class="card-body p-4">
                                    @if($user->invitation_status==0)
                                    <div class="mb-4">
                                        <div class="avatar-lg mx-auto">
                                            <div class="avatar-title bg-danger-subtle text-primary display-5 rounded-circle">
                                                <i class="ri-mail-line"></i>
                                            </div>
                                        </div>
                                        <h2 class="text-center mt-1">NOT PRESENT</h2>
                                    </div>
                                    @else
                                    <div class="mb-4">
                                        <div class="avatar-lg mx-auto">
                                            <div class="avatar-title bg-success-subtle text-primary display-5 rounded-circle">
                                                <i class="ri-mail-line"></i>
                                            </div>
                                        </div>
                                        <h2 class="text-center mt-1">PRESENT</h2>
                                    </div>
                                    @endif

                                    <div class="p-2 mt-4">
                                        <div class="text-muted text-center mb-4 mx-lg-3">
                                            <h4 class="">Verify User as Present</h4>
                                        </div>

                                        <form action="{{ route('invitation.update',$user->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="row g-1">
                                                <div class="col-lg-4 mb-2">
                                                    <div>
                                                        <label class="form-label">Number</label>
                                                        <input type="text" class="form-control" value="{{ $user->invitation_number }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div>
                                                        <label for="tasksTitle-field" class="form-label">Name</label>
                                                        <input type="text" class="form-control" value="{{ $user->name }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-2">
                                                    <div>
                                                        <label for="client_nameName-field" class="form-label">Email</label>
                                                        <input type="text" class="form-control" value="{{ $user->email }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label for="assignedtoName-field" class="form-label">Phone</label>
                                                        <input type="text" class="form-control" value="{{ $user->phone }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-2">
                                                    <div>
                                                        <label for="assignedtoName-field" class="form-label">City</label>
                                                        <input type="text" class="form-control" value="{{ $user->city }}" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="priority-field" class="form-label">Priority</label>
                                                    <input type="text" class="form-control" value="{{ $user->invitation_type }}" readonly />
                                                </div>
                                            </div>

                                        <div class="mt-3">
                                            @if($user->invitation_status==0)
                                            <button type="submit" class="btn btn-success w-100">Confirm</button>
                                            @else
                                            <button type="button" class="btn btn-danger w-100" disabled>Already Confirmed</button>
                                            @endif
                                        </div>
                                    </form>
                                    <!-- end form -->
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->

                            {{-- <div class="mt-4 text-center">
                                <p class="mb-0">Didn't receive a code ? <a href="auth-pass-reset-basic" class="fw-semibold text-primary text-decoration-underline">Resend</a> </p>
                            </div> --}}

                        </div>
                    </div>
                    @endauth

                    @guest
                    <div class="row justify-content-center">
                        <div class="col-12 col-xxl-6">
                            <div class="card card-height-100">
                                <div class="card-body">
                                    <div class="mx-auto" style="max-width: 400px">
                                        <div class="p-4 rounded-3 mb-3" style="background: url('{{ asset('build/images/bg-ungu-emas.jpg') }}') no-repeat center center; background-size: cover;">
                                            <div class="d-flex">
                                                <div class="flex-grow-1 text-light text-center">
                                                    <h4 class="text-warning mb-0">Syukuran Kemenangan KDM</h4>
                                                    <h5 class="text-light mb-2">Bersama KeEmasan45</h5>
                                                    <img src="{{ asset('build/images/logo-keemasan.png') }}" width="100" class="mb-2">
                                                </div>
                                                <div class="flex-shrink-0 text-light">
                                                    {{-- <img src="{{ Storage::url('invitation/'.$user->invitation_qr) }}" width="75"> --}}
                                                </div>
                                            </div>
                                            <div class="card-number fs-20 text-light mt-4 text-center" id="card-num-elem">
                                                {{ strtoupper($user->name) }}
                                            </div>
                                            <div class="card-number fs-16 text-light mt-0 text-center" id="card-num-elem">
                                                {{ strtoupper($user->city) }}
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
                                                        <img src="{{ Storage::url('invitation/'.$user->invitation_qr) }}" width="75">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card div elem -->
                                    </div>
                                    <span class="text-muted">* tunjukan undangan ini kepada petugas kami untuk masuk ke acara.</span>
                                    <a href="https://api.whatsapp.com/send?text=Undangan%20Grand%20Launching%20Keemasan45.%20Berikut%20adalah%20link%20undangan%20untuk%20Anda.%20{{ $user->invitation_link }}" class="btn btn-success w-100 mt-3" type="submit"><i class="ri-whatsapp-line me-1 align-middle"></i> Share</a>
                                    <!-- end card form elem -->
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                
                    </div>
                    @endguest
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
                            {{-- <div class="text-center">
                                <p class="mb-0 text-muted">&copy; <script>document.write(new Date().getFullYear())</script> KeEmasan. Crafted with <i class="mdi mdi-heart text-danger"></i> by IT Division</p>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->
        </div>
        <!-- end auth-page-wrapper -->


@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/particles.js/particles.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/particles.app.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/two-step-verification.init.js') }}"></script>
@endsection
