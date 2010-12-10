<?php

/**
 * example actions.
 *
 * @package    sandbox
 * @subpackage example
 * @author     Your name here
 * @version    SVN: $Id$
 */
class exampleActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    
	// Inserting a record
	$car = new Car();
	$car->setMake('Audi');
	$car->setModel('A4');
	$car->save();
	
	// Getting the list
	$mondongo = $this->getMondongo();
	$car_repository = new CarRepository($mondongo);
	$this->cars = $car_repository->find();
  }
}
