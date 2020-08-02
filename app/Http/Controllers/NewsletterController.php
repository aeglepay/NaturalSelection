<?php

namespace App\Http\Controllers;

use Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    function subscribe(Request $request)
    {
        Newsletter::subscribe($request->email);
    }

    function unsubscribe(Request $request)
    {
        Newsletter::unsubscribe($request->email);
    }

    function delete(Request $request)
    {
        Newsletter::delete($request->email);
    }

    public function createCampaign(
    string $fromName,
    string $replyTo,
    string $subject,
    string $html = '',
    string $listName = '',
    array $options = [],
    array $contentOptions = [])
    {}
}
