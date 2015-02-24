#!/usr/bin/php -q
<?php
// Run from command prompt > php -q chatbot.demo.php
require "websocket.class.php";
 
// Extended basic WebSocket as ChatBot
class ChatBot extends WebSocket{
  function process($user,$msg){
    switch($msg){
      case "bye":
      case "ciao":
        $this->send($user->socket,"Au revoir");
        $this->disconnect($user->socket);
      break;

      default:
        $this->say("< ".$user->socket." :".$msg);

        foreach ( $this->users as $utilisateur ){
          $this->send($utilisateur->socket,$msg);
        }
      break;
    } 	
  }
}
$master = new ChatBot("localhost",1337);