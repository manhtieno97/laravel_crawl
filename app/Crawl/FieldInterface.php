<?php


namespace App\Crawl;


interface FieldInterface
{
    public function getOptions() :array ;
    public function getOptionsStr() :string ;
}
