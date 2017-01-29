<?php

/**
 * @package Application
 * @subpackage Controllers
 */
class JsonDemoController extends BaseLayoutController
{
    /**
     * Default Action
     * @return null|ActionResult
     */
    public function index()
    {
        $actionResult = new BaseLayoutContentViewModel();
        $actionResult->title = "JSON Demo";
        $actionResult->content = new View('Index', null, __FILE__);

        return $this->baseLayout($actionResult);
    }

    /**
     * @return null|ActionResult
     */
    public function getRandomPerson()
    {
        $person = $this->generateRandomPerson();
        $person->friends = array();

        for ($i = 0, $end = rand(0, 2); $i < $end; $i++)
        {
            $person->friends[] = $this->generateRandomPerson();
        }

        return new JsonActionResult($person);
    }

    /**
     * @return Person
     */
    private function generateRandomPerson()
    {
        $names = array('Ivan', 'John', 'Dimitri', 'Mike', 'Anna', 'Marie', 'Bob', 'Rose');
        $surnames = array('Krambo', 'Motorek', 'Garpo', 'Nash', 'Potrik', 'Kelim');
        $citys = array('London', 'Madrid', 'Pasai Antxo', 'Berlin', 'Rome', 'Lisboa', 'Barcelona');
        $hobbies = array('Walking', 'Running', 'Football', 'Painting', 'Programming', 'Singing', 'Murdering', 'Dancing');

        $person = new Person();
        $person->name = ArrayHelper::getRandomValue($names);
        $person->surname = ArrayHelper::getRandomValue($surnames);
        $person->city = ArrayHelper::getRandomValue($citys);
        $person->hobbies = ArrayHelper::getRandomValues($hobbies, rand(1, 5));

        return $person;
    }
}