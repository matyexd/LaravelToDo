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

    public function createList(TodoListRequest $request)
    {
        $result = TodoList::create($request->all());
        $result->created_at = Carbon::now();
        $result->updated_at = Carbon::now();

        $result->save();

        return response()->json($result, 400);
    }

    public function getListOfLists(Request $request)
    {
        $sortList = $this->todoService->getListSortAndCount($request->sort, $request->count);

        return response()->json($sortList, 200);
    }

    public function editList(TodoListRequest $request, $id)
    {
        $result = TodoList::find($id);
        if(!$result)
        {
            return response()->json(['Error' => true, 'message' => 'Not found'], 400);
        }

        $result->updated_at = Carbon::now();
        $result->name = $request->name;

        $result->save();

        return response()->json($result, 200);
    }

    public function deleteList($id)
    {
        $list = TodoList::find($id);
        if(!$list)
        {
            return response()->json(['Error' => true, 'message' => 'Not found'], 400);
        }

        $list->delete();
        return response()->json(['Done'], 204);
    }

    public function getListCases(Request $request, $id) {
        $sortList = $this->todoService->getListCaseSort($id, $request->sort);

        return response()->json($sortList, 200);
    }
}
