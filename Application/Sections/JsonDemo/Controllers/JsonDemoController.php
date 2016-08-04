<?php

/**
 * @package Application
 * @subpackage Controllers
 */
class JsonDemoController implements IController
{
    /**
     * Default Action
     * @param IFrameworkRequest $request
     * @return null|IActionResult
     */
    public function index(IFrameworkRequest $request)
    {
        $actionResult = new BasePartialActionResult();
        $actionResult->title = "JSON Demo";
        $actionResult->actionResult = new ViewActionResult('Index', null, __FILE__);

        return $actionResult;
    }

    /**
     * @param IFrameworkRequest $request
     * @return null|IActionResult
     */
    public function getRandomPerson(IFrameworkRequest $request)
    {
        return new JsonActionResult($this->generateRandomPerson());
    }

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