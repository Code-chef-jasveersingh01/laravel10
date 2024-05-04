@extends('layouts.admin.layout')
@section('title')
    {{ __('main.view_face')}}
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') {{__('main.view')}} @endslot
@slot('title') {{__('main.face')}} @endslot
@slot('link') {{ route('admin.faceList')}} @endslot
@endcomponent
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-primary flex-grow-1">{{__('main.face_details')}}</h6>
                <div class="flex-shrink-0">
                    <a @if(Auth::user()) class="btn btn-primary edit-item-btn" href="{{route('admin.editFace',['uuid'=>$faceDetails->uuid])}}" @endif ><i class="ri-edit-line fs-16"></i></a>

                    <a href="javascript:void(0)" @if(Auth::user())  class="btn btn-danger remove-item-btn" data-id="{{$faceDetails->uuid}}" @endif
                     ><i class="ri-delete-bin-2-line fs-16"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <td class="font-bold-600" style="width: 25%;">{{ __('main.full_name') }}</td>
                                <td>{{ $faceDetails->name }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold-600" style="width: 25%;">{{ __('main.email') }}</td>
                                <td>{{ $faceDetails->email }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold-600" style="width: 25%;">{{ __('main.phone_number') }}</td>
                                <td>{{ $faceDetails->phone }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{__('main.face_picture')}}</h6>
            </div>
            <div class="card-body">
                <div class="card-body text-center">
                    <img class="rounded-circle mb-2 avater-ext" src="{{!empty($faceDetails->uuid) ? getImageUrlByUuid($faceDetails->uuid): asset("assets/images/face/user-dummy-img.jpg")}}" style="height: 10rem;width: 10rem;">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
$(document).ready(function () {
    $('.dropify').dropify();
});
</script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        $('body').on('click','.remove-item-btn',function(e) {
        e.preventDefault();
        var id = $(this).data("id");
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this face!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                var data = {
                "_token": $('a[name="csrf-token"]').val(),
                "id": id,
                }
                $.ajax({
                type: "DELETE",
                url: "{{ route('admin.destroyFace', '') }}" + "/" + id,
                data: data,
                success: function(response) {
                    swal(response.status, {
                        icon: "success",
                        timer: 3000,
                    })
                    .then((result) => {
                        window.location =
                        '{{ route('admin.faceList') }}'
                    });
                }
                });
            }
            });
        });
    });
</script>
@endsection
