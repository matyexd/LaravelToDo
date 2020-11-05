<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoListRequest;
use App\Services\TodoListService;
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
        $code = $code = $this->todoService->code;
        return response()->json($result, $code);
    }


    public function getListOfLists(Request $request)
    {
        $result = $this->todoService->getListSortAndCount($request);
        $code = $code = $this->todoService->code;
        return response()->json($result, $code);
    }


    public function edit(TodoListRequest $request, $id)
    {
        $result = $this->todoService->editList($request, $id);
        $code = $code = $this->todoService->code;
        return response()->json($result, $code);
    }

    public function delete(Request $request, $id)
    {
        $result = $this->todoService->deleteList($request, $id);
        $code = $code = $this->todoService->code;
        return response()->json($result, $code);
    }

    public function getListCases(Request $request, $id) {
        $result = $this->todoService->getListCaseSort($id, $request);
        $code = $code = $this->todoService->code;
        return response()->json($result, $code);
    }
}
