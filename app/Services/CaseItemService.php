<?php


namespace App\Services;

use App\Models\CaseItem;
use Carbon\Carbon;

class CaseItemService extends ModelService
{
    public function editCase($id, $request)
    {
        $case = CaseItem::find($id);
        if(!$case)
        {
            return response()->json(['Error' => true, 'message' => 'Not found'], 400);
        }
        $createDate = $case->created_at;

        $data = $request->all();
        $data['created_at'] = $createDate;
        $data['updated_at'] = Carbon::now();

        $caseEdit = $case->update($data);

        return $caseEdit;
    }
}
