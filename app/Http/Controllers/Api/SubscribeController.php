<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SubscribeRequest;
use NZTim\Mailchimp\Exception\MailchimpBadRequestException;
use Mailchimp;

class SubscribeController extends Controller
{
    protected function subscribe(SubscribeRequest $request)
    {
        try {
            Mailchimp::subscribe(config('mailchimp.list_id'), $request->get('email'), [], true);
            return \Restable::success(trans('forms.success_subscribe'));
        } catch (MailchimpBadRequestException $e) {
            $response = $e->response();
            return \Restable::bad($response['detail']);
        }
        catch (\Exception $e) {
            return \Restable::bad($e->getMessage());
        }
    }
}
