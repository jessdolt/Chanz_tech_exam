<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

class Convert extends Controller
{
    //

    public function index(Request $request){
        $x = $request->inputValue;

        $numericValue = 0;
        $result = '';
        if(is_numeric($x)){
            $result = $this->convertNumToWords($x);
            $numericValue = $x;
        } else {
            $result = $this->convertWordsToNum($x);
            $numericValue = $result;
        }

        return view('welcome', ['convertedValue'=> $result, 'numericValue' => $numericValue]);
    }

    public function convertNumToWords($value){
        $wordsArray = array(
            0 => 'zero',
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine',
            10 => 'ten',
            11 => 'eleven',
            12 => 'twelve',
            13 => 'thirteen',
            14 => 'fourteen',
            15 => 'fifteen',
            16 => 'sixteen',
            17 => 'seventeen',
            18 => 'eighteen',
            19 => 'nineteen',
            20 => 'twenty',
            30 => 'thirty',
            40 => 'forty',
            50 => 'fifty',
            60 => 'sixty',
            70 => 'seventy',
            80 => 'eighty',
            90 => 'ninety'
        );

        $num = $value;
        $output = '';

        if($num < 0 ){
            $output = 'Positive numbers only.';
        } else if($num == 0){
            $output = 'Zero';
        } else if ($num < 21) {
            $output .= $wordsArray[$num];
        } else if ($num < 100) {
            $output .= $wordsArray[10 * floor($num / 10)];
            $remainder = $num % 10;
            if ($remainder > 0) {
                $output .= '-' . $wordsArray[$remainder];
            }
        } else if ($num < 1000) {
            $output .= $wordsArray[floor($num / 100)] . ' hundred';
            $remainder = $num % 100;
            if ($remainder > 0) {
                $output .= ' and ' . $this->convertNumToWords($remainder);
            }
        }  else {
            $output .= 'number too large to convert';
        }

        return $output;
    }

    public function convertWordsToNum($input) {
        $cleanInput = strtolower($input);

        $numberMap = array(
            'zero' => 0,
            'one' => 1,
            'two' => 2,
            'three' => 3,
            'four' => 4,
            'five' => 5,
            'six' => 6,
            'seven' => 7,
            'eight' => 8,
            'nine' => 9,
            'ten' => 10,
            'eleven' => 11,
            'twelve' => 12,
            'thirteen' => 13,
            'fourteen' => 14,
            'fifteen' => 15,
            'sixteen' => 16,
            'seventeen' => 17,
            'eighteen' => 18,
            'nineteen' => 19,
            'twenty' => 20,
            'thirty' => 30,
            'forty' => 40,
            'fifty' => 50,
            'sixty' => 60,
            'seventy' => 70,
            'eighty' => 80,
            'ninety' => 90,
        );
    
    
        $words = explode(' ', $cleanInput);
    

        $number = 0;
        $lastNumber = null;
    
        foreach ($words as $word) {
            if (isset($numberMap[$word])) {
                $lastNumber = $numberMap[$word];
                $number += $lastNumber;
            }
            else if ($word == 'hundred') {
                if ($lastNumber === null) {
                    $number += 100;
                }
                else {
                    $number += ($lastNumber * 100) - $lastNumber;
                }
                $lastNumber = 100;
            }
            else if ($word == 'thousand' || $word == 'million' || $word == 'billion'){
                $number = 'Too large to convert into a number';
            }
        }
    
        return $number;
    }

}

