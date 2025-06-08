<?php

namespace App\Interfaces;

interface StatsServiceInterface
{
    /**
     * @return mixed
     */
    public function lentBooks(): mixed;

    /**
     * @return mixed
     */
    public function availableBooks(): mixed;

    /**
     * @return mixed
     */
    public function penalties(): mixed;

    /**
     * @return mixed
     */
    public function mostLentBooks(): mixed;

    /**
     * @return mixed
     */
    public function mostActiveUsers(): mixed;

    /**
     * @return mixed
     */
    public function statsToPDF(): mixed;
}
