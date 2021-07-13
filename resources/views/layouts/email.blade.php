<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
  <title>{{ config('app.name') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <style type="text/css">
    #outlook a {
      padding: 0;
    }
    
    .ReadMsgBody {
      width: 100%;
    }
    
    .ExternalClass {
      width: 100%;
    }
    
    .ExternalClass * {
      line-height: 100%;
    }
    
    body {
      margin: 0;
      padding: 0;
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
    }
    
    table,
    td {
      border-collapse: collapse;
      mso-table-lspace: 0pt;
      mso-table-rspace: 0pt;
    }
    
    img {
      border: 0;
      height: auto;
      line-height: 100%;
      outline: none;
      text-decoration: none;
      -ms-interpolation-mode: bicubic;
    }
    
    p {
      display: block;
      margin: 13px 0;
    }
  </style>
    <!--[if !mso]><!-->
    <style type="text/css">
        @media only screen and (max-width: 560px) {
            @-ms-viewport {
                width: 320px;
            }
            @viewport {
                width: 320px;
            }
            .display-none{
                display: none;
            }
        }
    </style>
     <!--<![endif]-->
  <!--[if mso]>
<xml>
  <o:OfficeDocumentSettings>
    <o:AllowPNG/>
    <o:PixelsPerInch>96</o:PixelsPerInch>
  </o:OfficeDocumentSettings>
</xml>
<![endif]-->
<!--[if !mso]><!-->
  <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,500|IBM+Plex+Serif:400,500&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">

  <!--<![endif]-->
  <style type="text/css">
    @media only screen and (min-width:560px) {
      .mj-column-per-40,
      * [aria-labelledby="mj-column-per-40"] {
        width: 40%!important;
      }
      .mj-column-per-60,
      * [aria-labelledby="mj-column-per-60"] {
        width: 60%!important;
      }
      .mj-column-per-50,
      * [aria-labelledby="mj-column-per-50"] {
        width: 50%!important;
      }
    }
  </style>
</head>

<body style="margin: 0; padding: 0; background-color: #f9fafa;">
	@yield('content')
</body>
</html>