<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditCaseRequest;
use App\Services\CaseItemService;
use App\Http\Requests\CreateCaseRequest;
use Illuminate\Http\Request;

class CaseItemController extends Controller
{
    protected $caseService;

    public function __construct(CaseItemService $caseService)
    {
        $this->caseService = $caseService;
    }


    public function create(CreateCaseRequest $request) {
        $result = $this->caseService->createCase($request);
        $code = $code = $this->caseService->code;
        return response()->json($result, $code);
    }

    public function edit(EditCaseRequest $request, $id)
    {
        $result = $this->caseService->editCase($id, $request);
        $code = $code = $this->caseService->code;
        return response()->json($result, $code);
    }

    public function delete($id)
    {
        $result = $this->caseService->deleteCase($id);
        $code = $code = $this->caseService->code;
        return response()->json($result, $code);
    }

    public function get($id){
        $result = $this->caseService->getCase($id);
        $code = $code = $this->caseService->code;
        return response()->json($result, $code);
    }

    public function markDone($id)
    {
        $result = $this->caseService->markDoneCase($id);
        $code = $code = $this->caseService->code;
        return response()->json($result, $code);
    }
}
