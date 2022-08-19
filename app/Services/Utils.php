<?php

namespace App\Services;

use App\Http\Controllers\Controller;

/**
 * Utils
 */
class Utils extends Controller
{

    /**
     * get_response
     *
     * @param  string $status
     * @param  string $message
     * @param  mixed $data
     * @param  int $status_code
     * @return object
     */
    public static function get_response(string $status = 'error', $message = 'error', $data = [], ?int $status_code = 200): object
    {
        return (object)['status_code' => $status_code, 'response_data' => ['status' => $status, 'message' => $message, 'data' => $data]];
    }

    /**
     * validate_uuid
     *
     * @param string $uuid
     * @return object
     */
    public static function validate_uuid(string $uuid): object
    {
        $response_validation = (object)['status' => false, 'message' => 'UUID no válido.'];
        try {
            $validate_uuid =  \Ramsey\Uuid\Uuid::isValid($uuid);
            if ($validate_uuid) {
                $response_validation->status = true;
                $response_validation->message = 'UUID válido';
            }
        } catch (\Exception $ex) {
            $response_validation->message = $ex->getMessage();
        }
        return $response_validation;
    }

    /**
     * calculate_edad
     *
     * @param  string $fecha_nacimiento
     * @return object
     */
    public static function calculate_edad(string $fecha_nacimiento): object
    {
        $response = (object)['status' => false, 'message' => 'Fecha no valida.'];
        try {
            $firstDate  = new \DateTime(date('Y-m-d'));
            $secondDate = new \DateTime($fecha_nacimiento);
            $response->status = true;
            $response->message = 'success';
            $response->data = $firstDate->diff($secondDate);
        } catch (\Exception $ex) {
            $response->message = $ex->getMessage();
        }
        return $response;
    }
}
