<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{{-- test js  --}}

        {{-- <script src="{{asset('query/app.js')}}"></script>
        <script src="{{asset('js/app.js')}}"></script>
        <script src="{{asset('toast-js/app.js')}}"></script> --}}
<script>
    $.ajaxSetup({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
</script>
<script>
    $(document).ready(function(){
        $(document).on('click','.add_product',function(e){
            e.preventDefault();
            let name = $('#name').val();
            let price = $('#price').val();
            // alert(name+price);

            $.ajax({
                url:"{{route('add.products')}}",
                method:'post',
                data:{name:name,price:price},
                success:function(res){

                    if(res.statut=='success'){
                        $('#addModal').modal('hide');
                    $('#addProductForm')[0].reset();
                    $('.table').load(location.href+'    .table');
                    Command: toastr["success"]("Product added","success")
                                toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": false,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": true,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                                }
                    }

                },error:function(err){
                    let error =err.responseJSON;
                    $.each(error.errors,function(index, value){
                        $('.errMsContainer').append('<span class="text-danger">'+value+'</span><br> ')
                    });
                }
            });
        })
        // affiche (edit)
        $(document).on('click','.update_product_Form',function(){
            let id =$(this).data('id');
            let name =$(this).data('name');
            let price =$(this).data('price');

            $('#up_id').val(id);
            $('#up_name').val(name);
            $('#up_price').val(price);
        });

                // modifier les info
                $(document).on('click','.update_product',function(e){
                    e.preventDefault();
                    let up_id = $('#up_id').val();
                    let up_name = $('#up_name').val();
                    let up_price = $('#up_price').val();
                    // alert(up_name+up_price+up_id);

                    $.ajax({
                        url:"{{route('update.products')}}",
                        method:'post',
                        data:{up_id:up_id,up_name:up_name,up_price:up_price},
                        success:function(res){

                            if(res.statut=='success'){
                                $('#updateModal').modal('hide');
                            $('#updateProductForm')[0].reset();
                            $('.table').load(location.href+'    .table');
                            Command: toastr["success"]("Product update","success")
                                        toastr.options = {
                                        "closeButton": true,
                                        "debug": false,
                                        "newestOnTop": false,
                                        "progressBar": false,
                                        "positionClass": "toast-top-right",
                                        "preventDuplicates": true,
                                        "onclick": null,
                                        "showDuration": "300",
                                        "hideDuration": "1000",
                                        "timeOut": "5000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                        }
                            }

                        },error:function(err){
                            let error =err.responseJSON;
                            $.each(error.errors,function(index, value){
                                $('.errMsContainer').append('<span class="text-danger">'+value+'</span><br> ')
                            });
                        }
                    });
                })
        
                // suprimer les info
                $(document).on('click','.delete_product',function(e){
                            e.preventDefault();
                            let product_id =$(this).data('id');
                            // alert(product_id);
                            if (confirm('voulez vous vraiment supprimer')) {
                                $.ajax({
                                    url:"{{route('delete.products')}}",
                                    method:'post',
                                    data:{product_id:product_id},
                                    success:function(res){
                                        if(res.statut=='success'){
                                            $('.table').load(location.href+'    .table');
                                            Command: toastr["success"]("Product Delete","success")
                                                toastr.options = {
                                                "closeButton": true,
                                                "debug": false,
                                                "newestOnTop": false,
                                                "progressBar": false,
                                                "positionClass": "toast-top-right",
                                                "preventDuplicates": true,
                                                "onclick": null,
                                                "showDuration": "300",
                                                "hideDuration": "1000",
                                                "timeOut": "5000",
                                                "extendedTimeOut": "1000",
                                                "showEasing": "swing",
                                                "hideEasing": "linear",
                                                "showMethod": "fadeIn",
                                                "hideMethod": "fadeOut"
                                                }
                                        }
                                    }
                                });
                            }
                })

                //pagination
                $(document).on('click','.pagination a',function(e){
                    e.preventDefault();
                    let page =$(this).attr('href').split('page=')[1]
                    product(page)
                        })
                    function product(page){
                        $.ajax({
                            url:"/pagination/pagination-data?page="+page,
                            success:function(res){
                                $('.table-data').html(res);
                            }
                        })
                    }

                // search
                $(document).on('keyup',function(e){
                    e.preventDefault();
                    let search_string=$('#search').val();
                    // alert(search_string);
                    $.ajax({
                        url:"{{route('search.products')}}",
                        method:'GET',
                        data:{search_string:search_string},
                        success:function(res){
                                $('.table-data').html(res);
                                if(res.statut=='nothing_found'){
                                    $('.table-data').html('<span class="text-danger">'+'nothing_found'+'</span>'); 
                                }
                            }
                    });
                })
    });
</script>