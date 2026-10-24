use App\Http\Controllers\AuthorController;
use App\Http\Controllers\GenreController;

Route::get('/genres', [GenreController::class, 'index'])->name('genres.index');
Route::get('/genres/{id}', [GenreController::class, 'show'])->whereNumber('id')->name('genres.show');

Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
Route::get('/authors/{id}', [AuthorController::class, 'show'])->whereNumber('id')->name('authors.show');
