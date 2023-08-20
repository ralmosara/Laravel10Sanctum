<?php

namespace App\Http\Controllers\API;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Patient\PatientResource;
use App\Http\Requests\Patient\CreatePatientRequest;
use App\Http\Requests\Patient\UpdatePatientRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Essa\APIToolKit\Api\ApiResponse;

class PatientController extends Controller
{
    use ApiResponse;

    public function index(): AnonymousResourceCollection 
    {
        $patients = Patient::useFilters()->dynamicPaginate();

        return PatientResource::collection($patients);
    }

    public function store(CreatePatientRequest $request): JsonResponse
    {
        $patient = Patient::create($request->all());

        return $this->responseCreated('Patient created successfully', new PatientResource($patient));
    }

    public function show(Patient $patient): JsonResponse
    {
        return $this->responseSuccess(null, new PatientResource($patient));
    }

    public function update(UpdatePatientRequest $request, Patient $patient): JsonResponse
    {
        $patient->update($request->all());

        return $this->responseSuccess('Patient updated Successfully', new PatientResource($patient));
    }

    public function destroy(Patient $patient): JsonResponse
    {
        $patient->delete();

        return $this->responseDeleted();
    }

}
