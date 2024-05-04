@extends('layouts.admin.layout')
@section('title')
    {{__('main.add_face')}}
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/swiper/swiper.min.css') }}" rel="stylesheet" type="text/css" />
    <!--datatable css-->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <!--datatable responsive css-->
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />


    <link rel="stylesheet" href={{asset("assets/css/dropify.css")}}>
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') {{__('main.index')}} @endslot
@slot('title') {{__('main.add_face')}} @endslot
@endcomponent
 <!-- Session Status -->
 <x-auth-session-status class="mb-4" :status="session('status')" />
 <div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-primary flex-grow-1">{{__('main.search_face')}}</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">


                    <!--end col-->
                    <!--grid content-->

                    <div class="row g-2 m-0" >

                        <div class="col-sm-12 border border-1">

                            <form id="search-face" class="bg-white p-2" action="{{ route('admin.searchByFace') }}" method="POST" enctype="multipart/form-data">

                                @csrf

                                <div class="row gx-3 mb-3">
                                    <div class="col-xxl-7 col-sm-7 mb-4">
                                        <div class="search-box">
                                            <input type="text" name="filter_search_key" id="filter_search_key" class="form-control search" placeholder="{{__('main.search')}}">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                    <div class="col-xxl-5 col-sm-5 mb-4">
                                        <div class="d-flex">
                                            {{-- <button type="button" id="add_image" class="btn btn-primary w-100 mx-1" ><i class="ri-image-add-line me-1 align-bottom"></i> {{__('main.add_face')}}</button> --}}
                                            <button type="button" id="search_filter" class="btn btn-primary w-100 mx-1" ><i class="ri-search-line me-1 align-bottom"></i> {{__('main.find_by_uuid')}}</button>
                                            {{-- <button type="button" id="reset_filter" class="btn btn-success w-100 mx-1"><i class="ri-refresh-line me-1 align-bottom"></i> {{__('main.reset')}}</button> --}}
                                        </div>
                                    </div>
                                    <div class="col-sm-7 ">
                                        <div class="mb-4">
                                            <input type="file" class="form-control" id="image" name="image">
                                        </div>
                                        <div class=" d-flex justify-content-around">
                                            <label class="form-check-label ">
                                                <input type="radio" class="" name="uploadOption" value="fromComputer" checked>
                                                {{__('main.upload_from_pc')}}
                                            </label>
                                            <br>
                                            <label class="form-check-label">
                                                <input type="radio" name="uploadOption" value="fromWebcam">
                                                {{__('main.take_picture')}}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 ">
                                        <!-- Display image preview -->
                                        <div class="hstack gap-2 justify-content-end">
                                            <button id="search-face-submit-button" class="btn btn-primary w-100 mx-1"  type="submit"><i class="ri-image-add-line me-1 align-bottom"></i> {{__('main.find_by_image')}}</button>
                                        </div>
                                        <div class="image-preview-container bg-light text-center border m-2 border-info border-2">
                                            <h4>{{__('main.image_preview')}}</h4>
                                            <img id="imagePreview" class="d-none mb-2" width="150px" height="150px"  src="" alt="{{__('main.invalid_image')}}">
                                            <div class="d-flex justify-content-around align-items-end">
                                                <video id="webcamStream" class="w-50" autoplay></video>

                                            </div>
                                            <button class="d-none btn btn-primary m-1" id="captureButton">{{__('main.capture')}}</button>
                                        </div>

                                        <input type="hidden" id="webCapturedImage" name="webCapturedImage" src="" value="">

                                    </div>

                                    <div class="col-sm-5">

                                    </div>
                                </div>
                            </form>
                    </div>
                    </div>

                    <div class="row " id="imageContainer">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')

