@extends('admin.layout')



@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <h1>Edit Vendor</h1>
        <ol class="breadcrumb">

            <li>

                <a href="<?= asset('admin/vendors/display/') ?>">

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

                    <?= session()->get('success') ?>

                </div>

            </div>
            @endif

            {!! Form::open(array('url' =>'admin/vendors/update/', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}

            <div class="box-body">

                <div class="row">

                    <div class="col-md-12">

                        <input type="hidden" name="id" value="<?=$data['id']?>">

                        <h2 class="mt-3">User Data</h2>

                        <div class="row">

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label for="name" class="control-label mb-1">User First Name</label>

                                    <input type="text" name="first_name" class="form-control" value="<?=$data['first_name']?>" required> 

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label for="name" class="control-label  mb-1">User Last Name</label>

                                    <input type="text" name="last_name" value="<?=$data['last_name']?>" class="form-control">

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label for="name" class="control-label mb-1">Email</label>

                                    <input type="email" name="email" class="form-control" value="<?=$data['email']?>" required>

                                </div>

                            </div>

                            <div class="col-md-4 mt-3">

                                <div class="form-group">

                                    <label for="name" class="control-label mb-1">Phone</label>

                                    <input type="number" name="phone" class="form-control" value="<?=$data['phone']?>" required>

                                </div>

                            </div>

                            <div class="col-md-4 mt-3">

                                <div class="form-group">

                                    <label for="name" class="control-label mb-1">Confirm</label>

                                    <input type="password" name="password" class="form-control">

                                </div>

                            </div>

                            <div class="col-md-4 mt-3">

                                <div class="form-group">

                                    <label for="name" class="control-label mb-1">Confirm Password</label>

                                    <input type="password" name="confirmpassword" class="form-control">

                                </div>

                            </div>

                        </div>

                        <h2 class="mt-3">Vendor Data</h2>

                        <div class="row">

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label for="name" class="control-label mb-1">Vendor Name</label>

                                    <?php $name = isset( $data['metadata']['vendor_name'] ) ? $data['metadata']['vendor_name'] : '';?>

                                    <input type="text" name="vendor_name" class="form-control" value="<?=$name?>" required> 

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label for="name" class="control-label mb-1">Email</label>

                                    <?php $email = isset( $data['metadata']['vendor_email'] ) ? $data['metadata']['vendor_email'] : '';?>

                                    <input type="email" name="vendor_email" class="form-control" value="<?=$email?>" required>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label for="name" class="control-label mb-1">Phone</label>

                                    <?php $phone = isset( $data['metadata']['vendor_phone'] ) ? $data['metadata']['vendor_phone'] : '';?>

                                    <input type="number" name="vendor_phone" class="form-control" value="<?=$phone?>" required>

                                </div>

                            </div>


                            <div class="col-md-4">

                                <div class="form-group mt-3">

                                    <label for="name" class="control-label  mb-1">Bank Name</label>

                                    <?php $bank = isset( $data['metadata']['vendor_bank_name'] ) ? $data['metadata']['vendor_bank_name'] : '';?>

                                    <input type="text" name="vendor_bank_name" value="<?=$bank?>" class="form-control" required>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group mt-3">

                                    <label for="name" class="control-label  mb-1">Account Number</label>

                                    <?php $acc = isset( $data['metadata']['vendor_acc_number'] ) ? $data['metadata']['vendor_acc_number'] : '';?>
                                    
                                    <input type="text" name="vendor_acc_number" value="<?=$acc?>" required class="form-control">

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group mt-3">

                                    <label for="name" class="control-label  mb-1">Store Name</label>

                                    <?php $store = isset( $data['metadata']['store_name'] ) ? $data['metadata']['store_name'] : '';?>

                                    <input type="text" name="store_name" value="<?=$store?>" required class="form-control">

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group mt-3">

                                    <label for="name" class="control-label  mb-1">Store Address</label>

                                    <?php $store = isset( $data['metadata']['address'] ) ? $data['metadata']['address'] : '';?>

                                    <input type="text" name="address" value="<?=$store?>" required class="form-control">

                                </div>

                            </div>

                            <div class="col-md-4">
                                <div class="form-group mt-3">


                                    <label for="" class="control-label mb-1">Status</label>

                                    <select name="approved"  class="form-control" required>
                                        <option value="0" <?=isset($data['metadata']['approved']) && ($data['metadata']['approved'] == 0) ? 'selected' : ''?> >Not Approved</option>
                                        <option value="1" <?=isset($data['metadata']['approved']) && ($data['metadata']['approved'] == 1) ? 'selected' : ''?>>Approved</option>
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-4"></div>
                            <div class="col-md-4">

                                <div class="form-group mt-3">

                                    <label for="store_image" class="control-label mb-1">Banner Image</label>

                                    <div class="featuredWrap featured">

                                        <button class="btn uploader featured_image btn-primary" data-type="single">+</button>

                                        <?php $id = isset( $data['metadata']['store_image']['id'] ) ? $data['metadata']['store_image']['id'] : '';?>
                                        <?php $path = isset( $data['metadata']['store_image']['path'] ) ? $data['metadata']['store_image']['path'] : '';?>

                                        <input type="hidden" id="store_image" 

                                        name="store_image" value="<?=$id?>" required>

                                        <img src="<?=asset($path)?>" alt="featured_image" class="w-100 ">

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group mt-3">

                                    <label for="store_logo_image" class="control-label mb-1">Logo Image</label>

                                    <div class="featuredWrap featured">

                                        <button class="btn uploader featured_image btn-primary" data-type="single">+</button>

                                        <?php $id = isset( $data['metadata']['store_logo_image']['id'] ) ? $data['metadata']['store_logo_image']['id'] : '';?>
                                        <?php $path = isset( $data['metadata']['store_logo_image']['path'] ) ? $data['metadata']['store_logo_image']['path'] : '';?>

                                        <input type="hidden" id="store_logo_image" 

                                        name="store_logo_image" value="<?=$id?>" required>

                                        <img src="<?=asset($path)?>" alt="store_logo_image" class="w-100 ">

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group mt-3">

                                    <label for="store_featured_image" class="control-label mb-1">Featured Image</label>

                                    <div class="featuredWrap featured">

                                        <button class="btn uploader featured_image btn-primary" data-type="single">+</button>

                                        <?php $id = isset( $data['metadata']['store_featured_image']['id'] ) ? $data['metadata']['store_featured_image']['id'] : '';?>
                                        <?php $path = isset( $data['metadata']['store_featured_image']['path'] ) ? $data['metadata']['store_featured_image']['path'] : '';?>

                                        <input type="hidden" id="store_featured_image" 

                                        name="store_featured_image" value="<?=$id?>" required>

                                        <img src="<?=asset($path)?>" alt="store_featured_image" class="w-100 ">

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group mt-3">

                                    <label for="license_registration" class="control-label mb-1">Trade License or Commercial Registration</label>

                                    <?php

                                    $id = isset( $data['metadata']['license_registration']['id'] ) ? $data['metadata']['license_registration']['id'] : '';

                                    $path = isset( $data['metadata']['license_registration']['path'] ) ? $data['metadata']['license_registration']['path'] : '';

                                    $c1 = $path == '' ? '' : 'featured';
                                    $c2 = $path == '' ? 'd-none' : '';

                                    ?>

                                    <div class="featuredWrap <?=$c1?>">

                                        <button class="btn uploader featured_image btn-primary" data-type="single">+</button>

                                        <input type="hidden" id="license_registration" 

                                        name="meta[license_registration]" value="<?=$id?>" required>

                                        <img src="<?=asset($path)?>" alt="license_registration" class="w-100 <?=$c2?>">

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group mt-3">

                                    <label for="vat_registration" class="control-label mb-1">VAT Registration Certificate</label>

                                    <?php 

                                    $id = isset( $data['metadata']['vat_registration']['id'] ) ? $data['metadata']['vat_registration']['id'] : '';

                                    $path = isset( $data['metadata']['vat_registration']['path'] ) ? $data['metadata']['vat_registration']['path'] : '';

                                    $c1 = $path == '' ? '' : 'featured';
                                    $c2 = $path == '' ? 'd-none' : '';

                                    ?>
                                    <div class="featuredWrap <?=$c1?>">

                                        <button class="btn uploader featured_image btn-primary" data-type="single">+</button>

                                        <input type="hidden" id="vat_registration" 

                                        name="meta[vat_registration]" value="<?=$id?>" required>

                                        <img src="<?=asset($path)?>" alt="vat_registration" class="w-100 <?=$c2?>">

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group mt-3">

                                    <label for="residence_id" class="control-label mb-1">Residence ID or Passport of the legal signatory</label>

                                    <?php 

                                    $residence = isset( $data['metadata']['residence_id'] ) ? $data['metadata']['residence_id'] : [];

                                    if( empty( $residence ) ) :  ?>

                                        <div class="featuredWrap featured">

                                            <button class="btn uploader featured_image btn-primary" data-type="multiple">+</button>

                                            <input type="hidden" id="residence_id" 

                                            name="meta[residence_id]" value="" required>

                                            <img src="" alt="residence_id" class="w-100 d-none">

                                        </div>

                                        <?php

                                    else : ?>

                                        <div class="featuredWrap featured">

                                            <button class="btn uploader featured_image btn-primary" data-type="multiple">+</button>

                                            <div class="row justify-content-center align-items-center">

                                                <?php 

                                                foreach( $residence as $path ) : ?>

                                                    <div class="col">

                                                        <img src="<?=asset($path['path'])?>" alt="residence_id" class="w-100 ">

                                                    </div>

                                                <?php endforeach;?>

                                            </div>

                                            <input type="hidden" id="residence_id" 

                                            name="meta[residence_id]" value="<?=implode(',',$path['id'])?>" required>
                                        </div>

                                    <?php endif;?>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group mt-3">

                                    <label for="residence_visa" class="control-label mb-1">Residence Visa</label>

                                    <?php 

                                    $id = isset( $data['metadata']['residence_visa']['id'] ) ? $data['metadata']['residence_visa']['id'] : '';

                                    $path = isset( $data['metadata']['residence_visa']['path'] ) ? $data['metadata']['residence_visa']['path'] : '';

                                    $c1 = $path == '' ? '' : 'featured';
                                    $c2 = $path == '' ? 'd-none' : '';

                                    ?>
                                    <div class="featuredWrap <?=$c1?>">

                                        <button class="btn uploader featured_image btn-primary" data-type="single">+</button>

                                        <input type="hidden" id="residence_visa" 

                                        name="meta[residence_visa]" value="<?=$id?>" required>

                                        <img src="<?=asset($path)?>" alt="residence_visa" class="w-100 <?=$c2?>">

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group mt-3">

                                    <label for="bank_confirmation" class="control-label mb-1">Bank Account Confirmation</label>

                                    <?php 

                                    $id = isset( $data['metadata']['bank_confirmation']['id'] ) ? $data['metadata']['bank_confirmation']['id'] : '';

                                    $path = isset( $data['metadata']['bank_confirmation']['path'] ) ? $data['metadata']['bank_confirmation']['path'] : '';

                                    $c1 = $path == '' ? '' : 'featured';
                                    $c2 = $path == '' ? 'd-none' : '';
                                    ?>

                                    <div class="featuredWrap <?=$c1?>">

                                        <button class="btn uploader featured_image btn-primary" data-type="single">+</button>

                                        <input type="hidden" id="bank_confirmation" 

                                        name="meta[bank_confirmation]" value="<?=$id?>" required>

                                        <img src="<?=asset($path)?>" alt="bank_confirmation" class="w-100 <?=$c2?>">

                                    </div>

                                </div>

                            </div>

                        </div>


                    </div>


                </div>


            </div>

            <div class="box-footer text-center">

                <button type="submit" class="btn btn-primary">Submit</button>

            </div>

        </div>


        {!! Form::close() !!}

    </section>


</div>





@endsection







<script>







    function delete_popup(action,id){







        jQuery('.delete-modal').find('form').attr('action',action)







        jQuery('.delete-modal').find('#id').val(jQuery('#selected_rows').val())







        jQuery('.delete-modal').addClass('show')







        jQuery('.delete-modal').show()







    }



</script>