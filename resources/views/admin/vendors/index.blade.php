@extends('admin.layout')



@section('content')



<div class="content-wrapper">



    <section class="content-header">



        <h1>Vendors</h1>



        <ol class="breadcrumb">

            <li>

                <!-- <a href="<?=asset('admin/vendors/add')?>" type="button" class="btn-block">

                    <i class="fa fa-plus"></i>Add Vendor

                </a> -->

            </li>
            <li><a href="<?=asset('admin/vendors/add')?>" type="button" class="btn-block"><i class="fa fa-plus"></i>Add Vendor</a></li>

        </ol>



    </section>

    <section class="content">

        <div class="row">

            <div class="col-md-12">

                <div class="box">

                    <div class="box-header">

                        <h3 class="box-title">Listing</h3>

                    </div>

                    <div class="box-body">

                        <div class="row">

                            <div class="col-xs-12">

                                @if(session()->has('success'))

                                <div class="alert alert-success">

                                    <?=session()->get('success') ?>

                                </div>

                                @endif

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-xs-12">

                                <table id="example1" class="table table-bordered table-striped">

                                    <thead>

                                        <tr>

                                            <th>

                                                <input type="checkbox" name="select" class="select-all">

                                            </th>

                                            <th>ID</th>

                                            <th>Vendor Name</th>

                                            <th>Vendor Email</th>

                                            <th>Store Name</th>

                                            <th>Status</th>

                                            <th>Actions</th>

                                        </tr>

                                    </thead>

                                    <tbody class="draggable-container">

                                        @foreach ( $data['data'] as  $key=> $vendor )

                                        <tr>

                                           <td>

                                            <input type="checkbox" name="select" class="row-select" data-id="<?=$vendor['id'] ?>">

                                        </td>

                                        <td><?=$vendor['id'] ?></td>

                                        <td>
                                            <?= isset($vendor['meta']['vendor_name']) ? $vendor['meta']['vendor_name'] : '' ?>
                                        </td>

                                        <td><?= isset($vendor['meta']['vendor_email']) ? $vendor['meta']['vendor_email'] : '' ?></td>

                                        <td><?= isset($vendor['meta']['store_name']) ? $vendor['meta']['store_name'] : '' ?></td>

                                        <td><?=isset( $vendor['meta']['approved'] ) ? 'Approved' : 'Pending';?></td>

                                        <td>

                                            <a title="Edit" href="<?=asset('admin/vendors/edit/'.$vendor['id'] ) ?>" class="badge bg-light-blue"><i class="fas fa-edit"></i></a>

                                            <a href="javascript:delete_popup('<?=asset('admin/vendors/delete')?>',<?=$vendor['id'] ?>);" 

                                                class="badge delete-popup bg-red" title="Delete">

                                                <i class="fa fa-trash" aria-hidden="true"></i>

                                            </a>

                                        </td>

                                    </tr>

                                    @endforeach

                                </tbody>

                            </table>

                            <div class="multi-delete" style="display: none;">

                                <input type="hidden" name="selected_rows" value="" id="selected_rows">

                                <a href="javascript:delete_popup('<?=asset('admin/vendors/delete')?>','');" 

                                    class="badge delete-multiple-popup bg-red">

                                    <i class="fa fa-trash" aria-hidden="true"></i>

                                </a>

                            </div>

                        </div>


                        <nav aria-label="Page navigation example">

                          <ul class="pagination">

                            <?php

                            foreach( $data['links'] as $item ) :

                                $item['url'] == null ? $link = 'javascript:;' : $link = $item['url']; 

                                $item['url'] == null ? $c = 'disabled:;' : $c = '';

                                $item['active'] ? $c2 = 'active' : $c2 = ''; 

                                ?>

                                <li class="page-item <?=$c.' '.$c2?>"><a class="page-link" href="<?=$link?>"><?=$item['label']?></a></li>

                                <?php

                            endforeach;

                            ?>

                        </ul>

                    </nav>

                </div>

            </div>

        </div>

    </div>

</div>

</section>

</div>


@endsection


<script>

    function delete_popup(action,id){

        id = id == '' ? jQuery('#selected_rows').val() : id 

        jQuery('.delete-modal').find('form').attr('action',action)

        jQuery('.delete-modal').find('#id').val(id)

        jQuery('.delete-modal').addClass('show')

        jQuery('.delete-modal').show()

        jQuery('.delete-modal .modal-body').html('<p>Are You Sure You Want to Delete this?</p><p>This will also delete all the data related to Vendor!</p>')
    }

</script>