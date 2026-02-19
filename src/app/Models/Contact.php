<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
    'last_name',
    'first_name',
    'gender',
    'email',
    'tel',
    'address',
    'building',
    'contact_type',
    'content',
];

public function getContactTypeLabelAttribute()
    {
        return match ($this->contact_type) {
            1 => '商品のお届けについて',
            2 => '商品の交換について',
            3 => '商品トラブル',
            4 => 'ショップへのお問い合わせ',
            5 => 'その他',
            default => '未選択',
        };
    }

public function getGenderLabelAttribute()
    {
        return match ($this->gender) {
            1 => '男性',
            2 => '女性',
            3 => 'その他',
            default => '不明',
        };
    }

}
