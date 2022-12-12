<?php

namespace App\Http\Controllers\Api\Auth\Clients\Notifications;

use App;
use App\Http\Controllers\Api\ApiAuthController;
use Illuminate\Http\Request;
use App\Endpoints\Clients\Notifications\NotificationCreateEndpoint;
use App\Exceptions\ExceptionNotFound;
use App\Exceptions\ExceptionNotValid;
use Illuminate\Http\Response;
use App\Http\Requests\Api\Auth\Clients\Notifications\CreateNotificationRequest;

class CreateController extends ApiAuthController
{
    /**
     * 
     * @param CreateClientRequest $request POST Keys are: clientId, channel, content
     * @return type
     */
    public function create(CreateNotificationRequest $request) {
        try {
            $notificationId = NotificationCreateEndpoint::instance()->create(
                    $request->post('clientId'), 
                    $request->post('channel'), 
                    $request->post('content')
            );
        } catch (ExceptionNotFound $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        } catch (ExceptionNotValid $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], Response::HTTP_NOT_ACCEPTABLE);
        } catch (Exception $e) {
            response()->json([
                'error' => 'Server error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json([
            'id' => $notificationId
        ]);
    }
    
}
