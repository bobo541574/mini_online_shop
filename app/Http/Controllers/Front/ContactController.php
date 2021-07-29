<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Front\ContactRepository;

class ContactController extends Controller
{
    protected $repo;

    public function __construct(ContactRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getCititesBystate($state)
    {
        return $this->repo->getCityListByState($state);
    }

    public function getTownshipsBycity($city)
    {
        return $this->repo->getTownshipListByCity($city);
    }

    public function storeForUser(Request $request)
    {
        return $this->repo->storeForUser($request);
    }
}
