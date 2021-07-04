<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Front\ContactRepository;

class ContactController extends Controller
{
    protected $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function getCititesBystate($state)
    {
        return $this->contactRepository->getCityListByState($state);
    }

    public function getTownshipsBycity($city)
    {
        return $this->contactRepository->getTownshipListByCity($city);
    }

    public function storeForUser(Request $request)
    {
        return $this->contactRepository->storeForUser($request);
    }
}
