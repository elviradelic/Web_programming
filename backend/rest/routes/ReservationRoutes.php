<?php
require_once __DIR__ . '/../services/ReservationService.php';

$reservationService = new ReservationService();

/**
 * @OA\Get(
 *     path="/reservations",
 *     summary="Get all reservations",
 *     tags={"Reservations"},
 *     security={{"ApiKey":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="List of reservations"
 *     )
 * )
 */
Flight::route('GET /reservations', function () use ($reservationService) {
    Flight::json($reservationService->get_all());
});

/**
 * @OA\Get(
 *     path="/reservations/{id}",
 *     summary="Get reservation by ID",
 *     tags={"Reservations"},
 *     security={{"ApiKey":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Reservation ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Reservation details"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Reservation not found"
 *     )
 * )
 */
Flight::route('GET /reservations/@id', function ($id) use ($reservationService) {
    Flight::json($reservationService->get_by_id($id));
});

/**
 * @OA\Post(
 *     path="/reservations",
 *     summary="Create a reservation",
 *     tags={"Reservations"},
 *     security={{"ApiKey":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id", "event_id", "status", "reservation_date"},
 *             @OA\Property(property="user_id", type="integer", example=2),
 *             @OA\Property(property="event_id", type="integer", example=4),
 *             @OA\Property(property="status", type="string", example="confirmed"),
 *             @OA\Property(property="reservation_date", type="string", format="date", example="2025-06-01")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Reservation created"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input"
 *     )
 * )
 */
Flight::route('POST /reservations', function () use ($reservationService) {
    $data = Flight::request()->data->getData();
    Flight::json($reservationService->add($data));
});

/**
 * @OA\Put(
 *     path="/reservations/{id}",
 *     summary="Update reservation by ID",
 *     tags={"Reservations"},
 *     security={{"ApiKey":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Reservation ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="cancelled"),
 *             @OA\Property(property="reservation_date", type="string", format="date", example="2025-06-02")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Reservation updated"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Reservation not found"
 *     )
 * )
 */
Flight::route('PUT /reservations/@id', function ($id) use ($reservationService) {
    Flight::auth_middleware()->authorizeRole('admin');
    $data = Flight::request()->data->getData();
    Flight::json($reservationService->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/reservations/{id}",
 *     summary="Delete reservation",
 *     tags={"Reservations"},
 *     security={{"ApiKey":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Reservation ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Reservation deleted"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Reservation not found"
 *     )
 * )
 */
Flight::route('DELETE /reservations/@id', function ($id) use ($reservationService) {
    Flight::auth_middleware()->authorizeRole('admin');
    Flight::json($reservationService->delete($id));
});
