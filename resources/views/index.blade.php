@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>Photos</h1> 
    </div>
<?php $user=Auth::user()->id;?>
    <!--<p><img height=100px; width=100px; src="{{asset('green-elephant.jpg')}}"/></p>-->
 <form method="post" enctype="multipart/form-data">
@if (Auth::user())
<label id="inputPhoto" for="input_photo">Dodaj fotografiju</label>
<input method="post" type="file" id="input_photo" name="input_photo" required/>  
@endif
        <?php foreach($fotografije as $foto): ?>
        <div class="gallery">
            @if (Auth::guest())
            <?php if($foto["isPublic"]):?>
            <img class="allImg" src="../storage/app/<?php echo htmlspecialchars($foto["url_640"]) ?>" alt="Image" />
            <?php endif;?>
            @else
            <?php if($foto["isPublic"]|| $foto["userId"]==$user):?>
            <a href="/Feritgal/public/imageShow?id=<?php echo htmlspecialchars($foto["id"]) ?>">
                <img class="allImg" src="../storage/app/<?php echo htmlspecialchars($foto["url_640"]) ?>" alt="Image" />
            </a>
            <?php endif;?>
            @endif
        </div>
        <?php endforeach; ?>

<!-------------------------------------------------------------------------------------------------------------------------->
<!--Modal for submitting an image upload-->
<div class="modal fade" id="previewModal" 
     tabindex="-1" role="dialog" 
     aria-labelledby="filterModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" 
                data-dismiss="modal" 
                aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" 
              id="filterModalLabel">Izabrana fotografija</h4>
            </div>
            <div class="modal-body">
              <!--<p>Please confirm you would like to add<b><span id="fav-title">The Sun Also Rises</span></b>to your favorites list.</p>-->
                <img id="preview" src="#" alt="Image1" />
            </div>
            <div class="modal-footer">
              <!--<a type="submit" class="btn btn-primary" href="{{ url('/form') }}">Potvrdi</a>-->
              
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <button type="submit" class="btn btn-primary">Potvrdi</button>

            <span class="pull-right">
              <button type="button" class="btn btn-default" data-dismiss="modal">
                Close
              </button>
            </span>
            </div>
          </div>
        </div>
      </div>
</form>
<!-------------------------------------------------------------------------------------------------------------------------->
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
                $('#previewModal').modal('toggle');
                $('#previewModal').modal('show');
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#input_photo").change(function(){
        readURL(this);
    });
</script>

@endsection
