<?php


namespace App\Services;

use App\Models\CaseItem;
use App\Models\TodoList;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CaseItemService extends ModelService
{
    /**
     * @param $id
     * @param $request
     * @return array
     */
    public function editCase($id, $request)
    {
        $case = CaseItem::find($id);
        if((!$case) or (!$this->isCaseOfUser($request)))
        {
            $this->code = 400;
            return ['Error' => true, 'message' => 'Not found'];
        }

        $createDate = $case->created_at;

        $data = $request->all();
        $data['created_at'] = $createDate;
        $data['updated_at'] = Carbon::now();

        $caseEdit = $case->update($data);

        return $caseEdit;
    }

    /**
     * @param $request
     * @return array
     */
    public function createCase($request){
        if(!$this->isCaseOfUser($request))
        {
            $this->code = 400;
            return ['Error' => true, 'message' => 'Not found'];
        }

        $result = CaseItem::create($request->all());
        $result->status = false;
        $result->created_at = Carbon::now();
        $result->updated_at = Carbon::now();

        $result->save();

        return $result;
    }

    /**
     * @param $id
     * @return array|string[]
     */
    public function deleteCase($id){
        $case = CaseItem::find($id);

        if((!$case) or (!$this->isCaseOfUser($case)))
        {
            $this->code = 400;
            return ['Error' => true, 'message' => 'Not found'];
        }

        $case->delete();

        return ['Done'];
    }

    /**
     * @param $id
     * @return array
     */
    public function getCase($id){
        $case = CaseItem::find($id);
        if((!$case) or (!$this->isCaseOfUser($case)))
        {
            $this->code = 400;
            return ['Error' => true, 'message' => 'Not found'];
        }

        return $case;
    }

    /**
     * @param $id
     * @return array|string[]
     */
    public function markDoneCase($id){
        $case = CaseItem::find($id);
        if((!$case) or (!$this->isCaseOfUser($case)))
        {
            $this->code = 400;
            return ['Error' => true, 'message' => 'Not found'];
        }

        $case->status = true;
        $case->save();

        return ['Done'];
    }

    /**
     * @param $request
     * @return bool
     */
    public function isCaseOfUser($request){
        $list = TodoList::where('id', ($request->list_id))->first();
        if ($list->user_id == Auth::user()->id) {
            return true;
        }
        else{
            return false;
        }
    }

}
