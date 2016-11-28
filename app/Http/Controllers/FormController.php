<?php

namespace App\Http\Controllers;

use File;
use App\Photos;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use PhpAcademy\Image\Filters; 

class FormController extends Controller
{
    public function form()
    {     
        return view('form');
    }
    
    public function preview()
    {
        return view('form',[
            'imgName' => "tmp.jpg"
                ]);
    }
    
    public function antique(){
        $image = Image::make(storage_path('app/tmp/img.jpg'));
        $image->filter(new Filters\AntiqueFilter())
                ->save(storage_path('app/tmp/tmp.jpg'));
        return $this->preview();
    }
    public function blur(){
        $image = Image::make(storage_path('app/tmp/img.jpg'));
        $image->filter(new Filters\BlurFilter())
                ->save(storage_path('app/tmp/tmp.jpg'));
        return $this->preview();
    }
    public function sepia(){
        $image = Image::make(storage_path('app/tmp/img.jpg'));
        $image->filter(new Filters\SepiaFilter())
                ->save(storage_path('app/tmp/tmp.jpg'));
        return $this->preview();
    }
    public function chrome(){
        $image = Image::make(storage_path('app/tmp/img.jpg'));
        $image->filter(new Filters\ChromeFilter())
                ->save(storage_path('app/tmp/tmp.jpg'));
        return $this->preview();
    }
    public function monopin(){
        $image = Image::make(storage_path('app/tmp/img.jpg'));
        $image->filter(new Filters\MonopinFilter())
                ->save(storage_path('app/tmp/tmp.jpg'));
        return $this->preview();
    }
    public function retro(){
        $image = Image::make(storage_path('app/tmp/img.jpg'));
        $image->filter(new Filters\RetroFilter())
                ->save(storage_path('app/tmp/tmp.jpg'));
        return $this->preview();
    }
    public function velvet(){
        $image = Image::make(storage_path('app/tmp/img.jpg'));
        $image->filter(new Filters\VelvetFilter())
                ->save(storage_path('app/tmp/tmp.jpg'));
        return $this->preview();
    }
    public function blackWhite(){
        $image = Image::make(storage_path('app/tmp/img.jpg'));
        $image->filter(new Filters\BlackWhiteFilter())
                ->save(storage_path('app/tmp/tmp.jpg'));
        return $this->preview();
    }
    public function boost(){
        $image = Image::make(storage_path('app/tmp/img.jpg'));
        $image->filter(new Filters\BoostFilter())
                ->save(storage_path('app/tmp/tmp.jpg'));
        return $this->preview();
    }
    public function dreamy(){
        $image = Image::make(storage_path('app/tmp/img.jpg'));
        $image->filter(new Filters\DreamyFilter())
                ->save(storage_path('app/tmp/tmp.jpg'));
        return $this->preview();
    }
    public function synCity(){
        $image = Image::make(storage_path('app/tmp/img.jpg'));
        $image->filter(new Filters\SynCityFilter())
                ->save(storage_path('app/tmp/tmp.jpg'));
        return $this->preview();
    }
    
    public function submit(Request $request)
    {
        //var_dump();exit;
        $btnValue=$request->button;
        if ($btnValue=="antique"){
            return $this->antique();
        }else if ($btnValue=="blur"){
                return $this->blur();
        }else if ($btnValue=="sepia"){
                return $this->sepia();
        }else if ($btnValue=="chrome"){
                return $this->chrome();
        }else if ($btnValue=="monopin"){
                return $this->monopin();
        }else if ($btnValue=="retro"){
                return $this->retro();
        }else if ($btnValue=="velvet"){
                return $this->velvet();
        }else if ($btnValue=="blackWhite"){
                return $this->blackWhite();
        }else if ($btnValue=="boost"){
                return $this->boost();
        }else if ($btnValue=="dreamy"){
                return $this->dreamy();
        }else if ($btnValue=="synCity"){
                return $this->synCity();
        }else if($btnValue=="noFilter"){
                return view('form',[
                    'imgName' => 'img.jpg'
                        ]);
        }else if ($btnValue=="submit"){
                return $this->submitImg($request);
        }
    }

    public function submitImg(Request $request){
        $imgName=$request->img;
        $this->validate($request, [
            'isPublic'     => 'required|max:8',
            'description' => 'max:200'
                ]);
        $fileName_640  = '640_'.time() . '_' . $imgName;
        $fileName_1080  = '1080_'.time() . '_' . $imgName;
        $path='app/tmp/'.$imgName;
        if($request->isPublic){
            $newPath='public/publicImages';
        }else{
            $newPath='privateImages';
        }
        $path_640=$newPath . '/' . $fileName_640;
        $path_1080=$newPath . '/' . $fileName_1080;
        Image::make(storage_path($path))->resize(640, 640)->save(storage_path('app/' . $path_640));
        Image::make(storage_path($path))->resize(1080, 1080)->save(storage_path('app/'. $path_1080));
        if($imgName=='tmp.jpg'){
            File::delete(storage_path('app/tmp/img.jpg'));
        }
        File::delete(storage_path($path));
        /**
         * Save to DB
         */
        $photos = new Photos();
        $photos->isPublic        = $request->isPublic;
        $photos->url_640         = $path_640;
        $photos->url_1080        = $path_1080;
        $photos->description     = $request->description;
        $photos->userId          = $request->user;

        $photos->save();

        return redirect('thankyou');
    }
    
    public function thankyou()
    {
        $gallery= Photos::all();
        return view('index', [
            'fotografije' => $gallery
        ]);
    }

}