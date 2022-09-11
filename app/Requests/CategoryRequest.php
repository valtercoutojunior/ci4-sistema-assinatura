<?php

namespace App\Requests;

class CategoryRequest extends MyBaseRequest
{
    public function validateBeforeSave(string $ruleGroup, $respondWithRedirect = false)
    {
        $this->validate($ruleGroup, $respondWithRedirect);
    }
}
