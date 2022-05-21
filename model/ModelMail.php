<?php

class ModelMail{
    private $to;
    private $subject;
    private $message;
    private $header;

    public function __construct($datas = NULL){
        if (!is_null($datas)){
            foreach ($datas as $key => $value){
                if (isset($datas[$key])){
                    $this->$key = $value;
                }
            }
        }
    }

    public function getTo()
    {
        return $this->to;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getHeader()
    {
        return $this->header;
    }

    public function send(){
        return mail($this->to, $this->subject, $this->message);
    }



}
