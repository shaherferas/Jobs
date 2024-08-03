<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobStoreRequest;
use App\Http\Requests\JobUpdateRequest;
use App\Models\Job;
use App\Services\JobService;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

class JobController extends Controller
{
    protected $jobService;

    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;
    }


    /**
     * @OA\Post(
     *     path="/api/jobs",
     *     tags={"Jobs"},
     *     summary="Add a new job",
     *     security={ {"sanctum": {} }},
     *     operationId="addJob",
     *     @OA\Response(
     *         response=200,
     *         description="job added",
     *      @OA\JsonContent()
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="title",
     *                     description="The email of the user",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     description="The description of the job",
     *                     type="string"
     *                 )
     *             )
     *         )
     *     ),
     *     security={
     *       {"sanctum": {}},
     *     }
     * )
     */
    public function store(JobStoreRequest $request)
    {
        $job = $this->jobService->createJob($request->validated());

        return response()->json($job, Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *     path="/api/jobs",
     *     tags={"Jobs"},
     *     summary="List Jobs based on user",
     *     security={ {"sanctum": {} }},
     *     operationId="list Jobs",
     *     @OA\Response(
     *         response=200,
     *         description="job list",
     *      @OA\JsonContent()
     *     ),
     *     security={
     *       {"sanctum": {}},
     *     }
     * )
     */


    public function index()
    {
        $jobs = $this->jobService->listJobs();

        return response()->json($jobs, Response::HTTP_OK);
    }
}
