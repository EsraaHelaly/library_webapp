<?php

use Illuminate\Support\Facades\Route;
use App\Models\Books;
use App\Models\User;







Route::get('/', function () {
    return view('welcome');
});


//dashboard
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');





//all books
Route::middleware(['auth:sanctum', 'verified'])->get('/allbooks', function () {
    $books=Books::all();

    return view('allbooks',["books"=>$books]);
})->name('allbooks');





//soft delete (borrow button)
Route::middleware(['auth:sanctum', 'verified'])->get('/allbooks/{id}', function ($id) {
    
    $books=Books::find($id)->delete();

    return redirect ('allbooks');
})->name('allbooks');




//borrowed books (have soft deleted books)
Route::middleware(['auth:sanctum', 'verified'])->get('/borrowedbooks', function () {
    
    $books=Books::onlyTrashed()->latest()->paginate();
    $books2=Books::onlyTrashed()->latest()->paginate();
    return view('borrowedbooks',["books"=>$books],["books2"=>$books2]);
})->name('borrowedbooks');




// back from soft delete (borrow button) to allbooks

Route::middleware(['auth:sanctum', 'verified'])->get('/borrowedbooks/{id}', function ($id) {
    
    $books=Books::onlyTrashed()->where('id',$id)->first()->restore();
    $books = Books::findOrFail($id);
    $books->borrowed_by = null;
    $books->return_date = null;
    $books->return_time = null;
    $books->save();
    return redirect('allbooks');
})->name('borrowedbooks');










//all user
Route::middleware(['auth:sanctum', 'verified'])->get('/alluser', function () {
  
    $users=User::all(); 

    return view('alluser',["users"=>$users]);
})->name('alluser');


//student details
Route::middleware(['auth:sanctum', 'verified'])->get('/showdetails/{id}', function ($id) {
  
    $users=User::findOrfail($id);

    return view('userdetails',["users"=>$users]);
})->name('userdetails');
















//admin all books
Route::middleware(['auth:sanctum', 'verified'])->get('/allbooks', function () {
    $books=Books::all();

    return view('allbooks',["books"=>$books]);
})->name('allbooks');

// add book
Route::middleware(['auth:sanctum', 'verified'])->get('/add', function () {
 
    return view('add');
})->name('add');

//submit new book
Route::middleware(['auth:sanctum', 'verified'])->get('/submit', function () {
    $name = request("name");
    $author = request("author");
    $edition = request("edition");
    $books = new Books;
    $books->bookname = $name;
    $books->authorname = $author;
    $books->editionnumber = $edition;
    $books->save();
    return redirect('/add');
})->name('submit');

//edit book
Route::middleware(['auth:sanctum', 'verified'])->get('/edit/{books_id}', function ($books_id) {
 
    
    $books_data=Books::findOrfail($books_id);

    return view('edit',["books"=>$books_data]);
})->name('edit');

//update book
Route::middleware(['auth:sanctum', 'verified'])->get('/update/{books_id}', function ($books_id) {
    $books = Books::findOrFail($books_id);
    $books->bookname = request('name');
    $books->authorname = request('author');
    $books->editionnumber = request('edition');
    $books->save();
    return redirect ("allbooks/");
})->name('update');


//bowrrow button
Route::middleware(['auth:sanctum', 'verified'])->get('/return/{id}', function ($id) { 
    $books_data = Books::findOrFail($id);
    return view('return',["books"=>$books_data]);
})->name('return');


//delete book
Route::middleware(['auth:sanctum', 'verified'])->get('/date_time/{books_id}', function ($books_id) {
    $books = Books::findOrFail($books_id);
    $user_name = Auth::user()->name;
    $books->borrowed_by = $user_name;
    $books->return_date = request('date');
    $books->return_time = request('time');
    $books->save();
    $books=Books::find($books_id)->delete();
    return redirect ("/borrowedbooks");
})->name('date_time');