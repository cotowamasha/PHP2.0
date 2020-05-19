<?php

namespace App\services;

use App\entities\Good;
use App\repositories\GoodRepository;

class BasketServices
{
    public function add(Request $request, GoodRepository $goodRepository )
    {
        $id = $request->getId();
        if (empty($id)) {
            return false;
        }

        /** @var Good $good */
        $good = $goodRepository->getOne($id);
        if (empty($good)) {
            return false;
        }

        $goods = $request->getSession('goods');

        if (empty($goods[$id])) {
            $goods[$id] = [
                'good' => $good,
                'count' => 1
            ];
        } else {
            $goods[$id]['count']++;
        }

        $request->setSession('goods', $goods);

        return true;
    }

    public function remove(Request $request)
    {
        $id = $request->getId();
        if (empty($id)) {
            return false;
        }

        $basket = $request->getSession('goods');
        if($basket[$id]['count'] > 1){
            $basket[$id]['count']--;
        } else {
            unset($basket[$id]);
        }
        $request->setSession('goods', $basket);
        return true;
    }
}
