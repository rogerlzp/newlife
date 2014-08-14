<?php

namespace Controllers;

use ImageUpload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Tricks\Repositories\TrickRepositoryInterface;
use Tricks\Repositories\ImageRepositoryInterface;
use Tricks\Repositories\ImageBoardRepositoryInterface;
use Tricks\Repositories\BoardRepositoryInterface;
use Tricks\Repositories\UserRepositoryInterface;

use Illuminate\Support\Facades\Log;

class UserController extends BaseController
{
    /**
     * Trick repository.
     *
     * @var \Tricks\Repositories\TrickRepositoryInterface
     */
    protected $tricks;
    
    /**
     * Image repository.
     *
     * @var \Tricks\Repositories\ImageRepositoryInterface
     */
    protected $images;
    
   

    /**
     * Board repository.
     *
     * @var \Tricks\Repositories\BoardRepositoryInterface
     */
    protected $boards;
    
    /**
     * Image_board repository.
     *
     * @var \Tricks\Repositories\ImageBoardRepositoryInterface
     */
    protected $image_board;
    

    /**
     * User repository.
     *
     * @var \Tricks\Repositories\UserRepositoryInterface
     */
    protected $users;

    /**
     * The currently authenticated user.
     *
     * @var \User
     */
    protected $user;

    /**
     * Create a new UserController instance.
     *
     * @param \Tricks\Repositories\TrickRepositoryInterface  $tricks
     * @param \Tricks\Repositories\UserRepositoryInterface  $users
     */
    public function __construct(TrickRepositoryInterface $tricks, UserRepositoryInterface $users, 
    		ImageBoardRepositoryInterface $image_board, BoardRepositoryInterface $boards, ImageRepositoryInterface $images)
    {
    	Log::info(' __construct in UserController');
        parent::__construct();

        $this->beforeFilter('auth', [ 'except' => 'getPublic' ]);

        $this->user   = Auth::user();
        $this->tricks = $tricks;
        $this->users  = $users;
        $this->images  = $images;
        $this->boards = $boards;
        $this->image_board = $image_board;
    }

    /**
     * Show the user's tricks page.
     *
     * @return \Response
     */
    public function getIndex()
    {
        $tricks = $this->tricks->findAllForUser($this->user, 12);

        $this->view('user.profile', compact('tricks'));
    }

    /**
     * Show the user's image page.
     *
     * @return \Response
     */
    public function getImage()
    {
    	$images = $this->images->findAllForUser($this->user, 10);
    
    	Log::info('getImage');
    //	Log::info($images);
    	$this->view('user.image_profile', compact('images'));
    }
    
    
    /**
     * Show the settings page.
     *
     * @return \Response
     */
    public function getSettings()
    {
        $this->view('user.settings');
    }

    /**
     * Show the favorited tricks page.
     *
     * @return \Response
     */
    public function getFavorites()
    {
        $tricks = $this->tricks->findAllFavorites($this->user);

        $this->view('user.favorites', compact('tricks'));
    }

    /**
     * Handle the settings form.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postSettings()
    {
        $form = $this->users->getSettingsForm();

        if (! $form->isValid()) {
            return $this->redirectBack([ 'errors' => $form->getErrors() ]);
        }

        $this->users->updateSettings($this->user, Input::all());

        return $this->redirectRoute('user.settings', [], [ 'settings_updated' => true ]);
    }

    /**
     * Handle the avatar upload.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postAvatar()
    {
    	Log::info('postAvatar');
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            ImageUpload::enableCORS($_SERVER['HTTP_ORIGIN']);
        }

        if (Request::server('REQUEST_METHOD') == 'OPTIONS') {
            exit;
        }

        $json = ImageUpload::handle(Input::file('filedata'));

        if ($json !== false) {
            return Response::json($json, 200);
        }

        return Response::json('error', 400);
    }

    /**
     * Show the user's public profile page.
     *
     * @param  string  $username
     * @return \Response
     */
    public function getPublic($username)
    {
        $user   = $this->users->requireByUsername($username);
        $tricks = $this->tricks->findAllForUser($user);

        $this->view('user.public', compact('user', 'tricks'));
    }
}