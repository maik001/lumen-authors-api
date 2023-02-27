<?php
namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser 
{
    /**
     * Build Success Responses
     *
     * @param array $data
     * @param int $code
     * @return Illuminate\Http\Response
     */
    public function successResponse($data, $code = Response::HTTP_OK) {
        return response()->json(['data' => $data, 'status' => $code]);
    }

    /**
     * Build Error Responses
     *
     * @param string $message
     * @param int $code
     * @return Illuminate\Http\Response
     */
    public function errorResponse($message, $code) {
        return response()->json(['error' => $message, 'status' => $code], $code);
    }

}
?>