<?php

namespace App\Requests;

class UserRequest extends MyBaseRequest
{
    public function validateBeforeSave(string $ruleGroup, $respondWithRedirect = false)
    {
        $this->validate($ruleGroup, $respondWithRedirect);
    }
}
