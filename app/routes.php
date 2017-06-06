<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	$notes = Ajout::orderBy('created_at')->get();

  return View::make('home.index', ['notes' => $notes]);
});

Route::get('/ajout', function()
{
	return View::make('ajout.ajout');
});

Route::post('/ajout', function()
{
	$inputs = Input::except('_token');
	$note = new Ajout;
	foreach($inputs as $k=>$v){
			$note->$k = $v;
	}
	$note->save();
	return Redirect::to('/');
});

// User
Route::get('/connexion', function()
{
	return View::make('userConnexion.index');
});

Route::post('/connexion', function()
{
	$user = new User;
	$user->email = Input::get('email');
    $user->password = Input::get('password');
	
    if(Auth::attempt(array('email' => $user->email, 'password' => $user->password))){
        echo 'Vous êtes maintenant connecté '.Auth::User()->email;
		Session::forget('user');
		if(Session::has('user')) {
    		Session::push('user', $user->id);
		} else {
    		Session::set('user', array($user->id));
		}
		return Redirect::to('/');
	}else{
        echo 'Echec de la connexion';
	}

});


//    Inscription
Route::get('/inscription', function()
{
	return View::make('userInscription.index');
});


Route::post('/inscription', function(){
	//print_r(Input::all());
	$inputs = Input::except('_token');
	$contact = new User;
	foreach($inputs as $k=>$v){
		if($k == 'password'){
			$contact->$k = Hash::Make($v);
		}
		else{
			$contact->$k = $v;
		}
		
	}
	$contact->save();
	return Redirect::to('/');
});


//deconnexion
Route::get('deconnexion',function ()
{
	Session::flush();
    return Redirect::to('/');
});


Route::post('/delete/{id}', function ($id)
{
	$note = Ajout::find($id);
	$note->delete();
	return Redirect::to('/');
});


Route::get('modification/{id}',function ($id)
{
    return View::make('modification.modification')->with('id', $id);
});

Route::post('modification/{id}',function ($id)
{
    $inputs = Input::except('_token');
    $note = Ajout::find($id);
    foreach ($inputs as $key=>$value){
        $note->$key = $value;
    }
    $note->save();

    return Redirect::to('/');
});


App::missing(function ($exception){
    return Response::view('errors.404', array(), 404);

});

Route::get('/redirection', function()
{
	return Redirect::to('/');
});




// Admin 
Route::get('/admin', function()
{	
	if (Session::has('user')){
		return View::make('admin.dashboard');
	} else {
		return Redirect::to('connexion');
	}
	
});


