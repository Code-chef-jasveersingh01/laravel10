<div class="modal fade" id="userFaceImageUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{__('main.update_face_image')}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form class="form" method="POST" action="{{route('admin.updateFaceImage',['uuid'=>$faceDetails->uuid])}}" id="updateFaceImage" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="file" name="image" required class="dropify" accept="image/png, image/jpeg, image/jpg" data-default-file="{{isset($userDetails->image) && !empty($userDetails->image)? $userDetails->image:''}}">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary " form="updateFaceImage">{{__('main.update')}}</button>
      </div>
    </div>
  </div>
</div>
