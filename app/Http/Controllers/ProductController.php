<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Repositories\ProductRepository;
use Exception;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

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
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search by title",
     *         required=false,
     *         explode=true,
     *         @OA\Schema(
     *             default="",
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="orderBy",
     *         in="query",
     *         description="Order By column name",
     *         required=false,
     *         explode=true,
     *         @OA\Schema(
     *             default="id",
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="order",
     *         in="query",
     *         description="Order ordering - asc or desc",
     *         required=false,
     *         explode=true,
     *         @OA\Schema(
     *             default="desc",
     *             type="string"
     *         )
     *     ),
     *     security={{"bearer":{}}},
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
            return $this->responseSuccess($this->productRepository->getAll(request()->all()), "Products fetched successfully.");
        } catch (Exception $exception) {
            return $this->responseError([], $exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * @OA\Post(
     *     path="/api/products",
     *     tags={"Products"},
     *     summary="Create new product",
     *     description="Create new product",
     *     operationId="store",
     *     security={{"bearer":{}}},
     *     @OA\RequestBody(
     *         description="Product Object",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="title",
     *                     description="Product title",
     *                     type="string",
     *                     example="Product title"
     *                 ),
     *                 @OA\Property(
     *                     property="slug",
     *                     description="Product slug",
     *                     type="string",
     *                     example="product-title"
     *                 ),
     *                 @OA\Property(
     *                     property="price",
     *                     description="Product price",
     *                     type="integer",
     *                     example="200"
     *                 ),
     *                 @OA\Property(
     *                     property="image",
     *                     description="Product image",
     *                     type="string",
     *                     format="binary"
     *                 ),
     *                  required = {"title", "price"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function store(ProductCreateRequest $request): JsonResponse
    {
        try {
            return $this->responseSuccess($this->productRepository->create($request->all()), "Product created successfully.");
        } catch (Exception $exception) {
            return $this->responseError([], $exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * @OA\Get(
     *     path="/api/products/{id}",
     *     tags={"Products"},
     *     summary="Get product detail",
     *     description="Get product detail",
     *     operationId="showProduct",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="product id",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     security={{"bearer":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found."
     *     )
     * )
     */
    public function show(int $id): JsonResponse
    {
        try {
            return $this->responseSuccess($this->productRepository->getById($id), "Product fetched successfully.");
        } catch (Exception $exception) {
            return $this->responseError([], $exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * @OA\Post(
     *     path="/api/products/{id}",
     *     tags={"Products"},
     *     summary="Update product",
     *     description="Update product",
     *     operationId="updateProduct",
     *     security={{"bearer":{}}},
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="product id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *      @OA\Parameter(
     *         name="_method",
     *         in="query",
     *         description="request method",
     *         required=true,
     *         @OA\Schema(
     *             default="PUT",
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="Product Object",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="id",
     *                     description="Product id",
     *                     type="integer",
     *                     example=""
     *                 ),
     *                 @OA\Property(
     *                     property="title",
     *                     description="Product title",
     *                     type="string",
     *                     example="Product title"
     *                 ),
     *                 @OA\Property(
     *                     property="slug",
     *                     description="Product slug",
     *                     type="string",
     *                     example="product-title"
     *                 ),
     *                 @OA\Property(
     *                     property="price",
     *                     description="Product price",
     *                     type="integer",
     *                     example="200"
     *                 ),
     *                 @OA\Property(
     *                     property="image",
     *                     description="Product image",
     *                     type="string",
     *                     format="binary"
     *                 ),
     *                  required = {"id", "title", "slug", "price"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function update(ProductUpdateRequest $request, int $id): JsonResponse
    {
        try {
            return $this->responseSuccess($this->productRepository->update($id, $request->all()), "Product updated successfully.");
        } catch (Exception $exception) {
            return $this->responseError([], $exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * @OA\DELETE(
     *     path="/api/products/{id}",
     *     tags={"Products"},
     *     summary="Delete product",
     *     description="Delete product",
     *     operationId="deleteProduct",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="product id",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     security={{"bearer":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found."
     *     )
     * )
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            return $this->responseSuccess($this->productRepository->delete($id), "Product deleted successfully.");
        } catch (Exception $exception) {
            return $this->responseError([], $exception->getMessage(), $exception->getCode());
        }
    }
}
