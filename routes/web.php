<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;



Route::get('/', function () {
     
    $links = \App\Link::all();


    return view('welcome',['links' => $links]);
    //return view('welcome');
});


Route::get('/submit',function(){
     return view('submit');
});


Route::post('/submit',function(Request $request){

  $validator = Validator::make($request->all(), [
       'title' => 'required|max:255',
       'url' => 'required|max:255',
       'description' => 'required|max:255',
]);
      if ($validator->fails()) {
          return back()
          ->withInput()
          ->withErrors($validator);
}
        $link = new \App\Link;
        $link->title = $request->title;
        $link->url = $request->url;
        $link->description = $request->description;
        $link->save();
        return redirect('/');

   

});


//Route::get('/', 'WelcomeController@index');


//Route::put('/',function() {});

//Route::delete('/',function () {});

//Route::any('/',function() {});

//Route::match(['get','post'],'/',function(){});





Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
