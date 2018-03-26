<?php

namespace App\Service\Twig;
use Twig\Extension\AbstractExtension;
class AppExtension extends AbstractExtension
{
    public function getFilters(){
        return [
            new \Twig_Filter('accroche',function($text){
                $string = strip_tags($text);
                if(strlen($string)>170):
                    $stringCut = substr($string,0,170);
                    $string=substr($stringCut,0,strrpos($stringCut,' ')).'...';
                endif;
                return $string;
            }),
            new \Twig_Filter('slugify',function($text){
                $text = preg_replace('~[^\pL\d]+~u', '-', $text);
                // transliterate
                $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
                // remove unwanted characters
                $text = preg_replace('~[^-\w]+~', '', $text);
                // trim
                $text = trim($text, '-');
                // remove duplicate -
                $text = preg_replace('~-+~', '-', $text);
                // lowercase
                $text = strtolower($text);
                if (empty($text)) {
                    return 'n-a';
                }
                return $text;
            })
        ];
    }
}