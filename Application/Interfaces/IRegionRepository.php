<?php

/**
 * Class IRegionRepository
 * @package Application
 * @subpackage Interfaces
 */
interface IRegionRepository {

    /**
     * Return all Regions of $countryId
     * @param int $countryId Country Id
     * @return Region[]
     * @throws WrongInputException
     */
    public function getByCountryId($countryId);

}