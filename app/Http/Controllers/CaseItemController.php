<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditCaseRequest;
use App\Services\CaseItemService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCaseRequest;
use App\Models\CaseItem;

class CaseItemController extends Controller
{
    protected $caseService;

    public function __construct(CaseItemService $caseService)
    {
        $this->caseService = $caseService;
    }

    public function createCase(CreateCaseRequest $request) {
        $result = CaseItem::create($request->all());
        $result->status = false;
        $result->created_at = Carbon::now();
        $result->updated_at = Carbon::now();

        $result->save();

        return response()->json($result, 200);
    }

    public function getCase($id)
    {
        $case = CaseItem::find($id);
        if(!$case)
        {
            return response()->json(['Error' => true, 'message' => 'Not found'], 400);
        }

        return response()->json($case, 200);
    }

    public function editCase(EditCaseRequest $request, $id)
    {
        $caseEdit = $this->caseService->editCase($id, $request);

        return response()->json($caseEdit, 200);
    }

    public function deleteCase($id)
    {
        $case = CaseItem::find($id);
        if(!$case)
        {
            return response()->json(['Error' => true, 'message' => 'Not found'], 400);
        }

        $case->delete();
        return response()->json(['Done'], 204);
    }

    public function markDoneCase($id)
    {
        $case = CaseItem::find($id);
        if(!$case)
        {
            return response()->json(['Error' => true, 'message' => 'Not found'], 400);
        }

        $case->status = true;
        $case->save();

        return response()->json(['Done'], 200);
    }
}
