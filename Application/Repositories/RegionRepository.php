<?php

/**
 * Region Repository
 * @package Application
 * @subpackage Repositories
 */
class RegionRepository implements IRegionRepository {

    /** @var IConnectionContainer */
    private $connectionContainer;

    /**
     * RegionRepository constructor.
     * @param IConnectionContainer $connectionContainer
     */
    public function __construct(
        IConnectionContainer $connectionContainer
    ) {
        $this->connectionContainer = $connectionContainer;
    }

    /**
     * Return all Regions of $countryId
     * @param int $countryId Country Id
     * @return Region[]
     * @throws WrongInputException
     */
    public function getByCountryId($countryId) {
        
        $wrongInputs = ValidationHelper::testInputWithName(array(
            'countryId' => &$countryId
        ));

        if (count($wrongInputs) === 0) {
            
            $query = $this->connectionContainer->PDO()->prepare('SELECT id, name FROM tbLocation__Region WHERE countryId = :countryId ORDER BY name');
            $query->bindParam(':countryId', $countryId, PDO::PARAM_INT);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            $regions = array();
            foreach ($result as $region) {
                $regions[] = new Region($region);
            }

            return $regions;

        } else {

            throw new WrongInputException($wrongInputs);

        }
        
    }
    
}