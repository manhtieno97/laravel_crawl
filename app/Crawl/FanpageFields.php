<?php


namespace App\Crawl;


class FanpageFields extends Fields
{

    protected $options = [
        'id',
//        'link',
        'permalink_url',
//        'type',
        'created_time',
        'message',
        'attachments{media,media_type,type,target,subattachments.limit(40)}',
        'comments{id,created_time,from,message,message_tags,attachment}'
    ];
  
}
