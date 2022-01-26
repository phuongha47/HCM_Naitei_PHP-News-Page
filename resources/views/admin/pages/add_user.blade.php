@extends('admin.master_layout')

@section('pageTitle', 'Add User')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('messages.bulletAddUser') }}</h1>
    </div>

    <!-- Content -->
    <div class="row justify-content-center">

        <div class="col-xl-5 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div >
                        <div >
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">{{ __('messages.fillUserInfo') }}</h1>
                                </div>
                                <form class="user">
                                    <div class="form-group">
                                        <input type="username" class="form-control form-control-user"
                                            id="username"
                                            placeholder={{ __('messages.Username') }}>
                                    </div>
                                    <div class="form-group">
                                        <input type="mail" class="form-control form-control-user"
                                            id="mail" 
                                            placeholder={{ __('messages.Mail') }}>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                            id="password" 
                                            placeholder={{ __('messages.Password') }}>
                                    </div>
                                    <a href="#" class="btn btn-primary btn-user btn-block">
                                        {{ __('messages.addThisUser') }} 
                                    </a>
                                    <hr>
                                    
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
