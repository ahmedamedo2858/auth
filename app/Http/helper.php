<?php
//if (!function_exists('aurl')){
//    function aurl($url){
//        return dash.$url;
//    }
//}
use Illuminate\Support\Facades\Auth;

if (!function_exists('admin')){
    function admin(){
        return Auth::guard('admin');
    }
}
