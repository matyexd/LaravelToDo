<?php


namespace App\Services;

use App\Models\TodoList;

class TodoListService extends ModelService
{
    public function getListSortAndCount($sort, $count)
    {
        $countList = $this->count($count);
        $skip = TodoList::count() - $countList;

        $listOfLists = TodoList::skip($skip)->take($countList)->get();

        $sortList = $this->getListSort($listOfLists, $sort);

        return $sortList;
    }

    public function getListCaseSort($id, $sort)
    {
        $listCase = TodoList::find($id);

        if(!$listCase)
        {
            return response()->json(['Error' => true, 'message' => 'Not found'], 400);
        }
        $listCase = $listCase->getCases;
        return parent::getListSort($listCase, $sort);
    }
}
