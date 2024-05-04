@extends('layouts.admin.layout')
@section('title')
    {{ __('main.edit_face')}}
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') {{__('main.edit')}} @endslot
@slot('title') {{__('main.faces')}} @endslot
@slot('link') {{ route('admin.faceList')}} @endslot
@endcomponent
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
        <form method="POST" action="{{route('admin.editFace',['uuid'=>$faceDetails->uuid])}}" enctype="multipart/form-data">
            <div class="row card-header py-3 d-flex align-items-center" style="background: none">
                <h6 class="col-10 m-0 font-weight-bold text-primary flex-grow-1">{{__('main.user_details')}}</h6>

            </div>
            <div class="card-body">
                    @csrf
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="name">{{__('main.full_name')}}</label>
                            <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" type="text" placeholder="{{__('main.Enter your full name')}}" value="{{ $faceDetails->name }}" required autofocus>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="email">{{__('main.email')}}</label>
                            <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" placeholder="{{__('main.Enter email adderss')}} " value="{{ $faceDetails->email }}" readonly>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="phone">{{__('main.phone_number')}}</label>
                            <input class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" type="tel" placeholder="{{__('main.Enter your phone number')}}" value="{{ $faceDetails->phone }}" required autofocus>
                        </div>

                    </div>

                    <button class="btn btn-primary" type="submit">{{__('main.save_changes')}}</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{__('main.user_face_picture')}}</h6>
            </div>
            <div class="card-body">
                <div class="card-body text-center">
                    <img class="rounded-circle mb-2 avater-ext" src="{{!empty($faceDetails->uuid) ? getImageUrlByUuid($faceDetails->uuid): asset("assets/images/faces/user-dummy-img.jpg")}}" style="height: 10rem;width: 10rem;">

                    <button class="btn btn-soft-primary d-none" data-bs-toggle="modal" data-bs-target="#userFaceImageUpdateModal">{{__('main.update_face_image')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.component.modal.user_face_image_update_modal')
@endsection
@section('script')
<script>
$(document).ready(function () {
    $('.dropify').dropify();
});
</script>
@endsection
