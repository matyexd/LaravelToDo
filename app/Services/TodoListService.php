<?php


namespace App\Services;

use App\Models\CaseItem;
use App\Models\TodoList;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * Class TodoListService
 * @package App\Services
 */
class TodoListService extends ModelService
{
    /**
     * TodoListService constructor.
     * @param CaseItemService $caseService
     */

    /**
     * @param $request
     * @return mixed
     */
    public function getListSortAndCount($request)
    {
        $list = TodoList::where('user_id', Auth::user()->id);
        $countList = $this->listCount($request->count);
        $skip = $list->count() - $countList;

        $listOfLists = $list
            ->skip($skip)
            ->take($countList)
            ->get();

        $sortList = $this->listSort($listOfLists, $request->sort);

        return $sortList;
    }

    /**
     * @param $id
     * @param $request
     * @return array|mixed
     */
    public function getListCaseSort($id, $request)
    {
        $list = TodoList::find($id);

        if(!$this->hasList($list)){
            $this->code = 400;
            return ['Error' => true, 'message' => 'Not found'];
        }

        $result = $list->getCases;
        $sortList = parent::listSort($result, $request->sort);
        return $sortList;
    }

    /**
     * @param $request
     * @return mixed\
     */
    public function createList($request){
        $result = TodoList::create($request->all());
        $result->user_id = Auth::user()->id;
        $result->created_at = Carbon::now();
        $result->updated_at = Carbon::now();

        $result->save();

        return $result;
    }

    /**
     * @param $request
     * @param $id
     * @return array
     */
    public function editList($request, $id){
        $list = TodoList::find($id);

        if(!$this->hasList($list)){
            $this->code = 400;
            return ['Error' => true, 'message' => 'Not found'];
        }

        $list->updated_at = Carbon::now();
        $list->name = $request->name;

        $list->save();

        return $list;
    }

    /**
     * @param $request
     * @param $id
     * @return array|string[]
     */
    public function deleteList($request, $id){
        $list = TodoList::find($id);
        if(!$this->hasList($list)){
            $this->code = 400;
            return ['Error' => true, 'message' => 'Not found'];
        }

        // Delete cases of list
        $list_id = $list->id;
        CaseItem::where('list_id', $list_id)->delete();
        // Delete list
        $list->delete();

        return ['Done'];
    }

    /**
     * @param $result
     * @return bool
     */
    public function hasList($result){
        if (($result) and (Auth::user()->id == $result->user_id)) {
            return true;
        }
        else {
            return false;
        }
    }
}
