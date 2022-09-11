<?php

namespace App\Requests;

class AdvertRequest extends MyBaseRequest
{
    public function validateBeforeSave(string $ruleGroup, $respondWithRedirect = false)
    {
        $this->validate($ruleGroup, $respondWithRedirect);
    }
}
