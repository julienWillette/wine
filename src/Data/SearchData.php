<?php

namespace App\Data;

class SearchData
{

    /**
     * @var int
     */
    public $page = 1;

    /**
     * @var string
     */
    public $q = '';

    /**
     * @var Color[]
     */
    public $color = [];

    /**
     * @var Naming[]
     */
    public $naming = [];

    /**
     * @var Region[]
     */
    public $region = [];

    /**
     * @var null|integer
     */
    public $max;


    /**
     * @var null|integer
     */
    public$min;
}