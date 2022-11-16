<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\SearchResult;
use Spatie\Searchable\Searchable;

class Faq extends Model implements Searchable
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
    ];

    public function getSearchResult(): SearchResult
    {
        $url = route('faq.view', $this->id);

        return new SearchResult(
            $this,
            $this->title,
            $url,
        );
    }
}
