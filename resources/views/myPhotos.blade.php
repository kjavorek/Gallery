@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1>My Photos</h1> 
</div>
<?php $user=Auth::user()->id;?>

<?php foreach($fotografije as $foto): ?>
<div class="gallery">
    <?php if($foto["userId"]==$user):?>
    <a href="/Feritgal/public/imageShow?id=<?php echo htmlspecialchars($foto["id"]) ?>">
        <img class="allImg" src="../storage/app/<?php echo htmlspecialchars($foto["url_640"]) ?>" alt="Image" />
    </a>
    <?php endif;?>
</div>
<?php endforeach; ?>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

@endsection
