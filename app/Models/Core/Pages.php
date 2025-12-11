<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Models\Core\Content;
use App\Http\Controllers\AdminControllers\AlertController;
use DB;
use Lang;

class Pages extends Model
{

  protected $table = 'pages';

  public static function deletepage($request) {

    self::where('page_id', $request->id)->delete();

    Content::where('page_id',$request->id)->delete();

  }


  public static function addpage()

  {
    $language_id      =   '1';

    $result = array();

    $myVar = new SiteSettingController();
    $result['languages'] = $myVar->getLanguages();

    return $result;
  }




  public static function pageStatus($request)
  {
    if(!empty($request->id)){
      if($request->active=='no'){
        $status = '0';
      }elseif($request->active=='yes'){
        $status = '1';
      }
      DB::table('pages')->where('page_id', '=', $request->id)->update([
        'status'     =>   $status
      ]);
    }

  }


  public static function addnewwebpage($request)
  { 

    $check = $request->all();
    unset( $check[ '_token' ] );

    $check = array_filter($check);

    $slug = str_replace(' ','-' ,trim($request->slug));
    $slug = str_replace('_','-' ,$slug);
    $page_id = DB::table('pages')->insertGetId([
     'slug'          =>   $slug,
     'type'          =>   2,
     'template'       =>   $check['template'],
     'banner_text'   => isset($check['banner_text']) ? $check['banner_text'] : '',
   ]);

// dd($check);
    foreach($check as $key => $value) :
      is_array($value) ? $value = serialize($value) : '';
      
      $content = Content::create([

        'content_key' => $key,

        'content_value' => $value,

        'content_type' =>  $check['template'],

        'page_id' => $page_id,

      ]);

    endforeach;



  }

  public static function editwebpage($request)
  {

    $page = self::where('page_id', $request->id)->first();

    $data = Content::where([[ 'page_id' , $request->id ],['lang',1]])->get();

    $result = ['page_data' => $page , 'content' => $data ]; 

    return $result;
  }

  public static function langData($id,$lang){

    $page = self::where('page_id', $id)->first();

    $data = Content::where([[ 'page_id',$id ],['lang',$lang]])->get();
  
    $result = ['page_data' => $page , 'content' => $data ];     

    return $result;

  }

  public static function updatewebpage($request)
  {

    $check = $request->all();

    $lang = $check['lang'];

    unset( $check[ '_token' ] );

    unset( $check[ 'lang' ] );

    foreach($check as $key => $value) :
      
      is_array($value) ? $value = serialize($value) : '';

      $check2 = Content::where('page_id', $request->page_id)->where('content_key', $key)->where('lang',$lang)->get()->first();

      if( !empty($check2) ) :

        $content = Content::where('page_id', $request->page_id)

        ->where('content_key', $key)->where('lang',$lang)
   
        ->update(['content_value' => $value]);

      else :

        $content = Content::create([

          'page_id' => $request->page_id,

          'content_key' => $key,

          'content_value' => $value,

          'content_type' => $check['template'],

          'lang' => $lang

        ]);   

      endif;


    endforeach;

    $page_id      =   $request->page_id;

    $slug = str_replace(' ','-' ,trim($request->slug));
   
    $slug = str_replace('_','-' ,$slug);

    DB::table('pages')->where('page_id','=',$page_id)

    ->update([
   
      'slug'           =>   $slug,
   
      'type'           =>   2,
   
      'status'         =>   $request->status,
   
      'template'       =>   $check['template'],

      'banner_text'   => isset($check['banner_text']) ? $check['banner_text'] : '',
   
    ]);

  }



  public static function pageWebStatus($request){

    if(!empty($request->id)){

      if($request->active=='no'){

        $status = '0';

      }elseif($request->active=='yes'){

        $status = '1';

      }

      DB::table('pages')->where('page_id', '=', $request->id)->update([

        'status'     =>   $status

      ]);

    }

  }


}
