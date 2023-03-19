<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'number',
        'author_id'
    ];

    public static function find($id) {
        $books = self::all();
        foreach ($books as $book) {
            if($book['id'] == $id) {
                return $book;
            }
        }
    }
    //    relation ManyToOne to Author
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
}
