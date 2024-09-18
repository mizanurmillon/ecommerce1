<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Category;
use App\Models\Admin\Subcategory;
use App\Models\Admin\Brand;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id','category_id','subcategory_id','childcategory_id','brand_id','pickuppoint_id','warehouse_id',
        'title','slug','sku','barcode','size','unit','tag','video','purchase_price','price','discount_price','short_description','description','additional_information','shipping_returns','status','featured','today_deal','trendy','product_slider','product_views','date','colors','stock_quantity','thumbnail','images'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    
    
}
