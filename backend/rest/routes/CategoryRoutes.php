<?php
require_once __DIR__ . '/../services/CategoryService.php';

$categoryService = new CategoryService();

/**
 * @OA\Get(
 *     path="/categories",
 *     summary="Get all categories",
 *     tags={"Categories"},
 *     security={{"ApiKey":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="List of categories"
 *     )
 * )
 */
Flight::route('GET /categories', function () use ($categoryService) {
    Flight::json($categoryService->get_all());
});

/**
 * @OA\Get(
 *     path="/categories/{id}",
 *     summary="Get category by ID",
 *     tags={"Categories"},
 *     security={{"ApiKey":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Category ID",
 *         @OA\Schema(type="integer", example=2)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Category data"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Category not found"
 *     )
 * )
 */
Flight::route('GET /categories/@id', function ($id) use ($categoryService) {
    Flight::json($categoryService->get_by_id($id));
});

/**
 * @OA\Post(
 *     path="/categories",
 *     summary="Create a new category",
 *     tags={"Categories"},
 *     security={{"ApiKey":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name"},
 *             @OA\Property(property="name", type="string", example="Tech")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Category created"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input"
 *     )
 * )
 */
Flight::route('POST /categories', function () use ($categoryService) {
    Flight::auth_middleware()->authorizeRole('admin');
    $data = Flight::request()->data->getData();
    Flight::json($categoryService->insert($data));
});

/**
 * @OA\Put(
 *     path="/categories/{id}",
 *     summary="Update category by ID",
 *     tags={"Categories"},
 *     security={{"ApiKey":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Category ID",
 *         @OA\Schema(type="integer", example=3)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Updated Category")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Category updated"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Category not found"
 *     )
 * )
 */
Flight::route('PUT /categories/@id', function ($id) use ($categoryService) {
    Flight::auth_middleware()->authorizeRole('admin');
    $data = Flight::request()->data->getData();
    Flight::json($categoryService->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/categories/{id}",
 *     summary="Delete category by ID",
 *     tags={"Categories"},
 *     security={{"ApiKey":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Category ID",
 *         @OA\Schema(type="integer", example=4)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Category deleted"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Category not found"
 *     )
 * )
 */
Flight::route('DELETE /categories/@id', function ($id) use ($categoryService) {
    Flight::auth_middleware()->authorizeRole('admin');
    Flight::json($categoryService->delete($id));
});
