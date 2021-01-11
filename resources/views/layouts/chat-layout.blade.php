<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>E Chat</title>

        <!-- Fonts -->


        <!-- Styles -->

        <link rel="stylesheet" href="{{ asset('css/chatApp.css') }}">


        <style>
            body {
                padding: 0;
                margin: 0;
                font-family: 'roman';
            }
        </style>
    </head>
    <body class="antialiased">

        <div id="chat-layout">
            <div class="chat-sidebar">

                <x-chat.sidebar></x-chat.sidebar>
            </div>
            <div class="chat-body">
                <x-chat.body.header></x-chat.body.header>
                <div class="chat-contain">
                    <x-chat.body.body-inner></x-chat.body.body-inner>
                    <div class="chat-scroll-button chat-center none">
                        <x-chat.icon.scrollup></x-chat.icon.scrollup>
                    </div>
                </div>

                <div class="chat-footer">
                    <x-chat.body.footer></x-chat.body.footer>
                </div>

            </div>

        </div>






    </body>
</html>
