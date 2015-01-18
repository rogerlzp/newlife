<?php

namespace Controllers;

use Github;
use GithubProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Tricks\Repositories\UserRepositoryInterface;
use Tricks\Repositories\CartRepositoryInterface;

class AuthController extends BaseController
{
    /**
     * User Repository.
     *
     * @var \Tricks\Repositories\UserRepositoryInterface
     */
    protected $users;
    
    /**
     * Cart Repository.
     *
     * @var \Tricks\Repositories\CartRepositoryInterface
     */
    protected $cart;

    /**
     * Create a new AuthController instance.
     *
     * @param  \Tricks\Repositories\UserRepositoryInterface $users
     * @return void
     */
    public function __construct(UserRepositoryInterface $users, CartRepositoryInterface $cart)
    {
        parent::__construct();

        $this->users = $users;
        $this->cart = $cart;
    }

    /**
     * Show login form.
     *
     * @return \Response
     */
    public function getLogin()
    {
        $this->view('home.login');
    }

    /**
     * Post login form.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin()
    {
        $credentials = Input::only([ 'username', 'password' ]);
        $remember    = Input::get('remember', false);

        if (str_contains($credentials['username'], '@')) {
            $credentials['email'] = $credentials['username'];
            unset($credentials['username']);
        }

        // check if the session has cart
        // if yes, then add the cart to user
        $original_session_id = Session::getId();
        Log::info("original sessin id".$original_session_id);
        
        if (Auth::attempt($credentials, $remember)) {
        	
        	$session_id = Session::getId();
        	Log::info("session id in postLogin".$session_id);
        	Log::info("user id in postLogin".Auth::user()->id);
        	
        	$cart = $this->cart->getCartBySessionId($original_session_id);
        	$cart->session_id = $session_id ;
        	$cart->user_id =  Auth::user()->id;
        	$cart->save();

            return $this->redirectIntended(route('image.show'));
        }

        return $this->redirectBack([ 'login_errors' => true ]);
    }
    
    /**
     * Post login form.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAdminLogin()
    {
    	$credentials = Input::only([ 'username', 'password' ]);
    	$remember    = Input::get('remember', false);
    
    	if (str_contains($credentials['username'], '@')) {
    		$credentials['email'] = $credentials['username'];
    		unset($credentials['username']);
    	}
    
    	if (Auth::attempt($credentials, $remember)) {
    		return $this->redirectIntended(route('admin.show'));
    	}
    
    	return $this->redirectBack([ 'login_errors' => true ]);
    }

    /**
     * Show registration form.
     *
     * @return \Response
     */
    public function getRegister()
    {
        $this->view('home.register');
    }

    /**
     * Post registration form.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRegister()
    {
        $form = $this->users->getRegistrationForm();

        if (! $form->isValid()) {
            return $this->redirectBack([ 'errors' => $form->getErrors() ]);
        }

        if ($user = $this->users->create($form->getInputData())) {
            Auth::login($user);

            return $this->redirectRoute('user.index', [], [ 'first_use' => true ]);
        }

        return $this->redirectRoute('home');
    }

    /**
     * Handle Github login.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLoginWithGithub()
    {
        if (! Input::has('code')) {
            Session::keep([ 'url' ]);
            GithubProvider::authorize();
        } else {
            try {
                $user = Github::register(Input::get('code'));
                Auth::login($user);

                if (Session::get('password_required')) {
                    return $this->redirectRoute('user.settings', [], [
                        'update_password' => true
                    ]);
                }

                return $this->redirectIntended(route('user.index'));
            } catch (GithubEmailNotVerifiedException $e) {
                return $this->redirectRoute('auth.register', [
                    'github_email_not_verified' => true
                ]);
            }
        }
    }

    /**
     * Logout the user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogout()
    {
        Auth::logout();

        return $this->redirectRoute('auth.login', [], [ 'logout_message' => true ]);
    }
}
