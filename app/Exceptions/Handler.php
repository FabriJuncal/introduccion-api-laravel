<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
// Esta clase es una excepción que se utiliza para representar el error HTTP 404 (Not Found) en una aplicación web.
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        //  el método "renderable" se utiliza para personalizar el manejo de la excepción NotFoundHttpException.
        $this->renderable(function (NotFoundHttpException $e, $request) {

            // Se verifica si la solicitud coincide con ciertas rutas relacionadas.
            // Si la solicitud coincide con alguna de estas rutas, entonces se envía una respuesta JSON con un código
            // de estado HTTP 404 (Not Found) y un mensaje de error específico

            // Excepción para los departamentos no encontrados.
            if($request->is('api/departments/*')){
                return response()->json([
                    'status' => false,
                    'message' => 'The selected department is invalid'
                ], 404);
            }

            // Excepción para los empleados no encontrados.
            if($request->is('api/employees/*')){
                return response()->json([
                    'status' => false,
                    'message' => 'The selected employee is invalid'
                ], 404);
            }
        });
    }
}
