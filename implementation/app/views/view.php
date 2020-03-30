<?php

class View
{
	public function renderObject($_key, $value)
	{
		// putting data to JSONObject 
        $data = array("status" => "ok", $_key => $value);
        return json_encode($data, JSON_PRETTY_PRINT);
	}

    public function success()
    {
    	// putting data to JSONObject 
        $data = array("status" => "ok", "message" => "the request has succeeded.");
        return json_encode($data, JSON_PRETTY_PRINT);
    }

    public function fail()
    {
    	// putting data to JSONObject 
        $data = array("status" => "fail", "message" => "the request has failed. Please review the data sent.");
        return json_encode($data, JSON_PRETTY_PRINT);
    }

    public function exception()
    {
    	// putting data to JSONObject 
        $data = array("status" => "exception", "message" => "unsupported get request. Please read the API documentation.");
        return json_encode($data, JSON_PRETTY_PRINT);
    }
}

// $aa = new View();
// echo $aa->renderKey("a","aad");