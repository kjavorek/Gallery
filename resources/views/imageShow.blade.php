@extends('layouts.app')

@section('content')

    <div class="page-header">
        <?php foreach($foto as $k=>$v): ?>
            <?php $imagePath=($v["url_1080"]); ?>
        <?php endforeach; ?>
        <?php foreach($user as $k=>$v): ?>
            <h1><?php echo $v["name"]?></h1>
        <?php endforeach; ?>
        <img class="chosenImg" src="../storage/app/<?php echo $imagePath ?>" alt="Image" />
    </div>
@endsection