<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Money\Currency;
use Money\Money;

class Product extends Model
{
    use HasFactory;

    protected function price() {
        return Attribute::make(
            function(int $value) {
                return new Money($value, new Currency('USD'));
            }
        );
    }

    public function variants() {
        return $this->hasMany(ProductVariant::class);
    }

    public function image() {
        return $this->hasOne(Image::class)->ofMany('featured', 'max');
    }

    public function images() {
        return $this->hasMany(Image::class);
    }
}
