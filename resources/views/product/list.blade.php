@extends('layouts.app')
@push('css')
@endpush
@section('content')
<div class="page-header text-center" style="background-image: url('{{ asset('public/frontend') }}/assets/images/page-header-bg.jpg')">
    <div class="container">
        @if(!empty($getSubcategory))
        <h1 class="page-title">{{ $getCategory->category_name }}<span class="text-muted">{{ $getSubcategory->subcategory_name }}</span><span>Shop</span></h1>
        @else
        <h1 class="page-title">{{ $getCategory->category_name }}<span>Shop</span></h1>
        @endif
    </div>
</div>
<nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop.page') }}">Shop</a></li>
            @if(!empty($getSubcategory))
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('shop',$getCategory->category_slug) }}">{{ $getCategory->category_name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $getSubcategory->subcategory_name }}</li>
            @else
            <li class="breadcrumb-item active" aria-current="page">{{ $getCategory->category_name }}</li>
            @endif
        </ol>
    </div>
</nav>

<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="toolbox">
                    <div class="toolbox-left">
                        <div class="toolbox-info">
                            Showing <span>9 of 56</span> Products
                        </div>
                    </div>

                    <div class="toolbox-right">
                        <div class="toolbox-sort">
                            <label for="sortby">Sort by:</label>
                            <div class="select-custom">
                                <select name="sortby" id="sortby" class="form-control getSortBy">
                                    <option value="">Select</option>
                                    <option value="popularity">Most Popular</option>
                                    <option value="rating">Most Rated</option>
                                    <option value="date">Date</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="getProductList">
                    @include('product._list');
                </div>

            </div><!-- End .col-lg-9 -->
            <aside class="col-lg-3 order-lg-first">
                <form action="" method="post" id="FilterFormProduct" >
                    @csrf
                    <input type="hidden" name="subcategory_id" id="getSubcategory_id">
                    <input type="hidden" name="brand_id" id="getBrand_id">
                    <input type="hidden" name="sortBy_id" id="getSortBy_id">
                </form>
                <div class="sidebar sidebar-shop">
                    <div class="widget widget-clean">
                        <label>Filters:</label>
                        <a href="#" class="sidebar-filter-clear">Clean All</a>
                    </div>

                    <div class="widget widget-collapsible">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                                Category
                            </a>
                        </h3>

                        <div class="collapse show" id="widget-1">
                            <div class="widget-body">
                                <div class="filter-items filter-items-count">
                                    @foreach ($getSubcategoryFilter as $subcategory)
                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input ChangeSubcategory" id="cat-{{ $subcategory->id }}" value="{{ $subcategory->id }}">
                                            <label class="custom-control-label" for="cat-{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}</label>
                                        </div>
                                        @php 
                                        $countProduct=DB::table('products')->where('subcategory_id',$subcategory->id)->where('status',1)->count();
                                        @endphp
                                        <span class="item-count">{{ $countProduct }}</span>
                                    </div>
                                    @endforeach
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget widget-collapsible">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true" aria-controls="widget-4">
                                Brand
                            </a>
                        </h3>

                        <div class="collapse show" id="widget-4">
                            <div class="widget-body">
                                <div class="filter-items">
                                    @foreach($brand as $row)
                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input ChangeBrand" id="brand-{{ $row->id }}" value="{{ $row->id }}">
                                            <label class="custom-control-label" for="brand-{{ $row->id }}">{{ $row->brand_name }}</label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="widget widget-collapsible">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true" aria-controls="widget-5">
                                Price
                            </a>
                        </h3>

                        <div class="collapse show" id="widget-5">
                            <div class="widget-body">
                                <div class="filter-price">
                                    <div class="filter-price-text">
                                        Price Range:
                                        <span id="filter-price-range"></span>
                                    </div>

                                    <div id="price-slider"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>

@endsection
@push('js')
<script>
    //add wishlist
    $('body').on('click','.wishlist',function(){
      var id=$(this).attr('data-id');
      $.ajax({
        url: "{{ url('/add-to-wishlist/') }}/"+id,
        type:'get',
        success:function(data){
        wishlist();
         if(data.error) {
            toastr.error(data.error);
         }else{
            toastr.success(data.success);
         }
        }
      })
    });
    
    $('.getSortBy').change(function(){
        var id = $(this).val();
        $('#getSortBy_id').val(id);
        FilterFormProduct();
    })

    $('.ChangeSubcategory').change(function(){
        var ids = "";
        $('.ChangeSubcategory').each(function(){
            if(this.checked){
                var id = $(this).val();
                ids +=+id+",";
            }
        })
        $('#getSubcategory_id').val(ids);
        FilterFormProduct();
    })

    $('.ChangeBrand').change(function(){
        var ids = "";
        $('.ChangeBrand').each(function(){
            if(this.checked){
                var id = $(this).val();
                ids +=+id+",";
            }
        })
        $('#getBrand_id').val(ids);
        FilterFormProduct();
    });

    function FilterFormProduct()
    {
        $.ajax({
            type:'POST',
            url:"{{ url('product-filter') }}",
            data:$('#FilterFormProduct').serialize(),
            dataType:"json",
            success:function(data)
            {
                $("#getProductList").html(data.success);
            }
        })
    }

</script>
@endpush
