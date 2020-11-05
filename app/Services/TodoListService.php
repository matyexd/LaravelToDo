<?php


namespace App\Services;

use App\Models\CaseItem;
use App\Models\TodoList;
use Carbon\Carbon;
use http\Env\Request;

/**
 * Class TodoListService
 * @package App\Services
 */
class TodoListService extends ModelService
{
    /**
     * @param $request
     * @return mixed
     */
    public function getListSortAndCount($request)
    {
        $countList = $this->listCount($request->count);
        $skip = TodoList::where('user_id', $request->user()->id)->count() - $countList;

        $listOfLists = TodoList::where('user_id', $request->user()->id)->skip($skip)->take($countList)->get();

        $sortList = $this->listSort($listOfLists, $request->sort);

        return $sortList;
    }

    /**
     * @param $id
     * @param $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function getListCaseSort($id, $request)
    {
        $listCase = TodoList::find($id);

        if((!$listCase) or ($request->user()->id))
        {
            return response()->json(['Error' => true, 'message' => 'Not found'], 400);
        }
        $listCase = $listCase->getCases;
        $sortList = parent::listSort($listCase, $request->sort);
        return $sortList;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function createList($request){
        $result = TodoList::create($request->all());
        $result->user_id = $request->user()->id;
        $result->created_at = Carbon::now();
        $result->updated_at = Carbon::now();

        $result->save();

        return $result;
    }

    /**
     * @param $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function editList($request, $id){
        $result = TodoList::find($id);

        if((!$result) or ($result->user_id != $request->user()->id))
        {
            return response()->json(['Error' => true, 'message' => 'Not found'], 400);
        }

        $result->updated_at = Carbon::now();
        $result->name = $request->name;

        $result->save();

        return $result;
    }

    /**
     * @param $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string[]
     */
    public function deleteList($request, $id){
        $result = TodoList::find($id);
        if((!$result) or ($result->id != $request->user()->id))
        {
            return response()->json(['Error' => true, 'message' => 'Not found'], 400);
        }

        // Delete cases of list
        $list_id = $result->id;
        CaseItem::where('list_id', $list_id)->delete();
        // Delete list
        $result->delete();

        return ['Done'];
    }
}
