@extends('layouts.email')

@section('content')

    <div style="margin: 0; padding: 0; background-color: #f9fafa;">
        <!--[if mso]>
        <table border="0" cellpadding="0" cellspacing="0" width="560" align="center" style="width:560px;">
            <tr>
                <td style="width: 100%; height: 28px;">
        <![endif]-->
        <div id="div" class="display-none" style="width: 100%; height: 50px;"></div>
        <!--[if mso]>
        </td></tr></table>
        <table border="0" cellpadding="0" cellspacing="0" width="560" align="center" style="width:560px;">
            <tr>
                <td>
        <![endif]-->
        <div class="body" bgcolor="#fff" align="center"
             style="box-shadow: 0px 20px 30px 0px rgba(34, 101, 81, 0.04); text-align: center; margin:0 auto; max-width:560px; background-color: #fff;">
            <table cellpadding="0" cellspacing="0" style="width:100%; background-color:#fff;" align="center" border="0">
                <tbody>
                <tr>
                    <td width="100%" valign="top" align="center" style="background-color: #fff;">
                        <table width="100%" cellspacing="0" cellpadding="0" bgcolor="#fff" align="center"
                               style="background-color: #fff; border-collapse:collapse; text-align:center;"
                               valign="top">
                            <tbody>
                            <tr>
                                <td valign="top">
                                    <table bgcolor="#fff" cellpadding="0" cellspacing="0"
                                           style="width:100%; background-color: #fff;" align="left" border="0">
                                        <tbody>
                                        <tr>
                                            <td valign="top" width="80" style="width:80px;"></td>
                                            <td valign="top" align="left" style="max-width:400px;">
                                                <!--[if mso | IE]>
                                                <table role="presentation" border="0" cellpadding="0" cellspacing="0"
                                                       width="400" align="center" style="width:400px;">
                                                    <tr>
                                                        <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
                                                <![endif]-->
                                                <div style="margin:0 auto; max-width:400px;">
                                                    <table role="presentation" bgcolor="#fff" cellpadding="0"
                                                           cellspacing="0" style="width:100%; background-color: #fff;"
                                                           align="center" border="0">
                                                        <tbody>
                                                        <tr>
                                                            <td valign="top" height="40">
                                                                <!--[if mso]>
                                                                <table border="0" cellpadding="0" cellspacing="0"
                                                                       width="400" align="center" style="width:400px;">
                                                                    <tr>
                                                                        <td style="width: 100%; height:40px;">
                                                                <![endif]-->
                                                                <div id="div" style="width: 100%; height: 40px;"></div>
                                                                <!--[if mso]>
                                                                </td></tr></table>
                                                                <![endif]-->
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align:center;vertical-align:top;font-size:0px;">
                                                                <!--[if mso | IE]>
                                                                <table role="presentation" border="0" cellpadding="0"
                                                                       cellspacing="0">
                                                                    <tr>
                                                                        <td style="vertical-align:top;width:400px;">
                                                                <![endif]-->
                                                                <table role="presentation" cellpadding="0"
                                                                       cellspacing="0" width="100%" border="0">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td style="word-break:break-word;" align="left">
                                                                            <a href="{{ config('app.production_url') }}"
                                                                               style="border: 0 none; text-decoration: none; ">
                                                                                <img style="border: 0 none; display:block; vertical-align: middle; width:118px;"
                                                                                     width="118"
                                                                                     src="{{ asset('img/email/natures.png') }}"
                                                                                     alt="{{ config('app.name') }}">
                                                                            </a>
                                                                        </td>
                                                                        <td valign="middle" align="right">
                                                                            <table cellspacing="0" cellpadding="0"
                                                                                   align="right"
                                                                                   style="border-collapse:collapse; text-align:right;"
                                                                                   valign="top">
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td valign="middle">
                                                                                        <a href="{{ options_find('facebook_link') }}"
                                                                                           style="text-decoration:none"><img
                                                                                                    alt="Facebook"
                                                                                                    src="{{ asset('img/email/fb.png') }}"
                                                                                                    style="border:0 none"
                                                                                                    valign="middle">
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                                <!--[if mso]>
                                                                </td></tr></table>
                                                                <![endif]-->
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top" height="59">
                                                                <!--[if mso]>
                                                                <table border="0" cellpadding="0" cellspacing="0"
                                                                       width="400" align="center" style="width:400px;">
                                                                    <tr>
                                                                        <td style="width: 100%; height:59px;">
                                                                <![endif]-->
                                                                <div id="div" style="width: 100%; height: 59px;"></div>
                                                                <!--[if mso]>
                                                                </td></tr></table>
                                                                <![endif]-->
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="middle" align="center"
                                                                style="color:#000000; font-family:'IBM Plex Serif', Times, 'Times New Roman', Georgia, serif; font-size:36px; font-weight:400; line-height:46px; text-align:center; padding:20px 0;"
                                                                align="center">{{ trans('email.notifications.client.thank_for_contribution') }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top" height="38">
                                                                <!--[if mso]>
                                                                <table border="0" cellpadding="0" cellspacing="0"
                                                                       width="400" align="center" style="width:400px;">
                                                                    <tr>
                                                                        <td style="width: 100%; height:38px;">
                                                                <![endif]-->
                                                                <div id="div" style="width: 100%; height: 38px;"></div>
                                                                <!--[if mso]>
                                                                </td></tr></table>
                                                                <![endif]-->
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="word-break:break-word;" align="center">
                                                                <img style="text-align:center; border: 0 none; display:block; vertical-align: middle; max-width:350px;"
                                                                     width="100%"
                                                                     src="{{ asset('img/email/tree-love.png') }}"
                                                                     alt="{{ config('app.name') }}">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top" height="6">
                                                                <!--[if mso]>
                                                                <table border="0" cellpadding="0" cellspacing="0"
                                                                       width="400" align="center" style="width:400px;">
                                                                    <tr>
                                                                        <td style="width: 100%; height:6px;">
                                                                <![endif]-->
                                                                <div id="div" style="width: 100%; height: 6px;"></div>
                                                                <!--[if mso]>
                                                                </td></tr></table>
                                                                <![endif]-->
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="middle" align="center"
                                                                style="color:#000000; font-family:'IBM Plex Serif', Times, 'Times New Roman', Georgia, serif;font-size:10px;font-weight:500;line-height:36px;text-align:center; padding:20px 0;"
                                                                align="center">{{ trans('email.notifications.client.donation_amount') }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="middle" align="center"
                                                                style="color:#010101;font-family:'IBM Plex Serif', Times, 'Times New Roman', Georgia, serif; font-size:50px;font-weight:400;line-height:50px;text-align:center; padding:0;"
                                                                align="center">${{ $donation->amount }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top" height="13">
                                                                <!--[if mso]>
                                                                <table border="0" cellpadding="0" cellspacing="0"
                                                                       width="400" align="center" style="width:400px;">
                                                                    <tr>
                                                                        <td style="width: 100%; height:13px;">
                                                                <![endif]-->
                                                                <div id="div" style="width: 100%; height: 13px;"></div>
                                                                <!--[if mso]>
                                                                </td></tr></table>
                                                                <![endif]-->
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="middle" align="center"
                                                                style="color:#598070;font-family:'IBM Plex Serif', Times, 'Times New Roman', Georgia, serif; font-size:16px; font-weight:400; line-height:32px; text-align:center; padding:20px 0;"
                                                                align="center">
                                                                {{ trans('email.notifications.client.you_have', ['count' => $donation->trees]) }}
                                                                <br>
                                                                {{ trans('email.notifications.client.you_contribution') }}
                                                                <br>
                                                                {{ trans('email.notifications.client.thank_you') }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top" height="53">
                                                                <!--[if mso]>
                                                                <table border="0" cellpadding="0" cellspacing="0"
                                                                       width="400" align="center" style="width:400px;">
                                                                    <tr>
                                                                        <td style="width: 100%; height:53px;">
                                                                <![endif]-->
                                                                <div id="div" style="width: 100%; height: 53px;"></div>
                                                                <!--[if mso]>
                                                                </td></tr></table>
                                                                <![endif]-->
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="middle" align="center"
                                                                style="color:#000; font-family:'IBM Plex Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; text-align:center; padding: 0;"
                                                                align="center"><a
                                                                        style="font-family:'IBM Plex Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:14px; font-weight: 500; line-height:24px; text-decoration: underline; display:inline-block; width:100%; text-align:center; color: #000000;"
                                                                        href="{{ asset($certificateFile) }}">{{ trans('email.notifications.client.download_certificate') }}</a>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!--[if mso | IE]>
                                                </td></tr></table>
                                                <![endif]-->
                                            </td>
                                            <td valign="top" width="80" style="width:80px;"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                <td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top" height="42">
                        <!--[if mso]>
                        <table border="0" cellpadding="0" cellspacing="0" width="560" align="center"
                               style="width:560px;">
                            <tr>
                                <td style="width: 100%; height: 42px;">
                        <![endif]-->
                        <div id="div" style="width: 100%; height: 42px;"></div>
                        <!--[if mso]>
                        </td></tr></table>
                        <![endif]-->
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <!--[if mso]>
        </td></tr></table>
        <table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" style="width:100%;">
            <tr>
                <td>
        <![endif]-->
        <div class="body" style="margin:0 auto; max-width:100%;">
            <table cellpadding="0" cellspacing="0" style="width:100%;" align="center" border="0">
                <tbody>
                <tr>
                    <td valign="top" height="37">
                        <!--[if mso]>
                        <table border="0" cellpadding="0" cellspacing="0" width="560" align="center"
                               style="width:560px;">
                            <tr>
                                <td style="width: 100%; height: 37px;">
                        <![endif]-->
                        <div id="div" style="width: 100%; height: 37px;"></div>
                        <!--[if mso]>
                        </td></tr></table>
                        <![endif]-->
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <table width="100%" cellspacing="0" cellpadding="0" align="center"
                               style="border-collapse:collapse; text-align:center; width:100%;" valign="top"
                               class="footer">
                            <tbody>
                            <tr>
                                <td width="100%" valign="top" align="center">
                                    <table width="100%" cellspacing="0" cellpadding="0" align="center"
                                           style="border-collapse:collapse; text-align:center; width:100%;"
                                           valign="top">
                                        <tbody>
                                        <tr>
                                            <td valign="top" height="20" align="center"
                                                style="color:#1b1b1a; font-family:'IBM Plex Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:14px; font-weight:500; line-height:16px; text-align:center;">
                                                <a style="color:#1b1b1a; font-family:'IBM Plex Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:14px; font-weight:500; line-height:16px; text-decoration:none; display:inline-block; width:100%; text-align:center;"
                                                   href="{{ config('app.production_url') }}">www.natures.org</a>
                                                <br>
                                                <br>
                                                <p style="color:#888; font-family:'IBM Plex Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:12px; line-height:22px; display:inline-block; width: 100%; text-align:center; text-decoration:none; padding:0;">
                                                    &copy; {{ config('app.name') }}
                                                    , {{ \Carbon\Carbon::now()->year }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top" height="27">
                                                <!--[if mso]>
                                                <table border="0" cellpadding="0" cellspacing="0" width="560"
                                                       align="center" style="width:560px;">
                                                    <tr>
                                                        <td style="width: 100%; height: 27px;">
                                                <![endif]-->
                                                <div id="div" style="width: 100%; height: 27px;"></div>
                                                <!--[if mso]>
                                                </td></tr></table>
                                                <![endif]-->
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <!--[if mso]>
        </td></tr></table>
        <![endif]-->
    </div>
@append
