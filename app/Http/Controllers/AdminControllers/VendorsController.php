<?php

namespace App\Http\Controllers\AdminControllers;



use App\Http\Controllers\Controller;



use App\Models\Web\Users;

use App\Models\Web\Usermeta;

use App\Models\Core\Images;

use App\Models\Core\Products;

use App\Models\Web\Index;

use App\Models\Core\Setting;

use Illuminate\Http\Request;

use DB;

use Hash;


class VendorsController extends Controller

{



    public function display()

    {

        $data = Users::where('role_id',4)->paginate(15);

        $data ? $data = $data->toArray() : '';

        foreach( $data['data'] as &$item ) :

            $item['meta'] = Usermeta::getMeta($item['id']);

        endforeach;

        return view("admin.vendors.index", ['pageTitle' => 'Vendors'])->with('data', $data);

    }

    public function add(){


        return view("admin.vendors.add", ['pageTitle' => 'Vendors']);

    }

    public function insert(Request $request){

        $data = $request->all();

        dd($data);
        
        $num = rand(0,100);

        $username = $data['first_name'].'_'.$data['last_name'].$num;

        $check = Users::where('user_name',$username)->first();

        if( $check ):

            $num = rand(0,100);

            $username = $data['first_name'].'_'.$data['last_name'].$num;

        endif;

        $arr = [

            'user_name' => strtolower($username),

            'role_id' => 4,

            'first_name' => $data['first_name'],

            'last_name' => $data['last_name'],

            'email' => $data['email'],
        ];

        if( isset( $data['password'] ) ) :

            if( isset( $data['confirmpassword'] ) && $data['confirmpassword'] == $data['password'] ) :

                $arr['password'] = Hash::make( $data['password'] ); unset( $data['confirmpassword']);

            else :

                return redirect()->back()->with('success','Confirm Password empty or mismatch!');

            endif;

        endif;

        $user = Users::create( $arr);

        foreach($data['meta'] as $key => $val ) :

            Usermeta::updateOrCreate(['meta_key' => $key,'user_id' => $user->id],[

                'user_id' => $user->id,
                'meta_key' => $key,
                'meta_value' => $val
            ]);

        endforeach;

        return redirect('admin/vendors/display');

    }

    public function edit($id){

        $data = Users::where('id', $id )->first()->toArray();

        $meta = Usermeta::where('user_id',$id)->get();

        $meta ? $meta = $meta->toArray() : '';

        $arr = [];

        foreach($meta as $item) :

            $item['meta_value'] = str_contains($item['meta_key'],'image') ? ['path' => Index::get_image_path( $item['meta_value'] ), 'id' => $item['meta_value'] ] : $item['meta_value'];
            
            str_contains($item['meta_key'],'registration') ? 

            $item['meta_value'] = ['path' => Index::get_image_path( $item['meta_value'] ), 'id' => $item['meta_value'] ] : '';

            if( $item['meta_key'] == 'residence_id' ) :

                $val = explode(',', $item['meta_value']);

                foreach( $val as &$file):

                    $file =  ['path' => Index::get_image_path( $file ) , 'id' =>explode(',',$item['meta_value']) ];

                    $file['path'] = str_contains($file['path'], '.pdf') ? 'images/document.png' : $file['path'];

                endforeach;

                $item['meta_value'] = $val;

            endif;

            $item['meta_key'] == 'bank_confirmation' ? 

            $item['meta_value'] = ['path' => Index::get_image_path( $item['meta_value'] ), 'id' => $item['meta_value'] ] : '';

            $item['meta_key'] == 'residence_visa' ? 

            $item['meta_value'] = ['path' => Index::get_image_path( $item['meta_value'] ), 'id' => $item['meta_value'] ] : '';


            isset($item['meta_value']['path']) && str_contains($item['meta_value']['path'], '.pdf') ? $item['meta_value']['path'] = 'images/document.png' : '';

            $arr[$item['meta_key']] = $item['meta_value'];


        endforeach; 

        $data['metadata'] = $arr;

        // dd($arr);
        return view("admin.vendors.edit", ['pageTitle' => 'Vendors'])->with('data', $data);

    }

    public function update(Request $request)
    {


        $check = $request->all();

        unset($check['_token']);
        unset($check['id']);

        $arr = [

            'first_name' => $check['first_name'],

            'last_name' => $check['last_name'],

            'email' => $check['email'],

            'phone' => $check['phone'],

        ];
        
        if( isset( $check['password'] ) ) :

            if( isset( $check['confirmpassword'] ) && $check['confirmpassword'] == $check['password'] ) :

                $arr['password'] = Hash::make( $check['password'] ); unset( $check['confirmpassword']);unset( $check['password']);

            else :

                return redirect()->back()->with('success','Confirm Password empty or mismatch!');

            endif;

        endif;

        unset($check['first_name']);unset($check['last_name']);unset($check['email']);unset($check['phone']);

        Users::where('id',$request->id)->update($arr);

        Usermeta::where('user_id', $request->id)->delete();

        $data = [];

        if( isset( $check['meta'] ) ) :

            foreach ($check['meta'] as $key => $check_data) :

                $data[] = [
                    'meta_key' => $key,
                    'meta_value' => $check_data,
                    'user_id' => $request->id,
                ];

            endforeach;

            unset( $check['meta'] );

        endif;

        foreach ($check as $key => $check_data) :

            $data[] = [
                'meta_key' => $key,
                'meta_value' => $check_data,
                'user_id' => $request->id,
            ];

        endforeach;

        Usermeta::insert($data);

        $message = "Vendor has been updated successfully";

        return redirect()->back()->with('success', $message);
    }

    public function delete(Request $request){

        Users::where('id',$request->id)->delete();

        Usermeta::where('user_id',$request->id)->delete();

        Products::where('author_id',$request->id)->delete();

        return redirect()->back()->with('success','Vendors Deleted Successfully!');
    }


    public function storesListing(Request $request)
    {
        $title = array('pageTitle' => '');
        $result = array();
        $message = array();
        $store = DB::table('stores')
        ->leftJoin('users', 'users.id', '=', 'stores.vendor_id')
        ->select('stores.*', 'users.user_name')
        ->paginate(20);

        $result['message'] = $message;
        $result['store'] = $store;
        // $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.store.index", $title)->with('result', $result);
    }

    public function updateStatus(Request $request)
    {
     $check=DB::table('stores')->where('id','=',$request->id)->first();
     if($check->status == '1'){
      $status=0;
  }else{
      $status=1;
  }
  DB::table('stores')->where('id','=',$request->id)->update([
      'status'=>$status,
  ]);
  $message='Store Has Been Active';
  return redirect()->back()->withErrors([$message]);

}




}

