<?php

namespace App\Services;

class ModelService
{
    public function getListSort($list, $sort)
    {
        // Сортировка: 1 - по дате создания, 2 - по дате обновления, 3 - по имени, по умолчанию - по id
        switch ($sort)
        {
            case 1:
                $sortList = $list->sortBy('name');
                break;
            case 2:
                $sortList = $list->sortBy('created_at');
                break;
            case 3:
                $sortList = $list->sortBy('updated_at');
                break;
            default:
                $sortList = $list->sortByDesc('id');
        }

        return $sortList;
    }

    public function count($count)
    {
        $countList = 10;
        if(($count) and ($count < 101))
        {
            $countList = $count;
        }

        return $countList;
    }
}
