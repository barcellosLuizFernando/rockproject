<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns="http://www.w3.org/1999/xhtml"
    xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <style type="text/css">
        table,
        td {
            color: #000000;
        }

        a {
            color: #6d6d6d;
            text-decoration: none;
        }

        @media (max-width: 480px) {
            #u_content_image_1 .v-src-width {
                width: auto !important;
            }

            #u_content_image_1 .v-src-max-width {
                max-width: 50% !important;
            }

            #u_content_text_1 .v-text-align {
                text-align: center !important;
            }

            #u_content_text_14 .v-text-align {
                text-align: center !important;
            }

            #u_content_text_15 .v-text-align {
                text-align: center !important;
            }
        }

        @media only screen and (min-width: 620px) {
            .u-row {
                width: 600px !important;
            }

            .u-row .u-col {
                vertical-align: top;
            }

            .u-row .u-col-33p33 {
                width: 199.98px !important;
            }

            .u-row .u-col-50 {
                width: 300px !important;
            }

            .u-row .u-col-66p67 {
                width: 400.02px !important;
            }

            .u-row .u-col-100 {
                width: 600px !important;
            }

        }

        @media (max-width: 620px) {
            .u-row-container {
                max-width: 100% !important;
                padding-left: 0px !important;
                padding-right: 0px !important;
            }

            .u-row .u-col {
                min-width: 320px !important;
                max-width: 100% !important;
                display: block !important;
            }

            .u-row {
                width: calc(100% - 40px) !important;
            }

            .u-col {
                width: 100% !important;
            }

            .u-col>div {
                margin: 0 auto;
            }

            .no-stack .u-col {
                min-width: 0 !important;
                display: table-cell !important;
            }

            .no-stack .u-col-50 {
                width: 50% !important;
            }

        }

        body {
            margin: 0;
            padding: 0;
        }

        table,
        tr,
        td {
            vertical-align: top;
            border-collapse: collapse;
        }

        p {
            margin: 0;
        }

        .ie-container table,
        .mso-container table {
            table-layout: fixed;
        }

        * {
            line-height: inherit;
        }

        a[x-apple-data-detectors='true'] {
            color: inherit !important;
            text-decoration: none !important;
        }

        @media (max-width: 480px) {
            .hide-mobile {
                display: none !important;
                max-height: 0px;
                overflow: hidden;
            }
        }

        body {
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
            background-color: #fffefe;
            color: #000000
        }

        .center {
            margin: auto;
            width: 60%;
            border: 3px solid #73AD21;
            padding: 10px;
        }

        .img-center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 40%;
        }

    </style>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

</head>

<body class="clean-body">

    <table style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;
                mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;
                min-width: 320px;Margin: 0 auto;background-color: #eeeeee;width:100%;
                font-family:'Roboto', sans-serif; line-height: 1.7" cellpadding="0" cellspacing="0">
        <tbody>
            <tr style="vertical-align: top">
                <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">

                    <div class="u-row-container">
                        <div class="u-row"
                            style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #00438a!important;">
                            <div style="padding-top: 30px; padding-bottom: 30px;">
                                <img class="img-center" src={{ $message->embed(base_path("public/img/logo_grande_home_topo.png"))}} alt="LogoRock">
                            </div>
                        </div>
                        <div class="u-row"
                            style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">

                            <div style="padding: 10px">
                                @yield('content')
                            </div>


                        </div>
                        <div class="u-row"
                            style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #3e005f;">
                            <div style="text-align: center; color: white; padding: 30px ">
                                <small>
                                    <p>Rock Floripa Ingleses Ltda</p>
                                </small>
                                <small>
                                    <p>41.680.605/0001-58</p>
                                </small>
                            </div>
                        </div>
                    </div>

                </td>
            </tr>
        </tbody>

    </table>



</body>

</html>
