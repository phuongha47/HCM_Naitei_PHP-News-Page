@extends('admin.master_layout')

@section('pageTitle', 'Edit User')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('messages.bulletEditProfile') }}</h1>
    </div>

    <div class="row justify-content-center">

        <div class="col-xl-5 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div >
                        <div class="row align-avatar">
                            <img class="avatar-big" src={{ asset($path_to_ui . "img/sample_avt.png") }}>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#change_avatar">
                                {{ __('messages.changeAvatar') }} 
                            </a>
                            <div class="modal fade" id="change_avatar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ __('messages.uploadAvatar') }}</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="edit-avatar" href={{ route('admin.view_profile') }}>
                                                <label for="img">{{ __('messages.selectImage') }}</label>
                                                <input type="file" id="img" name="img" accept="image/*">
                                                <input class="btn btn-primary" type="submit">
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">{{ __('messages.Cancel') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">{{ __('messages.userInfo') }}</h1>
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
                                        {{ __('messages.CONFIRM') }} 
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
