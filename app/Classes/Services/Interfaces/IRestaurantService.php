<?php

namespace App\Classes\Services\Interfaces;

interface IRestaurantService
{
    public function postUpdate($data);

    /**
     * get all restaurant
     */
    public function getRestaurants();

    /**
     * find restaurant by id
     * @param int  $id
     */
    public function findRestaurantById($id);


    /**
     * delete restaurant by id
     * @param int $id
     */
    public function delete($id);

    /**
     * get meals by restaurant id
     * @param array $data
     */
    public function getMealsByRestaurantId($data);

    /**
     * create restaurant food by restaurant_id and meals
     * @param array $data
     */
    public function createRestaurantFood($data);

    /**
     * get restaurant meals by restaurant_id\
     * @param array $data
     */
    public function getRestaurantMeals($data);

    /**
     * get restaurant client
     * @param array $data
     */
    public function getHomeClient($restaurant_id);

    /**
     * find restaurant_meals by id
     * @param int  $id
     */
    public function getRestaurantMealById($id);

    /**
     * create table restaurant
     * @param array $array
     * @param mixed $filename
     */
    public function createTable($array, $filename);

    /**
     * find table
     */
    public function findTable($data);
}
