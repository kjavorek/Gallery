@extends('layouts.app')

@section('content')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ url('/form') }}" enctype="multipart/form-data">
        
        <div>
            <h2 class="addImgTitle">Uredi podatke i objavi fotku</h2>
            <button type="submit" name="button" value="submit" class="btn btn-primary btnSubmit">Objavi</button>
        </div>

        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        
        <div class="form-group displayInline">
            <img id="preview" src="../storage/app/tmp/<?php echo $imgName ?>" alt="Image" />
        </div>
        
        <input type="hidden" name="user" value="<?php echo $user=Auth::user()->id;?>"/>
        <input type="hidden" name="img" value="<?php echo $imgName ?>"/>
        
        <div class="form-group showRight">
        <table>
            <tr>
                <th>Filteri</th>
            </tr>
            <tr>
                <td><button class="filterBtn" type="submit" name="button" value="antique"><img class="filterImg" src="filter/antique.jpg" /></button></td>
                <td><button class="filterBtn" type="submit" name="button" value="blur"><img class="filterImg" src="filter/blur.jpg" /></button></td>
                <td><button class="filterBtn" type="submit" name="button" value="chrome"><img class="filterImg" src="filter/chrome.jpg" /></button></td>
                <td><button class="filterBtn" type="submit" name="button" value="monopin"><img class="filterImg" src="filter/monopin.jpg" /></button></td>
                </tr>
                <tr>
                <td><button class="filterBtn" type="submit" name="button" value="retro"><img class="filterImg" src="filter/retro.jpg" /></button></td>
                <td><button class="filterBtn" type="submit" name="button" value="velvet"><img class="filterImg" src="filter/velvet.jpg" /></button></td>
                <td><button class="filterBtn" type="submit" name="button" value="blackWhite"><img class="filterImg" src="filter/blackWhite.jpg" /></button></td>
                <td><button class="filterBtn" type="submit" name="button" value="boost"><img class="filterImg" src="filter/boost.jpg" /></button></td>
                </tr>
                <tr>
                <td><button class="filterBtn" type="submit" name="button" value="dreamy"><img class="filterImg" src="filter/dreamy.jpg" /></button></td>
                <td><button class="filterBtn" type="submit" name="button" value="sepia"><img class="filterImg" src="filter/sepia.jpg" /></button></td>
                <td><button class="filterBtn" type="submit" name="button" value="synCity"><img class="filterImg" src="filter/synCity.jpg" /></button></td>
                <td><button class="filterBtn" type="submit" name="button" value="noFilter"><img class="filterImg" src="filter/no.jpg" /></button></td>
            </tr>
 <!--        <button class="filter" type="submit" name="button" value="a1"><img src="green-elephant.jpg" /></button>
            <button class="filter" type="submit" name="button" value="a2"><img src="green-elephant.jpg" /></button>-->
        </table>
            <br>
            <label for="description">Opis</label>
            <textarea id="description" name="description" placeholder="" class="form-control"></textarea>
            <br>
            <label>Privatnost</label><br />
            <label class="radio-inline" for="public">
                <input type="radio" name="isPublic" id="public" value="1"/>Public
            </label>
            <label class="radio-inline" for="private">
                <input type="radio" name="isPublic" id="private" value="0"/>Private
            </label>
        </div>

    </form>

@endsection
