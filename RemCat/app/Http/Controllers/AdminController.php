<?php
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function procesarFormulario(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (Admin::verificarCredenciales($email, $password)) {
            // Credenciales válidas
            return response()->json(['mensaje' => 'Credenciales válidas'], 200);
        } else {
            // Credenciales inválidas
            return response()->json(['mensaje' => 'Credenciales inválidas'], 401);
        }
    }
}