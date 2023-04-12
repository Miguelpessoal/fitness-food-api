<?php

namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{
    protected $message;
    protected $status;
    protected $errors;

    /**
     * @param string     $message  The internal exception message
     * @param int        $status   The internal exception status
     * @param array      $errors   The internal exception errors
     */
    public function __construct(
        string $message = '',
        int $status = 400,
        array $errors = []
    ) {
        $this->message = $message;
        $this->status = $status;
        $this->errors = $errors;
    }

    /**
     * Report the exception.
     *
     * @return void
     * @codeCoverageIgnore
     */
    public function report()
    {
        //
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        $response = [];

        strlen($this->message) && ($response['message'] = $this->message);

        count($this->errors) && ($response['errors'] = $this->errors);

        return response()->json($response, $this->status);
    }
}
