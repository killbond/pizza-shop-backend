<?php


namespace App\Services;


use App\Http\Requests\LoginRequest;
use App\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class AuthService
{
    public function authorize(LoginRequest $request)
    {
        if (!auth()->attempt($request->validated())) {
            $response = response()->json(
                ['message' => 'Unauthorized'],
                Response::HTTP_UNAUTHORIZED
            );
            throw new HttpResponseException($response);
        }

        $token = $request->user()
            ->createToken('Personal Access Token');

        return [
            'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString(),
            'access_token' => $token->accessToken,
            'token_type' => 'Bearer',
        ];
    }

    public function logout()
    {
        /** @var User $user */
        $user = auth('api')->user();
        $user->token()->revoke();
    }
}
