<?php


namespace Khamsolt\Laraweath\Controllers;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Khamsolt\Laraweath\Traits\WithSymbolsDecode;

class LaraweathController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, WithSymbolsDecode;

    public function index()
    {

    }

}
