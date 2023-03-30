<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use Exception;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ResponseTrait;

    public $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @OA\Get(
     *     path="/api/products",
     *     tags={"Products"},
     *     summary="Get all products for REST API",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="index",
     *     @OA\Parameter(
     *         name="perPage",
     *         in="query",
     *         description="Per page product count",
     *         required=false,
     *         explode=true,
     *         @OA\Schema(
     *             default="10",
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        try {
            return $this->responseSuccess($this->productRepository->getAll(request()->perPage), "Products fetched successfully");
        } catch (Exception $e) {
            return $this->responseError([], $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
