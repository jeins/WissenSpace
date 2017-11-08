<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Interfaces\IUser;
use App\Repositories\UserRepository;

class UserController extends AdminController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(IUser $userInterface)
    {
        parent::__construct();
        $this->userRepository = $userInterface;
    }

    public function getAll()
    {
        return response()->json($this->userRepository->getAll(), 200);
    }
}
