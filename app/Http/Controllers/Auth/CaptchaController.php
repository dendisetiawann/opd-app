<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CaptchaController extends Controller
{
    /**
     * Generate new captcha and store in session
     */
    public function refresh(Request $request): JsonResponse
    {
        $num1 = rand(1, 9);
        $num2 = rand(1, 9);
        
        session(['captcha_num1' => $num1, 'captcha_num2' => $num2]);
        
        return response()->json([
            'num1' => $num1,
            'num2' => $num2,
            'question' => "{$num1} + {$num2} =",
            'success' => true
        ]);
    }

    /**
     * Validate captcha answer
     */
    public static function validate(Request $request): bool
    {
        $num1 = session('captcha_num1', 0);
        $num2 = session('captcha_num2', 0);
        $answer = (int) $request->input('captcha');
        
        return $answer === ($num1 + $num2);
    }
}
