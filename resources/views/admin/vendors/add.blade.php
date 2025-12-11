@extends('admin.layout')



@section('content')



<div class="content-wrapper">

    <section class="content-header">
        <h1>Add Vendor</h1>
        <ol class="breadcrumb">

            <li>

                <a href="{{ asset('admin/vendors/display/') }}">

                    Back

                </a>

            </li>

        </ol>

    </section>  

    <section class="content">

        <div class="box">

            @if(session()->has('success'))
            
            <div class="box-info">

                <div class="alert alert-success">

                    {{ session()->get('success') }}

                </div>

            </div>
            @endif


            {!! Form::open(array('url' =>'admin/vendors/add/','autocomplete' => 'false' , 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}

            <div class="box-body">

                <div class="row">

                    <h2 class="mt-3">User Data</h2>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="name" class="control-label mb-1">User First Name</label>

                            <input type="text" name="first_name" class="form-control" required> 

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="name" class="control-label mb-1">User Last Name</label>

                            <input type="text" name="last_name" class="form-control" required> 

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="name" class="control-label mb-1">User Email</label>

                            <input type="email" autocomplete="false" name="email" class="form-control" required> 

                        </div>

                    </div>

                    <div class="col-md-4 mt-3">

                        <div class="form-group">

                            <label for="name" class="control-label mb-1">Phone</label>

                            <input type="tel" autocomplete="false" name="phone" class="form-control" required> 

                        </div>

                    </div>

                    <div class="col-md-4 mt-3">

                        <div class="form-group">

                            <label for="name" class="control-label mb-1">User Password</label>

                            <input type="password" autocomplete="false" name="password" class="form-control" required> 

                        </div>

                    </div>

                    <div class="col-md-4 mt-3">

                        <div class="form-group">

                            <label for="name" class="control-label mb-1">Confirm Password</label>

                            <input type="password" autocomplete="false" name="confirmpassword" class="form-control" required> 

                        </div>

                    </div>

                    <h2 class="mt-3">Vendor Data</h2>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="name" class="control-label mb-1">Vendor Name</label>

                            <input type="text" name="meta[vendor_name]" class="form-control" required> 

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="name" class="control-label mb-1">Email</label>

                            <input type="email" name="meta[vendor_email]" class="form-control" required>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="name" class="control-label mb-1">Phone</label>

                            <input type="number" name="meta[vendor_phone]" class="form-control" required>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="form-group mt-3">

                            <label for="name" class="control-label  mb-1">Bank Name</label>

                            <input type="text" name="meta[vendor_bank_name]" class="form-control" required>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group mt-3">

                            <label for="name" class="control-label  mb-1">Account Number</label>

                            <input type="text" name="meta[vendor_acc_number]" class="form-control" required>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group mt-3">

                            <label for="name" class="control-label  mb-1">Store Name</label>

                            <input type="text" name="meta[store_name]" class="form-control" required>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group mt-3">

                            <label for="name" class="control-label  mb-1">Store Address</label>

                            <input type="text" name="meta[address]" value="" required class="form-control">

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="form-group mt-3">


                            <label for="" class="control-label mb-1">Status</label>

                            <select name="meta[approved]"  class="form-control" required>
                                <option value="0">Not Approved</option>
                                <option value="1">Approved</option>
                            </select>

                        </div>

                    </div>
                    
                    <div class="col-md-4"></div>

                    <div class="col-md-4">

                        <div class="form-group mt-3">

                            <label for="banner_image" class="control-label mb-1">Banner Image</label>

                            <div class="featuredWrap">

                                <button class="btn uploader featured_image btn-primary" data-type="single">+</button>

                                <input type="hidden" id="banner_image" 

                                name="meta[store_image]" required>

                                <img src="" alt="featured_image" class="w-100 d-none">

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group mt-3">

                            <label for="store_logo_image" class="control-label mb-1">Logo Image</label>

                            <div class="featuredWrap">

                                <button class="btn uploader featured_image btn-primary" data-type="single">+</button>

                                <input type="hidden" id="store_logo_image" 

                                name="meta[store_logo_image]" value="" required>

                                <img src="" alt="featured_image" class="w-100 d-none">

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group mt-3">

                            <label for="store_featured_image" class="control-label mb-1">Featured Image</label>

                            <div class="featuredWrap">

                                <button class="btn uploader featured_image btn-primary" data-type="single">+</button>

                                <input type="hidden" id="store_featured_image" 

                                name="meta[store_featured_image]" value="" required>

                                <img src="" alt="store_featured_image" class="w-100 d-none">

                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="form-group mt-3">

                            <label for="license_registration" class="control-label mb-1">Trade License or Commercial Registration</label>

                            <div class="featuredWrap">

                                <button class="btn uploader featured_image btn-primary" data-type="single">+</button>

                                <input type="hidden" id="license_registration" 

                                name="meta[license_registration]" value="" required>

                                <img src="" alt="license_registration" class="w-100 d-none">

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group mt-3">

                            <label for="vat_registration" class="control-label mb-1">VAT Registration Certificate</label>

                            <div class="featuredWrap">

                                <button class="btn uploader featured_image btn-primary" data-type="single">+</button>

                                <input type="hidden" id="vat_registration" 

                                name="meta[vat_registration]" value="" required>

                                <img src="" alt="vat_registration" class="w-100 d-none">

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group mt-3">

                            <label for="residence_id" class="control-label mb-1">Residence ID or Passport of the legal signatory</label>

                            <div class="featuredWrap">

                                <button class="btn uploader featured_image btn-primary" data-type="multiple">+</button>

                                <input type="hidden" id="residence_id" 

                                name="meta[residence_id]" value="" required>

                                <img src="" alt="residence_id" class="w-100 d-none">

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group mt-3">

                            <label for="residence_visa" class="control-label mb-1">Residence Visa</label>

                            <div class="featuredWrap">

                                <button class="btn uploader featured_image btn-primary" data-type="single">+</button>

                                <input type="hidden" id="residence_visa" 

                                name="meta[residence_visa]" value="" required>

                                <img src="" alt="residence_visa" class="w-100 d-none">

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group mt-3">

                            <label for="bank_confirmation" class="control-label mb-1">Bank Account Confirmation</label>

                            <div class="featuredWrap">

                                <button class="btn uploader featured_image btn-primary" data-type="single">+</button>

                                <input type="hidden" id="bank_confirmation" 

                                name="meta[bank_confirmation]" value="" required>

                                <img src="" alt="bank_confirmation" class="w-100 d-none">

                            </div>

                        </div>

                    </div>

                </div>

                <div class="box-footer text-center">

                    <button type="submit" class="btn btn-primary">Submit</button>

                </div>

            </div>

            {!! Form::close() !!}

        </div>



    </div>

</section>

</div>


@endsection