<script>

     $(document).on('click','.downloadButton',function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        var parentDiv = $(this).closest('.card');
        var imgSrc = parentDiv.find('img').attr('src');
        var downloadLink = document.createElement('a');
        downloadLink.href = imgSrc;
        let imageExtension = imgSrc.split(";")[0].split("/")[1];
        downloadLink.download = (Math.random() + 1).toString(36).substring(2)+'.'+imageExtension;
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
    });

    $(document).ready(function() {

    // Append the link to the download button
    $(document).on('click','.downloadButton',function(e){
        var parentDiv = $(this).closest('.card');
        var imgSrc = parentDiv.find('img').attr('src');
        var downloadLink = document.createElement('a');
        downloadLink.href = imgSrc;
        downloadLink.download = 'my_image.png';
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
    });

    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    $('#search-face').submit(function(e) {
        e.preventDefault();
        $('#search-face-submit-button').prop('disabled', true);
        var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "{{ route('admin.searchByFace') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#imageContainer').empty();
                $('#search-face-submit-button').prop('disabled', false);
                if(response.status === 0 || response.status === -1){
                    Swal.fire({
                    icon: 'error',
                    title: response.message,
                    });
                }else{
                    Swal.fire({
                    icon: 'success',
                    title: response.message,
                    });
                    response.data.snapped_images.forEach(function(base64Image, index) {
                        let div = `
                            <div class="col-2">
                                <div class="card border border-1 border-info m-2 p-4 position-relative" >
                                    <img  src="data:image/png;base64,${base64Image}" alt="Snapped Face ${index + 1}">

                                        <button style="color:black;position:absolute;bottom:80%;left:80%;" class="btn downloadButton"><span><i class=" ri-download-cloud-2-line"></i></span></button>

                                </div>
                            </div>`;
                        document.getElementById('imageContainer').insertAdjacentHTML('beforeend', div);
                    });

                }
            }
        });
    });

    $('#search_filter').click(function (e) {
        e.preventDefault();
        $(this).prop('disabled', true);
        let searchField = $('#filter_search_key').val();
        $.ajax({
            type: "POST",
            url: "{{ route('admin.searchByField') }}",
            data: {searchField:searchField},
            success: function(response) {
                $('#search_filter').prop('disabled', false);
                $('#imageContainer').empty();
                if(response.status === 0 || response.status === -1){
                    Swal.fire({
                    icon: 'error',
                    title: response.message,
                    });
                }else{
                    Swal.fire({
                    icon: 'success',
                    title: response.message,
                    });

                    response.data.forEach(function(base64Image, index) {
                        let div = `
                            <div class="col-2">
                                <div class="card border border-1 border-info m-2  position-relative" >
                                    <img  src="${base64Image}" alt="Snapped Face ${index + 1}">

                                        <button style="color:black;position:absolute;bottom:80%;left:80%;" class="btn downloadButton"><span><i class=" ri-download-cloud-2-line"></i></span></button>

                                </div>
                            </div>`;
                        document.getElementById('imageContainer').insertAdjacentHTML('beforeend', div);
                   });

                }

            }
        });
    });

    var imageInput = $('#image');
    var webcamStream = $('#webcamStream');
    var captureButton = $('#captureButton');
    var imagePreview = $('#imagePreview');
    var webCapturedImage = $('#webCapturedImage');


   // Handle radio button change
    $('input[name="uploadOption"]').change(function() {
        if ($(this).val() === 'fromWebcam') {
            activateWebcam();
        } else {
            deactivateWebcam();
        }
    });

    // Activate webcam
    function activateWebcam() {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function(stream) {
                imagePreview.prop('src', '');
                imagePreview.addClass('d-none');
                webcamStream.removeClass('d-none');
                webcamStream.prop('srcObject', stream);
                captureButton.removeClass('d-none');
            })
            .catch(function(error) {
                console.error('Error accessing webcam:', error);
            });
    }

    // Deactivate webcam
    function deactivateWebcam() {
        var stream = webcamStream.prop('srcObject');
        if (stream) {
            var tracks = stream.getTracks();
            tracks.forEach(function(track) {
                track.stop();
            });
            webcamStream.prop('srcObject', null);
            captureButton.addClass('d-none');
            webcamStream.prop('srcObject', '');
            webcamStream.addClass('d-none');
        }
    }

    // Handle file selection from computer
    imageInput.change(function() {
        var selectedFile = $(this).prop('files')[0];
        if (selectedFile) {
            webcamStream.addClass('d-none');
            imagePreview.removeClass('d-none');
            imagePreview.prop('src', URL.createObjectURL(selectedFile));
        }
    });

    // Handle capture button click (from webcam)
    captureButton.click(function(e) {
        e.preventDefault();
        var canvas = $('<canvas></canvas>')[0];
        var context = canvas.getContext('2d');
        canvas.width = webcamStream.prop('videoWidth');
        canvas.height = webcamStream.prop('videoHeight');
        context.drawImage(webcamStream[0], 0, 0, canvas.width, canvas.height);
        var capturedImage = canvas.toDataURL('image/jpeg');
        webcamStream.addClass('d-none');
        webCapturedImage.prop('value', capturedImage);
        imagePreview.removeClass('d-none');
        imagePreview.prop('src', capturedImage);
        deactivateWebcam();
    });
});

</script>
@endsection

