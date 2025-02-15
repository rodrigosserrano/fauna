<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'LoginController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//Usuario Login
$route['validate']['post'] = 'LoginController/validateLogin'; //REQUISIÇÃO POST
$route['logout'] = 'LoginController/logout';
$route['forgot']['get'] = 'LoginController/forgotPasswordPage';

//Usuario registro
$route['register'] = 'RegisterController';
$route['register-validate']['post'] = 'RegisterController/validateRegister'; //REQUISIÇÃO POST

//Usuário recuperar conta
$route['send-mail']['post'] = 'EmailController/send';

//Usuário
$route['get-dados-user']['get'] = 'UserController/getSettingsRequest';

//Usuários configs
// $route['usuario-dados']  = 'UserController';
// $route['usuario-deleta']  = 'UserController/deletaContaView';
// $route['usuario-pet'] = 'UserController/petDadosView';

$route['settings']  = 'UserController';

$route['profile']  = 'UserController/profile';
$route['profile/(:num)']  = 'UserController/profile/$1';

$route['get-profile']['get'] = 'UserController/getProfile';
$route['get-profile/(:num)']['get'] = 'UserController/getProfile/$1';

// $route['settings/delete']  = 'UserController/deletaContaView';
// $route['settings/pet'] = 'UserController/petDadosView';

$route['delete']['post'] = 'UserController/delete';
$route['edit']['post'] = 'UserController/edit';

//Pet configs
$route['delete-pet']['post'] = 'UserController/deletePet';
$route['edit-pet']['post'] = 'UserController/editPet';
$route['create-pet']['post'] = 'UserController/createPet';

//Feed
$route['home'] = 'HomeController';
$route['home/(:any)'] = 'HomeController';

//Postagem comentario get
$route['get-post-comment'] = 'PostController/getPostagemComentarioRequest';
$route['get-post-comment/(:any)'] = 'PostController/getPostagemComentarioRequest/$1';
//Posts
$route['delete-postagem']['post'] = 'PostController/deletePostagem';
$route['edit-postagem']['post'] = 'PostController/editPostagem';
$route['create-postagem']['post'] = 'PostController/createPostagem';

//Comentario
$route['delete-comentario']['post'] = 'PostController/deleteComentario';
$route['edit-comentario']['post'] = 'PostController/editComentario';
$route['create-comentario']['post'] = 'PostController/createComentario';

//Like
// $route['delete-curtida']['post'] = 'PostController/deleteCurtida';
$route['delete-curtida']['post'] = 'PostController/deleteCurtidaPostagem';
$route['create-curtida']['post'] = 'PostController/createCurtidaPostagem';
$route['create-curtida-comentario']['post'] = 'PostController/createCurtidaComentario';

//Seguir
$route['delete-seguidor']['post'] = 'UserController/deleteSeguidor';
$route['delete-seguindo']['post'] = 'UserController/deleteSeguindo';
$route['create-seguir']['post'] = 'UserController/createSeguidores';