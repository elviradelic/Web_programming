<?php
require_once __DIR__ . '/../services/EventService.php';

$eventService = new EventService();

/**
 * @OA\Get(
 *     path="/events",
 *     summary="Get all events",
 *     tags={"Events"},
 *     security={{"ApiKey":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="List of events"
 *     )
 * )
 */
Flight::route('GET /events', function () use ($eventService) {
    Flight::json($eventService->get_all());
});

/**
 * @OA\Get(
 *     path="/events/{id}",
 *     summary="Get event by ID",
 *     tags={"Events"},
 *     security={{"ApiKey":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Event ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Event data"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Event not found"
 *     )
 * )
 */
Flight::route('GET /events/@id', function ($id) use ($eventService) {
    Flight::json($eventService->get_by_id($id));
});

/**
 * @OA\Post(
 *     path="/events",
 *     summary="Create new event",
 *     tags={"Events"},
 *     security={{"ApiKey":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title", "description", "date", "location", "category_id", "created_by"},
 *             @OA\Property(property="title", type="string", example="Tech Conference"),
 *             @OA\Property(property="description", type="string", example="Annual tech event"),
 *             @OA\Property(property="date", type="string", format="date", example="2025-07-01"),
 *             @OA\Property(property="location", type="string", example="Sarajevo"),
 *             @OA\Property(property="category_id", type="integer", example=1),
 *             @OA\Property(property="created_by", type="integer", example=2)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Event created"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input"
 *     )
 * )
 */
Flight::route('POST /events', function () use ($eventService) {
    Flight::auth_middleware()->authorizeRole('admin');
    $data = Flight::request()->data->getData();
    Flight::json($eventService->insert($data));
});

/**
 * @OA\Put(
 *     path="/events/{id}",
 *     summary="Update event by ID",
 *     tags={"Events"},
 *     security={{"ApiKey":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Event ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="title", type="string", example="Updated Event"),
 *             @OA\Property(property="description", type="string", example="Updated description"),
 *             @OA\Property(property="date", type="string", format="date", example="2025-08-01"),
 *             @OA\Property(property="location", type="string", example="Mostar"),
 *             @OA\Property(property="category_id", type="integer", example=2)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Event updated"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Event not found"
 *     )
 * )
 */
Flight::route('PUT /events/@id', function ($id) use ($eventService) {
    Flight::auth_middleware()->authorizeRole('admin');
    $data = Flight::request()->data->getData();
    Flight::json($eventService->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/events/{id}",
 *     summary="Delete event by ID",
 *     tags={"Events"},
 *     security={{"ApiKey":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Event ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Event deleted"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Event not found"
 *     )
 * )
 */
Flight::route('DELETE /events/@id', function ($id) use ($eventService) {
    Flight::auth_middleware()->authorizeRole('admin');
    Flight::json($eventService->delete($id));
});
