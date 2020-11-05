<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoListRequest;
use App\Models\TodoList;
use App\Services\TodoListService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TodoListController extends Controller
{

    protected $todoService;

    public function __construct(TodoListService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function create(TodoListRequest $request)
    {
        $result = $this->todoService->createList($request);
        return response()->json($result, 400);
    }


    public function getListOfLists(Request $request)
    {
        $result = $this->todoService->getListSortAndCount($request);
        return response()->json($result, 200);
    }


    public function edit(TodoListRequest $request, $id)
    {
        $result = $this->todoService->editList($request, $id);
        return response()->json($result, 200);
    }

    public function delete(Request $request, $id)
    {
        $result = $this->todoService->deleteList($request, $id);
        return response()->json($result, 204);
    }

    public function getListCases(Request $request, $id) {
        $result = $this->todoService->getListCaseSort($id, $request);
        return response()->json($result, 200);
    }
}
