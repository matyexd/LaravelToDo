<?php

namespace App\Services;

/**
 * Class ModelService
 * @package App\Services
 */
class ModelService
{
    /**
     * @param $list
     * @param $sort
     * @return mixed
     */
    public function listSort($list, $sort)
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

    /**
     * @param $count
     * @return int
     */
    public function listCount($count)
    {
        $countList = 10;
        if (($count) and ($count < 101)) {
            $countList = $count;
        }

        return $countList;
    }
}
