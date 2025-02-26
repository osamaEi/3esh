<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\VendorRepositoryInterface;

class VendorController extends Controller
{
    protected $vendorRepository;


    public function __construct(VendorRepositoryInterface $vendorRepository)
    {
        $this->vendorRepository = $vendorRepository;
    }

    public function index() {

        $vendors->vendorRepository->all();

        return view('admin.vendors.index',compact('vendors'));

    }




}
