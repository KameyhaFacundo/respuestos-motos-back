<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class VerificarPermisos
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$permisos)
    {
        try {
            // Intentar obtener el usuario del token JWT
           $user = JWTAuth::parseToken()->authenticate();

            // Verificar si el usuario tiene al menos uno de los permisos requeridos
            foreach ($permisos as $permiso) {
                if ($user->chequearPermiso($permiso)) {
                    return $next($request);
                }
            }
            // Si el usuario no tiene ninguno de los permisos, puedes responder de otra manera
            return response()->json(['error' => 'No tienes los permisos necesarios.'], 403);
        } catch (JWTException $e) {

            if ($e instanceof TokenInvalidException) {
                return response()->json([
                    'message'=>'token invalido'
                ], 401);
            }

            if ($e instanceof TokenExpiredException) {
                return response()->json([
                    'message'=>'token expirado'
                ], 401);
            }
            // Manejar la excepción, por ejemplo, si el token es inválido
            return response()->json(['error' => 'Error al autenticar el usuario.'], 401);
        }
    }
}
