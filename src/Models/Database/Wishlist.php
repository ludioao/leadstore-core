<?php

namespace LeadStore\Framework\Models\Database;

class Wishlist extends BaseModel
{
    protected $fillable = ['user_id', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
