<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\VendorResource;
use App\Http\Resources\ShowVendorResource;
use App\Repositories\Contracts\VendorRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class VendorController extends Controller
{
    protected $vendorRepository;
    protected $categoryRepository;

    public function __construct(
        VendorRepositoryInterface $vendorRepository,
        CategoryRepositoryInterface $categoryRepository
    
    )
    {
        $this->vendorRepository = $vendorRepository;
        $this->categoryRepository = $categoryRepository;
    
    }
    // Display a listing of vendors
    public function index()
    {
        $vendors = $this->vendorRepository->getAllActiveAndApproved();
        return VendorResource::collection($vendors);

    }

    public function findByCategory($id){

        $vendors = $this->vendorRepository->findByCategory($id);
        return VendorResource::collection($vendors);


    }


    public function show($id){

        $vendor = $this->vendorRepository->find($id);

        return new ShowVendorResource($vendor);


    }

}
