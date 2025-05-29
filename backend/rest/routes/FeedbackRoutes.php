<?php
require_once __DIR__ . '/../services/FeedbackService.php';

$feedbackService = new FeedbackService();

/**
 * @OA\Get(
 *     path="/feedbacks",
 *     summary="Get all feedbacks",
 *     tags={"Feedback"},
 *     security={{"ApiKey":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="List of feedback entries"
 *     )
 * )
 */
Flight::route('GET /feedbacks', function () use ($feedbackService) {
    Flight::json($feedbackService->get_all());
});

/**
 * @OA\Get(
 *     path="/feedbacks/{id}",
 *     summary="Get feedback by ID",
 *     tags={"Feedback"},
 *     security={{"ApiKey":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Feedback ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Feedback entry"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Feedback not found"
 *     )
 * )
 */
Flight::route('GET /feedbacks/@id', function ($id) use ($feedbackService) {
    Flight::json($feedbackService->get_by_id($id));
});

/**
 * @OA\Post(
 *     path="/feedbacks",
 *     summary="Create feedback",
 *     tags={"Feedback"},
 *     security={{"ApiKey":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id", "event_id", "message", "rating"},
 *             @OA\Property(property="user_id", type="integer", example=3),
 *             @OA\Property(property="event_id", type="integer", example=1),
 *             @OA\Property(property="message", type="string", example="Great event!"),
 *             @OA\Property(property="rating", type="integer", example=5),
 *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-23T10:00:00")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Feedback created"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input"
 *     )
 * )
 */
Flight::route('POST /feedbacks', function () use ($feedbackService) {
    $data = Flight::request()->data->getData();
    Flight::json($feedbackService->add($data));
});

/**
 * @OA\Put(
 *     path="/feedbacks/{id}",
 *     summary="Update feedback",
 *     tags={"Feedback"},
 *     security={{"ApiKey":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Feedback ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Updated message"),
 *             @OA\Property(property="rating", type="integer", example=4)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Feedback updated"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Feedback not found"
 *     )
 * )
 */
Flight::route('PUT /feedbacks/@id', function ($id) use ($feedbackService) {
    $data = Flight::request()->data->getData();
    Flight::json($feedbackService->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/feedbacks/{id}",
 *     summary="Delete feedback",
 *     tags={"Feedback"},
 *     security={{"ApiKey":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Feedback ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Feedback deleted"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Feedback not found"
 *     )
 * )
 */
Flight::route('DELETE /feedbacks/@id', function ($id) use ($feedbackService) {
    Flight::auth_middleware()->authorizeRole('admin');
    Flight::json($feedbackService->delete($id));
});
