<?php

class View
{
	public function renderObject($_key, $_value)
	{
        http_response_code(200);
		// putting data to JSONObject 
        $data = array("status" => "ok", $_key => $_value);
        return json_encode($data, JSON_PRETTY_PRINT);
	}

    public function success()
    {
        http_response_code(200);
    	// putting data to JSONObject 
        $data = array("status" => "ok", "message" => "the request has succeeded.");
        return json_encode($data, JSON_PRETTY_PRINT);
    }

    public function fail()
    {
        // the request is missing a required parameter
        // https://tools.ietf.org/html/rfc4918#page-78
        http_response_code(422);
    	// putting data to JSONObject 
        $data = array("status" => "fail", "message" => "the request has failed. Please review the data sent.");
        return json_encode($data, JSON_PRETTY_PRINT);
    }

    public function exception()
    {
        http_response_code(404);
    	// putting data to JSONObject 
        $data = array("status" => "exception", "message" => "unsupported get request. Please read the API documentation.");
        return json_encode($data, JSON_PRETTY_PRINT);
    }
}